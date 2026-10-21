<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Transaction;
use App\Services\PayVesselService;
use App\Services\WalletLedgerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RuntimeException;

class PayVesselBillsController extends Controller
{
    public function __construct()
    {
        $this->middleware('kyc.status');
    }

    public function billers(PayVesselService $payVessel)
    {
        $this->ensureSelected();

        return response()->json($payVessel->billers());
    }

    public function items(string $billerId, PayVesselService $payVessel)
    {
        $this->ensureSelected();

        return response()->json($payVessel->billerItems($billerId));
    }

    public function validateAccount(Request $request, PayVesselService $payVessel)
    {
        $this->ensureSelected();
        $validated = $request->validate([
            'recharge_account' => 'required|string|max:64',
            'biller_id' => 'required|string|max:64',
            'item_id' => 'nullable|string|max:64',
        ]);

        return response()->json($payVessel->validateRechargeAccount(
            $validated['recharge_account'],
            $validated['biller_id'],
            $validated['item_id'] ?? null
        ));
    }

    public function order(
        Request $request,
        PayVesselService $payVessel,
        WalletLedgerService $walletLedger
    ) {
        $this->ensureSelected();
        $validated = $request->validate([
            'biller_id' => 'required|string|max:64',
            'item_id' => 'required|string|max:64',
            'recharge_account' => 'required|string|max:64',
            'amount' => 'required|integer|min:1',
            'password' => 'required|string',
            'wallet' => 'nullable|in:main,ref',
        ]);

        $user = auth()->user();
        if (!Hash::check($validated['password'], $user->trx_password)) {
            return response()->json(['ok' => false, 'status' => 'danger', 'message' => 'Invalid transaction PIN'], 400);
        }

        $wallet = $validated['wallet'] ?? 'main';
        $reference = getTrx();
        $order = null;

        try {
            $walletLedger->debit($user->id, $wallet, $validated['amount'], function ($lockedUser, $balanceBefore, $balanceAfter) use (&$order, $validated, $reference, $wallet) {
                $order = new Order();
                $order->user_id = $lockedUser->id;
                $order->type = 'payvessel_bill';
                $order->val_1 = $validated['recharge_account'];
                $order->product_id = $validated['item_id'];
                $order->product_name = $validated['biller_id'];
                $order->quantity = 1;
                $order->price = $validated['amount'];
                $order->payment = $validated['amount'];
                $order->currency = 'NGN';
                $order->status = 'processing';
                $order->trx = $reference;
                $order->source = $wallet;
                $order->balance_before = $balanceBefore;
                $order->balance_after = $balanceAfter;
                $order->save();

                $transaction = new Transaction();
                $transaction->user_id = $lockedUser->id;
                $transaction->amount = $validated['amount'];
                $transaction->post_balance = $balanceAfter;
                $transaction->charge = 0;
                $transaction->trx_type = '-';
                $transaction->details = 'PayVessel bill payment';
                $transaction->trx = $reference;
                $transaction->remark = 'bill_payment';
                $transaction->save();
            });

            $response = $payVessel->createBillerOrder([
                'biller_id' => $validated['biller_id'],
                'item_id' => $validated['item_id'],
                'recharge_account' => $validated['recharge_account'],
                'amount' => $validated['amount'],
                'reference' => $reference,
            ]);

            $order->status = $response['data']['status'] ?? 'pending';
            $order->transaction_id = $response['data']['id'] ?? $reference;
            $order->details = json_encode($response);
            $order->save();

            return response()->json(['ok' => true, 'status' => 'success', 'message' => $response['message'] ?? 'Bill payment submitted successfully', 'data' => $response['data'] ?? null]);
        } catch (RuntimeException $exception) {
            if ($order) {
                $credit = $walletLedger->credit($user->id, $wallet, $validated['amount'], function ($lockedUser, $balanceBefore, $balanceAfter) use ($reference, $validated) {
                    $transaction = new Transaction();
                    $transaction->user_id = $lockedUser->id;
                    $transaction->amount = $validated['amount'];
                    $transaction->post_balance = $balanceAfter;
                    $transaction->charge = 0;
                    $transaction->trx_type = '+';
                    $transaction->details = 'PayVessel bill payment reversal';
                    $transaction->trx = $reference;
                    $transaction->remark = 'bill_payment_refund';
                    $transaction->save();
                });
                $order->status = 'failed';
                $order->details = $exception->getMessage();
                $order->balance_after = $credit['balance_after'];
                $order->save();
            }

            return response()->json(['ok' => false, 'status' => 'danger', 'message' => $exception->getMessage()], 400);
        }
    }

    private function ensureSelected(): void
    {
        abort_unless(gs()->bills_provider === 'PAYVESSEL', 404);
    }
}
