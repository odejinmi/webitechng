<?php

namespace App\Services;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use RuntimeException;

class PayVesselService
{
    public function banks(): array
    {
        return $this->request('GET', '/pms/api/external/request/wallet/banks/');
    }

    public function validateAccount(string $accountNumber, string $bankCode): array
    {
        return $this->request('POST', '/pms/api/external/request/wallet/validate-account/', [
            'account_number' => $accountNumber,
            'bank_code' => $bankCode,
        ]);
    }

    public function transfer(array $payload): array
    {
        return $this->request('POST', '/pms/api/external/request/wallet/transfer/', $payload);
    }

    public function createVirtualAccount(array $payload): array
    {
        return $this->request('POST', '/pms/api/external/request/customerReservedAccount/', $payload);
    }

    public function createCard(array $payload): array
    {
        return $this->request('POST', '/pms/api/external/request/virtual-cards/', $payload);
    }

    public function card(string $cardId): array
    {
        return $this->request('GET', "/pms/api/external/request/virtual-cards/{$cardId}/");
    }

    public function fundCard(string $cardId, $amount): array
    {
        return $this->request('POST', "/pms/api/external/request/virtual-cards/{$cardId}/fund/", [
            'amount' => number_format((float) $amount, 2, '.', ''),
        ]);
    }

    public function freezeCard(string $cardId): array
    {
        return $this->request('POST', "/pms/api/external/request/virtual-cards/{$cardId}/freeze/");
    }

    public function unfreezeCard(string $cardId): array
    {
        return $this->request('POST', "/pms/api/external/request/virtual-cards/{$cardId}/unfreeze/");
    }

    public function billers(): array
    {
        return $this->request('GET', '/vaas/api/v1/biller-reseller/billers');
    }

    public function billerItems(string $billerId): array
    {
        return $this->request('GET', "/vaas/api/v1/biller-reseller/billers/{$billerId}/items");
    }

    public function validateRechargeAccount(string $rechargeAccount, string $billerId, ?string $itemId): array
    {
        return $this->request('POST', '/vaas/api/v1/biller-reseller/validate-account', [
            'recharge_account' => $rechargeAccount,
            'biller_id' => $billerId,
            'item_id' => $itemId,
        ]);
    }

    public function createBillerOrder(array $payload): array
    {
        return $this->request('POST', '/vaas/api/v1/biller-reseller/orders', $payload);
    }

    private function request(string $method, string $path, array $payload = []): array
    {
        $apiKey = config('payvessel.api_key');
        $apiSecret = config('payvessel.api_secret');

        if (!$apiKey || !$apiSecret) {
            throw new RuntimeException('PayVessel credentials are not configured.');
        }

        try {
            $response = Http::baseUrl(rtrim(config('payvessel.base_url'), '/'))
                ->acceptJson()
                ->asJson()
                ->withHeaders([
                    'api-key' => $apiKey,
                    'api-secret' => $apiSecret,
                ])
                ->timeout(30)
                ->send(strtoupper($method), $path, $payload === [] ? [] : ['json' => $payload]);
        } catch (ConnectionException $exception) {
            throw new RuntimeException('Unable to connect to PayVessel.', 0, $exception);
        }

        $data = $response->json();
        if (!is_array($data)) {
            throw new RuntimeException('PayVessel returned an invalid response.');
        }

        if (!$response->successful() || (($data['status'] ?? true) === false)) {
            throw new RuntimeException($data['message'] ?? 'PayVessel request failed.');
        }

        return $data;
    }
}
