<?php

namespace App\Http\Controllers;

use App\Models\RndTokenPurchase;
use App\Models\RndExchangeRate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminRndTokenController extends Controller
{
    public function index()
    {
        $purchases = RndTokenPurchase::with('user')
            ->latest()
            ->paginate(getPaginate());

        $pageTitle = 'RND Token Purchase Requests';
        return view('admin.rnd_purchases.index', compact('purchases', 'pageTitle'));
    }

    public function show(RndTokenPurchase $purchase)
    {
        $pageTitle = 'RND Purchase Details';
        $currentRate = RndExchangeRate::getCurrentRate();
        return view('admin.rnd_purchases.show', compact('purchase', 'pageTitle', 'currentRate'));
    }

    public function processRequest(Request $request, RndTokenPurchase $purchase)
    {
        if ($purchase->status !== 'processing') {
            $notify[] = ['error', 'This request cannot be processed'];
            return back()->withNotify($notify);
        }

        $request->validate([
            'exchange_rate' => 'required|numeric|min:0.00000001',
        ]);

        $exchangeRate = $request->exchange_rate;
        $totalAmount = $purchase->rnd_amount * $exchangeRate;
        $user = $purchase->user;

        if ($user->balance < $totalAmount) {
            $notify[] = ['error', 'User has insufficient balance for this transaction'];
            return back()->withNotify($notify);
        }

        $user->balance -= $totalAmount;
        $user->save();

        $purchase->exchange_rate = $exchangeRate;
        $purchase->total_amount = $totalAmount;
        $purchase->status = 'pending';
        $purchase->save();

        $notify[] = ['success', 'Request processed successfully. Amount deducted from user wallet'];
        return back()->withNotify($notify);
    }

    public function approve(Request $request, RndTokenPurchase $purchase)
    {
        if ($purchase->status !== 'pending') {
            $notify[] = ['error', 'This request cannot be approved'];
            return back()->withNotify($notify);
        }

        $request->validate([
            'receipt' => 'required|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        $receipt = null;
        if ($request->hasFile('receipt')) {
            $receipt = fileUploader($request->receipt, getFilePath('rnd_receipt'));
        }

        $purchase->receipt = $receipt;
        $purchase->status = 'approved';
        $purchase->save();

        // Send notification
        notify($purchase->user, 'RND_PURCHASE_APPROVED', [
            'rnd_amount' => $purchase->rnd_amount,
            'total_amount' => $purchase->total_amount,
            'vendor_name' => $purchase->vendor_name,
        ]);

        $notify[] = ['success', 'RND purchase approved successfully'];
        return back()->withNotify($notify);
    }

    public function decline(Request $request, RndTokenPurchase $purchase)
    {
        if ($purchase->status !== 'pending') {
            $notify[] = ['error', 'This request cannot be declined'];
            return back()->withNotify($notify);
        }

        $request->validate([
            'admin_note' => 'required|string|max:500',
        ]);

        $user = $purchase->user;
        $user->balance += $purchase->total_amount;
        $user->save();

        $purchase->status = 'declined';
        $purchase->admin_note = $request->admin_note;
        $purchase->save();

        // Send notification
        notify($purchase->user, 'RND_PURCHASE_DECLINED', [
            'rnd_amount' => $purchase->rnd_amount,
            'total_amount' => $purchase->total_amount,
            'admin_note' => $request->admin_note,
        ]);

        $notify[] = ['success', 'RND purchase declined and amount refunded'];
        return back()->withNotify($notify);
    }

    public function exchangeRate()
    {
        $pageTitle = 'RND Exchange Rate Management';
        $currentRate = RndExchangeRate::getCurrentRate();
        $rateHistory = RndExchangeRate::with('updatedBy')
            ->latest()
            ->take(10)
            ->get();

        return view('admin.rnd_purchases.exchange_rate', compact('pageTitle', 'currentRate', 'rateHistory'));
    }

    public function updateExchangeRate(Request $request)
    {
        $request->validate([
            'rate' => 'required|numeric|min:0.00000001',
            'notes' => 'nullable|string|max:500',
        ]);

        RndExchangeRate::updateRate(
            $request->rate,
            $request->notes,
            Auth::guard('admin')->id()
        );

        $notify[] = ['success', 'RND exchange rate updated successfully'];
        return back()->withNotify($notify);
    }

    public function downloadPaymentProof(RndTokenPurchase $purchase)
    {
        if (!$purchase->payment_proof) {
            abort(404);
        }

        $filePath = getFilePath('rnd_payment_proof') . '/' . $purchase->payment_proof;
        if (!file_exists($filePath)) {
            abort(404);
        }

        return response()->download($filePath);
    }

    public function downloadReceipt(RndTokenPurchase $purchase)
    {
        if (!$purchase->receipt) {
            abort(404);
        }

        $filePath = getFilePath('rnd_receipt') . '/' . $purchase->receipt;
        if (!file_exists($filePath)) {
            abort(404);
        }

        return response()->download($filePath);
    }
}
