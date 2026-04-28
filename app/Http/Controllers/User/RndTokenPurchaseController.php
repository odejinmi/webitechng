<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\RndTokenPurchase;
use App\Models\RndExchangeRate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class RndTokenPurchaseController extends Controller
{
    public function index()
    {
        $purchases = RndTokenPurchase::where('user_id', Auth::id())
            ->latest()
            ->paginate(getPaginate());

        $pageTitle = 'RMB Token Purchases';
        return view(checkTemplate(). 'user.rnd_purchases.index', compact('purchases', 'pageTitle'));
    }

    public function create()
    {
        $pageTitle = 'Buy RMB Tokens';
        $currentRate = RndExchangeRate::getCurrentRate();
        return view(checkTemplate(). 'user.rnd_purchases.create', compact('pageTitle', 'currentRate'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'rnd_amount' => 'required|numeric|min:0.00000001',
            'vendor_name' => 'required|string|max:255',
            'vendor_payment_details' => 'required|string|max:1000',
            'payment_proof' => 'required|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        $user = Auth::user();

        $rndAmount = $request->rnd_amount;
        $exchangeRate = RndExchangeRate::getCurrentRate();
        $totalAmount = $rndAmount * $exchangeRate;

        if ($user->balance < $totalAmount) {
            $notify[] = ['error', 'Insufficient balance in your wallet'];
            return back()->withNotify($notify);
        }

        $paymentProof = null;
        if ($request->hasFile('payment_proof')) {
            $paymentProof = fileUploader($request->payment_proof, getFilePath('rnd_payment_proof'));
        }

        // Deduct amount from user wallet and log transaction
        $debit = walletAtomicDebit($user->id, 'main', $totalAmount);
        $user->refresh();

        // Create debit transaction
        $transaction = new Transaction();
        $transaction->user_id = $user->id;
        $transaction->amount = $totalAmount;
        $transaction->balance_before = $debit['balance_before'];
        $transaction->balance_after = $debit['balance_after'];
        $transaction->post_balance = $user->balance;
        $transaction->charge = 0;
        $transaction->trx_type = '-';
        $transaction->details = 'RMB Token Purchase - ' . $rndAmount . ' RMB';
        $transaction->remark = 'rnd_purchase';
        $transaction->save();

        $purchase = RndTokenPurchase::create([
            'user_id' => $user->id,
            'rnd_amount' => $rndAmount,
            'exchange_rate' => $exchangeRate,
            'total_amount' => $totalAmount,
            'vendor_name' => $request->vendor_name,
            'vendor_payment_details' => $request->vendor_payment_details,
            'payment_proof' => $paymentProof,
            'status' => 'processing',
        ]);

        $notify[] = ['success', 'RMB purchase request submitted successfully'];
        return redirect()->route('user.rnd.purchases.index')->withNotify($notify);
    }

    public function show(RndTokenPurchase $purchase)
    {
        if ($purchase->user_id != Auth::id()) {
            abort(404);
        }

        $pageTitle = 'RMB Purchase Details';
        return view(checkTemplate(). 'user.rnd_purchases.show', compact('purchase', 'pageTitle'));
    }

    public function downloadReceipt(RndTokenPurchase $purchase)
    {
        if ($purchase->user_id != Auth::id() || !$purchase->receipt) {
            abort(404);
        }

        $filePath = getFilePath('rnd_receipt') . '/' . $purchase->receipt;
        if (!file_exists($filePath)) {
            abort(404);
        }

        return response()->download($filePath);
    }
}
