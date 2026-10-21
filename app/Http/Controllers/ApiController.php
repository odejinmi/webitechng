<?php

namespace App\Http\Controllers;

use App\Constants\Status;
use App\Models\AdminNotification;
use App\Models\GeneralSetting;
use App\Models\Order;
use App\Models\Transaction;
use App\Models\Savings;
use App\Models\SavingPay;
use App\Models\User;
use App\Models\CronJob;
use App\Models\CronJobLog;
use App\Models\Cryptowallet;
use App\Models\Cryptocurrency;
use App\Models\Cryptotrx;
use App\Models\Fdr;
use App\Models\Admin;
use App\Models\Installment;
use App\Models\Customer;
use App\Support\PublicWebhookUrl;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;


class ApiController extends Controller
{



   public function cryptoWallet(Request $request)
    {
        // return response()->json(['status'=>true,'message'=>'Wallet Credited Successfuly'],200);

        try {

            $input = $request->all();
            $u = Cryptowallet::where('address', $input['address'])->first();

            if(isset($input['coin_short_name']))
            {
                $currency = Cryptocurrency::whereSymbol($input['coin_short_name'])->first();
            }

            if(isset($input['coin_symbol']))
            {
                $currency = Cryptocurrency::whereSymbol($input['coin_symbol'])->first();
            }

            $amount = $input['amount'];


//            $baseurl = "https://coinremitter.com/api/v3/get-coin-rate";
            $baseurl = "https://api.coinremitter.com/v1/rate/crypto-to-fiat";
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => $baseurl,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_SSL_VERIFYHOST => 2,
                CURLOPT_SSL_VERIFYPEER => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => array('fiat' => 'USD','crypto_amount' => $input['amount'],'crypto' => $input['coin_symbol']),
            ));
            $response = curl_exec($curl);
            $reply = json_decode($response,true);
            curl_close($curl);
//            $rate = $reply['data'][$currency->symbol]['price'];
//            $usd = $rate * $amount;
            $usd = $reply['data'][0]['amount'];

            $trxfee = $currency->api_trx_fee;
            $profee = (@$input['amount'] / 100) * @$currency->api_processing_fee; // Correct Calculation in precentage
            $fee = $profee+$trxfee;
            $amount = $input['amount'] - $fee;



            if ($u) {
                $receive = Cryptotrx::where('trxid', $input['id'])->whereType('receive')->first();
                //$send = Cryptotrx::where('trxid', $input['id'])->whereType('send')->first();

                if($input['type'] == 'receive')
                {
                    if(!$receive)
                    {
                        if ($input['confirmations'] == 2) {
                            $u->balance += $amount;
                            $u->usd += $usd;
                            $u->save();
                        }

                        $w['user_id'] = $u->user_id;
                        $w['coin_id'] = $u->coin_id;
                        $w['amount'] = $input['amount'];
                        $w['usd'] = $usd;
                        $w['address'] = $input['address'];
                        $w['type'] = $input['type'];
                        $w['trxid'] = $input['id'];
                        $w['hash'] = $input['txid'];
                        $w['explorer_url'] = $input['explorer_url'];
                        $w['wallet_id'] = $input['wallet_id'];
                        $w['status'] = $input['confirmations'];
                        $result = Cryptotrx::create($w);
                    }

                }
                if ($input['confirmations'] == 2) {
                    return response()->json(['status' => true, 'message' => 'Wallet Credited Successfuly'], 200);
                }else {
                    return response()->json(['status' => true, 'message' => 'Wallet Notify Successfuly'], 200);
                }
            }
            elseif(!$u){
                return response()->json(['status'=>true,'message'=>'Wallet Not Founds'],200);
            }
            else{
                return response()->json(['status'=>true,'message'=>'Transaction Not Found'],200);

            }

        } catch (\Throwable $th) {
            \Log::error('CoinRemitter webhook processing failed');
            return response()->json(['status' => false, 'message' => 'Unable to process webhook'], 500);
        }
    }

    public function strowalletwebhook(Request $request)
	{
        $input = $request->all();
        $sessionId = $input['sessionId'] ?? null;
        $accountNumber = $input['accountNumber'] ?? null;
        $amount = $input['transactionAmount'] ?? null;
        $publicKey = (string) env('STROPAYKEY');

        if (!$sessionId || !$accountNumber || !is_numeric($amount) || (float) $amount <= 0) {
			return response()->json(['status' => false, 'message' => 'Invalid webhook payload'], 400);
		}

        if ($publicKey === '') {
            return response()->json(['status' => false, 'message' => 'Provider key is not configured'], 503);
        }

        try {
            $verificationResponse = Http::connectTimeout(5)
                ->timeout(10)
                ->get('https://strowallet.com/api/verifysessionid/', [
                    'public_key' => $publicKey,
                    'amount' => $amount,
                    'sessionID' => $sessionId,
                ]);
        } catch (\Throwable $exception) {
            return response()->json(['status' => false, 'message' => 'Unable to verify transaction'], 502);
        }

        $verification = $verificationResponse->json();
        if (!$verificationResponse->successful()
            || !is_array($verification)
            || (($verification['success'] ?? true) === false)
            || (($verification['status'] ?? true) === false)) {
            return response()->json(['status' => false, 'message' => 'Transaction verification failed'], 400);
        }

        $verified = is_array($verification['data'] ?? null) ? $verification['data'] : $verification;
        $verifiedSession = $verified['sessionId'] ?? $verified['sessionID'] ?? null;
        $verifiedAccount = $verified['accountNumber'] ?? null;
        $verifiedAmount = $verified['transactionAmount'] ?? $verified['amount'] ?? null;
        if (($verifiedSession !== null && (string) $verifiedSession !== (string) $sessionId)
            || ($verifiedAccount !== null && (string) $verifiedAccount !== (string) $accountNumber)
            || ($verifiedAmount !== null && (!is_numeric($verifiedAmount) || (float) $verifiedAmount !== (float) $amount))) {
            return response()->json(['status' => false, 'message' => 'Transaction verification mismatch'], 400);
        }

        $feePercentage = (float) env('DEDICATEDACCOUNTFEE', 0);
        $commission = ((float) $amount / 100) * $feePercentage;
        $credit = (float) $amount - $commission;
        if ($credit <= 0) {
            return response()->json(['status' => false, 'message' => 'Invalid transaction amount'], 400);
        }

        $processed = DB::transaction(function () use ($accountNumber, $sessionId, $credit, $commission, $input) {
            $user = User::whereNubanRef($accountNumber)->lockForUpdate()->firstOrFail();

            if (Transaction::whereTrx($sessionId)->exists()) {
                return false;
            }

            $user->balance += $credit;
            $user->save();

            $transaction = new Transaction();
            $transaction->user_id = $user->id;
            $transaction->amount = round($credit, 2);
            $transaction->val_1 = json_encode($input);
            $transaction->post_balance = $user->balance;
            $transaction->charge = round($commission, 2);
            $transaction->trx_type = '+';
            $transaction->details = 'Wallet funding via dedicated account number';
            $transaction->trx = $sessionId;
            $transaction->remark = 'Funding via dedicated account number';
            $transaction->save();

            return true;
        });

        return response()->json([
            'status' => true,
            'message' => $processed ? 'Wallet updated successfully' : 'Transaction already processed',
        ]);

	}

    public function paylonywebhook(Request $request)
	{
        $input = $request->all();
        $transactionReference = $input['trx'] ?? null;
        $customerReference = $input['customer_reference'] ?? null;
        $receivingAccount = $input['receiving_account'] ?? null;
        $providerKey = (string) env('PAYLONYSK');

        if (($input['type'] ?? null) !== 'reserved_account'
            || !$transactionReference
            || !$customerReference
            || !$receivingAccount
            || $providerKey === '') {
            return response()->json(['status' => false, 'message' => 'Invalid webhook payload'], 400);
		}

        try {
            $verificationResponse = Http::connectTimeout(5)
                ->timeout(10)
                ->withToken($providerKey)
                ->get('https://api.paylony.com/api/v1/transaction_verify/'.rawurlencode($transactionReference));
        } catch (\Throwable $exception) {
            return response()->json(['status' => false, 'message' => 'Unable to verify transaction'], 502);
        }

        $reply = $verificationResponse->json();
        $verified = $reply['data'] ?? [];
        $verifiedAmount = $verified['amount'] ?? $verified['transaction_amount'] ?? null;
        $verifiedAccount = $verified['receiving_account'] ?? $verified['account_number'] ?? null;

        if (!$verificationResponse->successful()
            || ($verified['status'] ?? null) !== 'success'
            || !is_numeric($verifiedAmount)
            || ($verifiedAccount !== null && (string) $verifiedAccount !== (string) $receivingAccount)) {
            return response()->json(['status' => false, 'message' => 'Transaction verification failed'], 400);
        }

        $amount = (float) $verifiedAmount;
        $feePercentage = (float) env('DEDICATEDACCOUNTFEE', 0);
        $commission = ($amount / 100) * $feePercentage;
        $credit = $amount - $commission;
        if ($credit <= 0) {
            return response()->json(['status' => false, 'message' => 'Invalid transaction amount'], 400);
		}

        $processed = DB::transaction(function () use ($customerReference, $receivingAccount, $transactionReference, $credit, $commission, $input) {
            $user = User::whereNubanRef($customerReference)->lockForUpdate()->firstOrFail();
            $accountData = json_decode($user->nuban, true);

            if ((string) ($accountData['account_number'] ?? '') !== (string) $receivingAccount) {
                abort(400, 'Receiving account does not match');
            }

            if (Transaction::whereTrx($transactionReference)->exists()) {
                return false;
            }

            $user->balance += $credit;
            $user->save();

            $transaction = new Transaction();
            $transaction->user_id = $user->id;
            $transaction->amount = round($credit, 2);
            $transaction->val_1 = json_encode($input);
            $transaction->post_balance = $user->balance;
            $transaction->charge = round($commission, 2);
            $transaction->trx_type = '+';
            $transaction->details = 'Wallet funding via dedicated account number';
            $transaction->trx = $transactionReference;
            $transaction->remark = 'Funding via dedicated account number';
            $transaction->save();

            return true;
        });

        return response()->json([
            'status' => true,
            'message' => $processed ? 'Wallet updated successfully' : 'Transaction already processed',
        ]);
	}

    public function payvesselwebhook(Request $request)
    {
        $payload = $request->getContent();
        $secret = (string) config('payvessel.api_secret');
        $signature = (string) ($request->header('Payvessel-Http-Signature')
            ?? $request->header('HTTP_PAYVESSEL_HTTP_SIGNATURE', ''));
        $sourceIp = $request->ip();
        $trustedIps = config('payvessel.webhook_ips', []);

        if ($secret === '') {
            return response()->json(['status' => false, 'message' => 'Webhook secret is not configured'], 503);
        }

        $expectedSignature = hash_hmac('sha512', $payload, $secret);
        if ($signature === '' || !hash_equals($expectedSignature, $signature) || !in_array($sourceIp, $trustedIps, true)) {
            \Log::warning('Rejected PayVessel webhook', ['ip' => $sourceIp]);
            return response()->json(['status' => false, 'message' => 'Invalid webhook signature or source'], 400);
        }

        $input = json_decode($payload, true);
        $accountNumber = $input['virtualAccount']['virtualAccountNumber'] ?? null;
        $accountEmail = $input['customer']['email'] ?? null;
        $transactionReference = $input['transaction']['reference'] ?? null;
        $amount = $input['order']['amount'] ?? null;

        if (!$accountNumber || !$accountEmail || !$transactionReference || !is_numeric($amount)) {
            return response()->json(['status' => false, 'message' => 'Invalid webhook payload'], 400);
        }

        $fee = (float) env('DEDICATEDACCOUNTFEE', 0);
        $credit = (float) $amount - $fee;
        if ($credit <= 0) {
            return response()->json(['status' => false, 'message' => 'Invalid transaction amount'], 400);
        }

        $processed = DB::transaction(function () use ($accountNumber, $accountEmail, $transactionReference, $credit, $fee, $input) {
            $user = User::whereNubanRef($accountNumber)
                ->whereEmail($accountEmail)
                ->lockForUpdate()
                ->firstOrFail();

            if (Transaction::whereTrx($transactionReference)->exists()) {
                return false;
            }

            $user->balance += $credit;
            $user->save();

            $transaction = new Transaction();
            $transaction->user_id = $user->id;
            $transaction->amount = round($credit, 2);
            $transaction->val_1 = json_encode($input);
            $transaction->post_balance = $user->balance;
            $transaction->charge = round($fee, 2);
            $transaction->trx_type = '+';
            $transaction->details = 'Wallet funding via dedicated account number';
            $transaction->trx = $transactionReference;
            $transaction->remark = 'Funding via dedicated account number';
            $transaction->save();

            return true;
        });

        if (!$processed) {
            return response()->json(['status' => true, 'message' => 'Transaction already processed']);
        }

        \Log::info('PayVessel webhook processed', ['reference' => $transactionReference, 'ip' => $sourceIp]);
        return response()->json(['status' => true, 'message' => 'Transaction completed successfully']);
    }


    public function monnifywebhook(Request $request)
    {
        $payload = $request->getContent();
        $secret = (string) config('monnify.secret_key');
        $signature = (string) $request->header('monnify-signature', '');
        $sourceIp = $request->ip();

        if ($secret === '') {
            return response()->json(['status' => false, 'message' => 'Webhook secret is not configured'], 503);
        }

        $expectedSignature = hash_hmac('sha512', $payload, $secret);
        if ($signature === '' || !hash_equals($expectedSignature, $signature) || !in_array($sourceIp, config('monnify.webhook_ips', []), true)) {
            \Log::warning('Rejected Monnify webhook', ['ip' => $sourceIp]);
            return response()->json(['status' => false, 'message' => 'Invalid webhook signature or source'], 400);
        }

        $input = json_decode($payload, true);
        $eventData = $input['eventData'] ?? [];
        $accountReference = $eventData['product']['reference'] ?? null;
        $transactionReference = $eventData['transactionReference'] ?? null;
        $amount = $eventData['amountPaid'] ?? null;

        if (($input['eventType'] ?? null) !== 'SUCCESSFUL_TRANSACTION'
            || ($eventData['paymentStatus'] ?? null) !== 'PAID'
            || !$accountReference
            || !$transactionReference
            || !is_numeric($amount)
            || (float) $amount <= 0) {
            return response()->json(['status' => false, 'message' => 'Invalid webhook payload'], 400);
        }

        $feePercentage = (float) env('DEDICATEDACCOUNTFEE', 0);
        $commission = ((float) $amount / 100) * $feePercentage;
        $credit = (float) $amount - $commission;

        $processed = DB::transaction(function () use ($accountReference, $transactionReference, $credit, $commission, $input) {
            $user = User::whereAccountRef($accountReference)->lockForUpdate()->firstOrFail();

            if (Transaction::whereTrx($transactionReference)->exists()) {
                return false;
            }

            $user->balance += $credit;
            $user->save();

            $transaction = new Transaction();
            $transaction->user_id = $user->id;
            $transaction->amount = round($credit, 2);
            $transaction->val_1 = json_encode($input);
            $transaction->post_balance = $user->balance;
            $transaction->charge = round($commission, 2);
            $transaction->trx_type = '+';
            $transaction->details = 'Wallet funding via dedicated account number';
            $transaction->trx = $transactionReference;
            $transaction->remark = 'Funding via dedicated account number';
            $transaction->save();

            return true;
        });

        if (!$processed) {
            return response()->json(['status' => true, 'message' => 'Transaction already processed']);
        }

        return response()->json(['status' => true, 'message' => 'Transaction completed successfully']);
    }

    public function vpaywebhook(Request $request)
    {
        $webhookSecret = (string) config('vpay.webhook_secret');
        $token = (string) $request->header('x-payload-auth', '');
        $segments = explode('.', $token);

        if ($webhookSecret === '') {
            return response()->json(['status' => false, 'message' => 'Webhook secret is not configured'], 503);
        }

        if (count($segments) !== 3) {
            return response()->json(['status' => false, 'message' => 'Invalid webhook authentication'], 401);
        }

        $encodedPayload = strtr($segments[1], '-_', '+/');
        $encodedPayload .= str_repeat('=', (4 - strlen($encodedPayload) % 4) % 4);
        $tokenPayload = json_decode(base64_decode($encodedPayload, true) ?: '', true);
        $tokenSecret = (string) ($tokenPayload['secret'] ?? '');

        if ($tokenSecret === '' || !hash_equals($webhookSecret, $tokenSecret)) {
            return response()->json(['status' => false, 'message' => 'Invalid webhook authentication'], 401);
        }

        $input = $request->all();
        $transactionReference = $input['reference'] ?? null;
        $sessionId = $input['session_id'] ?? null;
        $accountNumber = $input['account_number'] ?? null;
        $amount = $input['amount'] ?? null;

        if (!$transactionReference || !$sessionId || !$accountNumber || !is_numeric($amount) || (float) $amount <= 0) {
            return response()->json(['status' => false, 'message' => 'Invalid webhook payload'], 400);
        }

        $customer = Customer::whereAccountNumber($accountNumber)->first();
        if (!$customer) {
            return response()->json(['status' => false, 'message' => 'Customer NUBAN not found'], 404);
        }

        $feePercentage = (float) env('VPAY_ACCOUNT_FEE', 0);
        $commission = ((float) $amount / 100) * $feePercentage;
        $credit = (float) $amount - $commission;
        if ($credit <= 0) {
            return response()->json(['status' => false, 'message' => 'Invalid transaction amount'], 400);
        }

        $user = null;
        $processed = DB::transaction(function () use ($customer, $sessionId, $credit, $commission, $input, &$user) {
            $user = User::whereId($customer->user_id)->lockForUpdate()->firstOrFail();

            if (Transaction::whereTrx($sessionId)->exists()) {
                return false;
            }

            $user->balance += $credit;
            $user->save();

            $transaction = new Transaction();
            $transaction->user_id = $user->id;
            $transaction->amount = round($credit, 2);
            $transaction->val_1 = json_encode($input);
            $transaction->post_balance = $user->balance;
            $transaction->charge = round($commission, 2);
            $transaction->trx_type = '+';
            $transaction->details = 'Wallet funding via API using virtual account number';
            $transaction->trx = $sessionId;
            $transaction->remark = 'Funding via dedicated virtual account number';
            $transaction->save();

            return true;
        });

        if (!$processed) {
            return response()->json(['status' => true, 'message' => 'Transaction already processed']);
        }

        $url = $user->webhook_url;
        if ($url && PublicWebhookUrl::isAllowed($url)) {
            try {
                Http::connectTimeout(5)
                    ->timeout(10)
                    ->withoutRedirecting()
                    ->withToken($user->api_key, 'Token')
                    ->post($url, [
                        'amount_requested' => $amount,
                        'transaction_fee' => $commission,
                        'amount_credited' => $credit,
                        'transaction_ref' => $transactionReference,
                        'credit_account_number' => $accountNumber,
                        'originator_account_name' => $input['originator_account_name'] ?? null,
                        'originator_account_number' => $input['originator_account_number'] ?? null,
                        'originator_bank' => $input['originator_bank'] ?? null,
                        'transaction_date' => $input['timestamp'] ?? null,
                    ]);
            } catch (\Throwable $exception) {
                \Log::warning('Merchant webhook delivery failed', [
                    'user_id' => $user->id,
                    'transaction_ref' => $transactionReference,
                ]);
            }
        }

        return response()->json(['status' => true, 'message' => 'Merchant account funded successfully']);
    }


    public function savings(){

        try{
        $general = GeneralSetting::first();
        $target = Savings::where('status', 1)->where('mature', '<=', Carbon::now())->get();
        $recurrent = Savings::where('status', 1)->where('next_recurrent', '<=', Carbon::now())->get();
        //return $recurrent;
        foreach($target as $data)
        {
        $user = User::where('id', $data->user_id)->first();
        $user->balance += $data->balance ? $data->balance : 0;
        $user->save();

        $transaction = new Transaction();
        $transaction->user_id = $user->id;
        $transaction->amount =  $data->balance ? $data->balance : 0;
        $transaction->post_balance = $user->balance;
        $transaction->charge = 0;
        $transaction->trx_type = '+';
        $transaction->remark = 'savings';
        $transaction->details = 'Savings Credited To Wallet On Due Date';
        $transaction->trx = getTrx();
        $transaction->save();

        $data->status = 0;
        $data->balance = 0;
        $data->save();
        }

        foreach($recurrent as $recdata)
        {
        //return $recdata;

        $user = User::where('id', $recdata->user_id)->first();
        if($recdata->recurrent > $recdata->recurrent_count)
        {

             if($user->balance >= $recdata->amount)
             {
             $user->balance -= $recdata->amount;
             $user->save();

             $recdata->balance += $recdata->amount;
             $recdata->recurrent_count += 1;
             $recdata->next_recurrent = Carbon::parse(Carbon::now())->addDays($recdata->cycle);
             $recdata->save();

             $code = getTrx();
             $pay = new SavingPay();
             $pay->user_id = $user->id;
             $pay->saving_id = $recdata->reference;
             $pay->plan_id = $recdata->type;
             $pay->amount =  $recdata->amount;
             $pay->balance = $recdata->balance;
             $pay->trx = $code;
             $pay->status = 1;
             $pay->save();

             $transaction = new Transaction();
             $transaction->user_id = $user->id;
             $transaction->amount = $recdata->amount;
             $transaction->post_balance = $user->balance;
             $transaction->charge = 0;
             $transaction->trx_type = '-';
             $transaction->remark = 'savings';
             $transaction->details = 'Fund Debited From Wallet To Service Recurrent Savings';
             $transaction->trx = $code;
             $transaction->save();

             }

        }
             if($recdata->recurrent <= $recdata->recurrent_count)
             {
             $user->balance += $recdata->balance;
             $user->save();

             $recdata->status = 0;
             $recdata->balance = 0;
             $recdata->save();
             }


        }

    }
    catch(\Exception $ex){
        $admin = Admin::first();
        sendGeneralEmail($admin->email, $ex->getMessage(), $ex->getMessage(), '');
        \Log::error('CronController -> investment() line '. __LINE__ .': '.$ex->getMessage() ."\n");
    }
    return response()->json(['status'=>true,'message'=>'Cron Run Successfuly'],200);


}


    public function fixed()
    {
        try {
            $allFdr = Fdr::running()->whereDate('next_installment_date', '<=', now()->format('y-m-d'))->with('user:id,username,balance')->get();

            foreach ($allFdr as $fdr) {
                self::payFdrInstallment($fdr);
            }
            return response()->json(['status'=>true,'message'=>'Cron Run Successfuly'],200);

        } catch (\Throwable $th) {
            throw new \Exception($th->getMessage());
        }
    }

    public static function payFdrInstallment($fdr)
    {
        $amount                     = $fdr->per_installment;
        $user                       = $fdr->user;
        $fdr->next_installment_date = $fdr->next_installment_date->addDays($fdr->installment_interval);
        $fdr->profit += $amount;
        $fdr->save();

        $user->balance += $amount;
        $user->save();

        $installment                   = new Installment();
        $installment->installment_date = $fdr->next_installment_date->subDays($fdr->installment_interval);
        $installment->given_at         = now();
        $installment->user_id         = $user->id;
        $installment->amount         = $amount;
        $fdr->installments()->save($installment);

        $transaction               = new Transaction();
        $transaction->user_id      = $user->id;
        $transaction->amount       = $amount;
        $transaction->post_balance = $user->balance;
        $transaction->charge       = 0;
        $transaction->trx_type     = '+';
        $transaction->details      = 'Fixed Deposit Interest Received';
        $transaction->remark       = 'fixed_deposit_interest';
        $transaction->trx          = $fdr->fdr_number;
        $transaction->save();
    }




    public function cryptoWallets(Request $request)
    {
        $input = $request->all();
        $u = User::where('eth_wallet_address', $input['address'])->first();
       // $currency = Currency::whereSymbol($input['coin_short_name'])->first();
        $amount = $input['amount'];
        if ($u) {

            if($input['type'] == 'receive')
        {
            if(!$receive)
            {
            $u->eth_balance += $amount;
            $u->save();
            }

         }

         return response(['Message'=>'Wallet Credited'], 200);


        }
        elseif(!$us){
            return response(['Message'=>'Wallet Not Found'], 200);
        }
        else{
            return response(['Message'=>'Transaction Not Found'], 200);
        }
    }






}
