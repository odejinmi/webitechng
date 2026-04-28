<?php

namespace App\Http\Controllers;

use App\Models\RndTokenPurchase;
use App\Models\RndExchangeRate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class RndTokenPurchaseController extends Controller
{

    public function __construct()
    {
        $this->activeTemplate = activeTemplate();
    }

    public function index()
    {
        $purchases = RndTokenPurchase::where('user_id', Auth::id())
            ->latest()
            ->paginate(getPaginate());
        $activeTemplate = checkTemplate();
        $data['activeTemplate'] = $activeTemplate;
        $data['activeTemplateTrue'] = checkTemplate(true);
        $pageTitle = 'RMB Token Purchases';
        return view($activeTemplate. 'user.rnd_purchases.index', $data, compact('purchases', 'pageTitle'));
    }

    public function create()
    {
        $pageTitle = 'Buy RMB Tokens';
        $activeTemplate = checkTemplate();
        $data['activeTemplate'] = $activeTemplate;
        $data['activeTemplateTrue'] = checkTemplate(true);
        $currentRate = RndExchangeRate::getCurrentRate();
        return view($activeTemplate. 'user.rnd_purchases.create', $data, compact('pageTitle', 'currentRate'));
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

        // Send notification
        notify($user, 'RND_PURCHASE_SUBMITTED', [
            'rnd_amount' => $purchase->rnd_amount,
            'total_amount' => $purchase->total_amount,
            'vendor_name' => $purchase->vendor_name,
        ]);

        $notify[] = ['success', 'RMB purchase request submitted successfully'];
        return redirect()->route('user.rnd.purchases.index')->withNotify($notify);
    }

    public function show(RndTokenPurchase $purchase)
    {
        if ($purchase->user_id != Auth::id()) {
            abort(404);
        }
        $activeTemplate = checkTemplate();
        $data['activeTemplate'] = $activeTemplate;
        $data['activeTemplateTrue'] = checkTemplate(true);

        $pageTitle = 'RMB Purchase Details';
        return view($activeTemplate. 'user.rnd_purchases.show', $data, compact('purchase', 'pageTitle'));
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
