<?php

namespace App\Http\Controllers\Api\Mobile;

use App\Http\Controllers\User\AirtimeController;
use App\Http\Controllers\User\BettingController;
use App\Http\Controllers\User\CabletvController;
use App\Http\Controllers\User\EducationController;
use App\Http\Controllers\User\InternetSmeController;
use App\Http\Controllers\User\PayVesselBillsController;
use App\Http\Controllers\User\UtilityLocalController;
use App\Services\PayVesselService;
use App\Services\TransactionPinService;
use App\Services\WalletLedgerService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Validation\ValidationException;

class BillsController extends Controller
{
    public function services()
    {
        $settings = gs();

        return response()->json([
            'code' => 200,
            'status' => 'ok',
            'data' => [
                'airtime' => (bool) $settings->airtime,
                'internet' => (bool) $settings->internetsme,
                'utility' => (bool) $settings->utilitylocal,
                'cabletv' => (bool) $settings->cabletv,
                'betting' => (bool) $settings->betting,
                'airtime_to_cash' => (bool) $settings->airtime2cash,
                'airtime_provider' => $settings->airtime_provider,
                'internet_provider' => $settings->internetsme_provider,
                'cabletv_provider' => $settings->cabletv_provider,
                'bills_provider' => $settings->bills_provider ?? 'CURRENT',
            ],
        ]);
    }

    public function airtimeOperators()
    {
        return response()->json([
            'code' => 200,
            'status' => 'ok',
            'data' => [
                ['name' => 'MTN', 'operator' => 'mtn'],
                ['name' => 'Airtel', 'operator' => 'airtel'],
                ['name' => 'Glo', 'operator' => 'glo'],
                ['name' => '9mobile', 'operator' => 'etisalat'],
            ],
        ]);
    }

    public function buyAirtime(Request $request, AirtimeController $controller)
    {
        $this->normalizeTransactionPin($request);
        $request->validate([
            'operator' => 'required|string|in:mtn,airtel,glo,etisalat',
            'phone' => 'required|string|max:20',
            'amount' => 'required|numeric|min:10',
            'wallet' => 'nullable|in:main,ref',
        ]);

        return $controller->buy_airtime_post_local($request);
    }

    public function airtimeToCashFee(Request $request, AirtimeController $controller)
    {
        $request->validate([
            'network' => 'required|string',
            'fee' => 'required|boolean',
            'amount' => 'nullable|numeric|min:1',
        ]);

        return $controller->to_cash_request_fee($request);
    }

    public function convertAirtimeToCash(Request $request, AirtimeController $controller)
    {
        $request->validate([
            'network' => 'required|string',
            'amount' => 'required|numeric|min:1',
            'code' => 'required|string',
            'pin' => 'required|string',
        ]);

        return $controller->to_cash_request_post($request);
    }

    public function internetOperators(InternetSmeController $controller)
    {
        return $controller->internet_operators(request());
    }

    public function internetPlans(Request $request, InternetSmeController $controller)
    {
        $request->validate(['network' => 'nullable|string']);
        $method = $this->internetProviderMethod('plans');

        if (!$method) {
            return $this->providerUnavailable('internet');
        }

        return response()->json($controller->{$method}($request));
    }

    public function buyInternet(Request $request, InternetSmeController $controller)
    {
        $this->normalizeTransactionPin($request);
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'data_plan' => 'required|string',
            'networkname' => 'required|string',
            'phone' => 'required|string|max:20',
            'networkid' => 'required|string',
            'data_type' => 'nullable|string',
            'wallet' => 'nullable|in:main,ref',
        ]);

        $provider = strtoupper((string) gs()->internetsme_provider);
        $plan = $this->resolveInternetPlan($provider, $request);

        if (!$plan) {
            return response()->json([
                'code' => 422,
                'status' => 'error',
                'message' => 'The selected data plan is invalid or no longer available.',
            ], 422);
        }

        if (abs((float) $request->input('amount') - $plan['amount']) > 0.01) {
            return response()->json([
                'code' => 422,
                'status' => 'error',
                'message' => 'The selected data plan price has changed. Refresh the plans and try again.',
                'data' => ['amount' => $plan['amount']],
            ], 422);
        }

        $legacyPlan = $provider === 'GSUBZ' ? $plan['id'] : $plan['name'];
        $request->merge([
            'amount' => $legacyPlan . '|' . $plan['amount'] . '|' . $plan['network'],
            'data_plan' => $plan['id'],
            'data_type' => $plan['category'],
        ]);

        $method = $this->internetProviderMethod('purchase');

        if (!$method) {
            return $this->providerUnavailable('internet');
        }

        return $controller->{$method}($request);
    }

    private function resolveInternetPlan(string $provider, Request $request): ?array
    {
        $files = [
            'N3TDATA' => 'n3tdata.json',
            'GSUBZ' => 'gsubzdata.json',
            'GTIDINGSDATA' => 'gtidingsdata.json',
            'NATKEMLINKS' => 'natkemlinks.json',
            'TECHHUB' => 'APITechHub.json',
        ];

        if (!isset($files[$provider])) {
            return null;
        }

        $plans = json_decode(
            file_get_contents(resource_path('views/partials/' . $files[$provider])),
            true
        );
        $selection = trim(explode('|', (string) $request->input('data_plan'), 2)[0]);
        $network = $this->normalizeInternetNetwork((string) $request->input('networkname'));

        foreach ($plans ?: [] as $rawPlan) {
            $plan = $this->normalizeInternetPlan($provider, $rawPlan);
            if (!$plan || $this->normalizeInternetNetwork($plan['network']) !== $network) {
                continue;
            }

            if ((string) $plan['id'] === $selection || strcasecmp($plan['name'], $selection) === 0) {
                return $plan;
            }
        }

        return null;
    }

    private function normalizeInternetPlan(string $provider, array $plan): ?array
    {
        $id = $provider === 'GSUBZ' ? ($plan['value'] ?? null) : ($plan['plan_id'] ?? null);
        $name = $provider === 'GSUBZ' ? ($plan['displayName'] ?? null) : ($plan['plan_name'] ?? null);
        $amount = $provider === 'GSUBZ' ? ($plan['price'] ?? null) : ($plan['amount'] ?? null);
        $category = $provider === 'GSUBZ'
            ? ($plan['type'] ?? null)
            : ($plan['plan_type'] ?? $plan['category'] ?? null);

        if ($id === null || $name === null || $amount === null || !isset($plan['network'])) {
            return null;
        }

        $numericAmount = (float) str_replace(',', '', (string) $amount);
        if ($numericAmount <= 0) {
            return null;
        }

        return [
            'id' => (string) $id,
            'name' => (string) $name,
            'amount' => $numericAmount,
            'category' => (string) ($category ?: 'smedata'),
            'network' => (string) $plan['network'],
        ];
    }

    private function normalizeInternetNetwork(string $network): string
    {
        $network = strtolower(trim($network));

        return in_array($network, ['9mobile', 'etisalat'], true) ? '9mobile' : $network;
    }

    public function utilityProviders()
    {
        return response()->json([
            'code' => 200,
            'status' => 'ok',
            'data' => [
                ['name' => 'Ikeja Electric', 'company' => 'ikeja-electric'],
                ['name' => 'Eko Electric', 'company' => 'eko-electric'],
                ['name' => 'Abuja Electric', 'company' => 'abuja-electric'],
                ['name' => 'Kano Electric', 'company' => 'kano-electric'],
                ['name' => 'Port Harcourt Electric', 'company' => 'portharcourt-electric'],
                ['name' => 'Jos Electric', 'company' => 'jos-electric'],
                ['name' => 'Ibadan Electric', 'company' => 'ibadan-electric'],
                ['name' => 'Kaduna Electric', 'company' => 'kaduna-electric'],
                ['name' => 'Enugu Electric', 'company' => 'enugu-electric'],
                ['name' => 'Benin Electric', 'company' => 'benin-electric'],
            ],
        ]);
    }

    public function validateUtility(Request $request, UtilityLocalController $controller)
    {
        $request->validate([
            'company' => 'required|string',
            'number' => 'required|string|max:64',
            'metertype' => 'required|string|in:prepaid,postpaid',
        ]);

        return $controller->verify_utility($request);
    }

    public function buyUtility(Request $request, UtilityLocalController $controller)
    {
        $this->normalizeTransactionPin($request);
        $request->validate([
            'company' => 'required|string',
            'number' => 'required|string|max:64',
            'customername' => 'required|string|max:255',
            'metertype' => 'required|string|in:prepaid,postpaid',
            'amount' => 'required|numeric|min:1',
            'wallet' => 'nullable|in:main,ref',
        ]);

        return $controller->buy_utility_post($request);
    }

    public function cableProviders()
    {
        return response()->json([
            'code' => 200,
            'status' => 'ok',
            'data' => [
                ['name' => 'DStv', 'decoder' => 'dstv'],
                ['name' => 'GOtv', 'decoder' => 'gotv'],
                ['name' => 'StarTimes', 'decoder' => 'startimes'],
                ['name' => 'Showmax', 'decoder' => 'showmax'],
            ],
        ]);
    }

    public function cablePlans(Request $request, CabletvController $controller)
    {
        $request->validate(['decoder' => 'required|string|in:dstv,gotv,startimes,showmax']);

        return $controller->cabletv_operators($request);
    }

    public function validateCable(Request $request, CabletvController $controller)
    {
        $request->validate([
            'decoder' => 'required|string|in:dstv,gotv,startimes,showmax',
            'number' => 'required|string|max:64',
        ]);

        return $controller->cabletv_verify($request);
    }

    public function buyCable(Request $request, CabletvController $controller)
    {
        $this->normalizeTransactionPin($request);
        $request->validate([
            'decoder' => 'required|string|in:dstv,gotv,startimes,showmax',
            'number' => 'required|string|max:64',
            'customername' => 'required|string|max:255',
            'plan' => 'required|string',
            'wallet' => 'nullable|in:main,ref',
        ]);

        return $controller->buy_cabletv_post($request);
    }

    public function educationProviders()
    {
        return response()->json([
            'code' => 200,
            'status' => 'ok',
            'data' => [
                ['name' => 'WAEC Registration', 'decoder' => 'waec-registration'],
                ['name' => 'WAEC Result Checker', 'decoder' => 'waec'],
                ['name' => 'JAMB', 'decoder' => 'jamb'],
            ],
        ]);
    }

    public function educationPlans(Request $request, EducationController $controller)
    {
        $request->validate(['decoder' => 'required|string|in:waec-registration,waec,jamb']);

        return $controller->education_operators($request);
    }

    public function validateEducation(Request $request, EducationController $controller)
    {
        $request->validate([
            'decoder' => 'required|string|in:waec-registration,waec,jamb',
            'number' => 'required|string|max:64',
            'type' => 'nullable|string',
        ]);

        return $controller->education_verify($request);
    }

    public function buyEducation(Request $request, EducationController $controller)
    {
        $this->normalizeTransactionPin($request);
        $request->validate([
            'decoder' => 'required|string|in:waec-registration,waec,jamb',
            'number' => 'required|string|max:64',
            'customername' => 'required|string|max:255',
            'plan' => 'required|string',
            'profilecode' => 'nullable|string',
            'wallet' => 'nullable|in:main,ref',
        ]);

        return $controller->buy_education_post($request);
    }

    public function bettingProviders()
    {
        $providers = json_decode(file_get_contents(resource_path('views/partials/betting.json')), true);

        return response()->json([
            'code' => 200,
            'status' => 'ok',
            'data' => $providers ?: [],
        ]);
    }

    public function validateBettingAccount(Request $request, BettingController $controller)
    {
        $request->validate([
            'merchant' => 'required|string',
            'number' => 'required|string|max:64',
        ]);

        return $controller->verify_merchant($request);
    }

    public function fundBettingWallet(Request $request, BettingController $controller)
    {
        $this->normalizeTransactionPin($request);
        $request->validate([
            'companyId' => 'required|string',
            'customerId' => 'required|string|max:64',
            'customerName' => 'required|string|max:255',
            'amount' => 'required|numeric|min:1',
            'wallet' => 'nullable|in:main,ref',
        ]);

        return $controller->fund_wallet_post($request);
    }

    public function payVesselBillers(PayVesselBillsController $controller, PayVesselService $payVessel)
    {
        return $controller->billers($payVessel);
    }

    public function payVesselItems(
        string $billerId,
        PayVesselBillsController $controller,
        PayVesselService $payVessel
    ) {
        return $controller->items($billerId, $payVessel);
    }

    public function validatePayVesselAccount(
        Request $request,
        PayVesselBillsController $controller,
        PayVesselService $payVessel
    ) {
        $request->validate([
            'recharge_account' => 'required|string|max:64',
            'biller_id' => 'required|string|max:64',
            'item_id' => 'nullable|string|max:64',
        ]);

        return $controller->validateAccount($request, $payVessel);
    }

    public function createPayVesselOrder(
        Request $request,
        PayVesselBillsController $controller,
        PayVesselService $payVessel,
        WalletLedgerService $walletLedger
    ) {
        $this->normalizeTransactionPin($request);
        $request->validate([
            'biller_id' => 'required|string|max:64',
            'item_id' => 'required|string|max:64',
            'recharge_account' => 'required|string|max:64',
            'amount' => 'required|integer|min:1',
            'wallet' => 'nullable|in:main,ref',
        ]);

        return $controller->order($request, $payVessel, $walletLedger);
    }

    private function normalizeTransactionPin(Request $request): void
    {
        $validated = $request->validate([
            'pin' => ['required', 'string', 'regex:/^\d{4,6}$/'],
        ]);

        $pin = trim($validated['pin']);
        $user = $request->user();

        if (empty($user->trx_password)) {
            throw ValidationException::withMessages([
                'pin' => ['Transaction PIN is not configured. Set it from the security settings first.'],
            ]);
        }

        if (!app(TransactionPinService::class)->matches($user, $pin)) {
            throw ValidationException::withMessages([
                'pin' => ['The transaction PIN does not match.'],
            ]);
        }

        $request->merge(['pin' => $pin, 'password' => $pin]);
    }

    private function internetProviderMethod(string $operation): ?string
    {
        $provider = strtoupper((string) gs()->internetsme_provider);
        $methods = [
            'N3TDATA' => ['plans' => 'operatorsInternetdetailsN3TDATA', 'purchase' => 'buy_internet_post_n3tdata'],
            'GSUBZ' => ['plans' => 'operatorsInternetdetailsGSUBZ', 'purchase' => 'buy_internet_post_gsubz'],
            'GTIDINGSDATA' => ['plans' => 'operatorsInternetdetailsGTIDINGS', 'purchase' => 'buy_internet_sme_gtidings'],
            'NATKEMLINKS' => ['plans' => 'operatorsInternetdetailsNATKEMLINKS', 'purchase' => 'buy_internet_sme_natkemlinks'],
            'TECHHUB' => ['plans' => 'operatorsInternetdetailsTECHHUB', 'purchase' => 'buy_internet_sme_techhub'],
        ];

        return $methods[$provider][$operation] ?? null;
    }

    private function providerUnavailable(string $service)
    {
        return response()->json([
            'code' => 503,
            'status' => 'error',
            'message' => ucfirst($service) . ' provider is not configured.',
        ], 503);
    }
}
