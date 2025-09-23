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
use Carbon\Carbon;
use Illuminate\Http\Request;


class ApiController extends Controller
{



   public function cryptoWallet(Request $request)
    {
        // return response()->json(['status'=>true,'message'=>'Wallet Credited Successfuly'],200);

        try {

            $input = $request->all();
            \Log::info('COINREMITTER'. __LINE__ .': '.json_encode($input) ."\n");
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
                CURLOPT_SSL_VERIFYHOST => false,
                CURLOPT_SSL_VERIFYPEER => false,
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
                \Log::info('COINREMITTER'. __LINE__ .': Wallet Credited Successfuly');
            }
            elseif(!$u){
                return response()->json(['status'=>true,'message'=>'Wallet Not Founds'],200);
                \Log::info('COINREMITTER'. __LINE__ .': Wallet Not Found');
            }
            else{
                return response()->json(['status'=>true,'message'=>'Transaction Not Found'],200);
                \Log::info('COINREMITTER'. __LINE__ .': Transaction Not Found');

            }

        } catch (\Throwable $th) {
            \Log::info('COINREMITTER'. __LINE__ .': '.$th->getMessage() ."\n");
            return response()->json(['status'=>true,'message'=>$th->getMessage()],200);
            throw new \Exception($th->getMessage());
        }
    }

    public function strowalletwebhook(Request $request)
	{
        $json = file_get_contents('php://input');
        $input = json_decode($json, true);
        if(!isset($input['sessionId']) || !isset($input['sourceAccountNumber'])) {
			return response()->json(["error" => "Invalid Input"]);
		}
        $fee = env('DEDICATEDACCOUNTFEE');
        $nuban = User::whereNubanRef($input['accountNumber'])->firstOrFail();
        $exist = Transaction::whereUserId($nuban->id)->whereTrx($input['sessionId'])->first();
        if($exist)
        {
            return response()->json(["error" => "Duplicate Transaction"]);
        }

        $commission = (@$input['transactionAmount'] / 100) * @$fee;
        $credit = $input['transactionAmount'] - $commission;
        $nuban->balance += $credit; // $input['transactionAmount'];
        $nuban->save();
        $nuban = User::whereNubanRef($input['accountNumber'])->firstOrFail();

        $transaction               = new Transaction();
        $transaction->user_id      = $nuban->id;
        $transaction->amount       = round($credit);
        $transaction->val_1        = json_encode($input);
        $transaction->post_balance = $nuban->balance;
        $transaction->charge       = round($commission);
        $transaction->trx_type     = '+';
        $transaction->details      = 'Wallet funding via dedicated account number';
        $transaction->trx          = $input['sessionId'];
        $transaction->remark       = 'Funding via dedicated account number';
        $transaction->save();

        $transaction1               = new Transaction();
        $transaction1->user_id      = $nuban->id;
        $transaction1->amount       = round($fee);
        $transaction1->post_balance = $nuban->balance;
        $transaction1->charge       = round(0.0);
        $transaction1->trx_type     = '-';
        $transaction1->details      = 'Charges for Wallet funding via dedicated account number';
        $transaction1->trx          = $input['trx'];
        $transaction1->val_1          = json_encode($input);
        $transaction1->remark       = 'Charges for Funding via dedicated account number';
        $transaction1->save();
        return response()->json(["success" => "Wallet Updated"]);

	}

    public function paylonywebhook(Request $request)
	{
        $json = file_get_contents('php://input');
        $input = json_decode($json, true);
        if(!isset($input['reference']) || !isset($input['customer_reference'])) {
            return response()->json(['status'=>false,'message'=>'Invalid Input'],400);
		}
        $fee = env('DEDICATEDACCOUNTFEE');
        $nuban = User::whereNubanRef($input['customer_reference'])->firstOrFail();

        $exist = Transaction::whereUserId($nuban->id)->whereTrx($input['trx'])->first();
        if($exist)
        {
            return response()->json(['status'=>false,'message'=>'Duplicate Transaction'],400);
        }

        if($input['type'] == 'reserved_account')
        {
        //VALIDATE TRANSACTIONS
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.paylony.com/api/v1/transaction_verify/'.$input['trx'],
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_POSTFIELDS =>'',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Authorization: Bearer '.env('PAYLONYSK')
        ),
        ));
        $response = curl_exec($curl);
        $reply = json_decode($response,true);
        curl_close($curl);
        if(!isset($reply['data']['status']))
        {
            return response()->json(["error" => "OOPS!".json_encode($reply['message'])]);
        }
        if($reply['data']['status'] != 'success')
        {
            return response()->json(["error" => "OOPS!!".json_encode($reply['message'])]);
        }

        // END VALIDATE TRANSACTION
        $nuban = User::whereNubanRef($input['customer_reference'])->firstOrFail();
        $accountnumber = json_decode($nuban->nuban)->account_number;
        if($accountnumber != $input['receiving_account'])
        {
            return response()->json(["error" => "OOPS!! Intruition detected"]);
        }
        $commission = (@$input['amount'] / 100) * @$fee;
        $credit = $input['amount'] - $commission;
        $nuban->balance += $credit; // $input['transactionAmount'];
        $nuban->save();

        $transaction               = new Transaction();
        $transaction->user_id      = $nuban->id;
        $transaction->amount       = round($credit);
        $transaction->val_1        = json_encode($input);
        $transaction->post_balance = $nuban->balance;
        $transaction->charge       = round($commission);
        $transaction->trx_type     = '+';
        $transaction->details      = 'Wallet funding via dedicated account number';
        $transaction->trx          = $input['trx'];
        $transaction->val_1          = json_encode($input);
        $transaction->remark       = 'Funding via dedicated account number';
        $transaction->save();

        $transaction1               = new Transaction();
        $transaction1->user_id      = $nuban->id;
        $transaction1->amount       = round($fee);
        $transaction1->post_balance = $nuban->balance;
        $transaction1->charge       = round(0.0);
        $transaction1->trx_type     = '-';
        $transaction1->details      = 'Charges for Wallet funding via dedicated account number';
        $transaction1->trx          = $input['trx'];
        $transaction1->val_1          = json_encode($input);
        $transaction1->remark       = 'Charges for Funding via dedicated account number';
        $transaction1->save();
        return response()->json(['status'=>true,'message'=>'Wallet Updated Successfuly'],200);
    }
        return response()->json(['status'=>false,'message'=>'TRX Not Dedicated Account Number Funding'],400);
	}

    public function payvesselwebhook()
    {
        $json = file_get_contents('php://input');
        $input = json_decode($json, true);
        \Log::info('PAYVESSEL'. __LINE__ .': '.json_encode($input) ."\n");


        $remoteIp = $_SERVER['REMOTE_ADDR'];
        $forwardedFor = $_SERVER['HTTP_X_FORWARDED_FOR'];

        \Log::info('PAYVESSEL'. __LINE__ .': '.json_encode($input) ."\n");
        \Log::info('PAYVESSEL_IP'. __LINE__ .': X-Forwarded-For: '.$forwardedFor ."\n");
        \Log::info('MY_SERVER_IP'. __LINE__ .':Remote IP: '.$remoteIp ."\n");

        // Process the IPN data...
        $current_ip = "162.246.254.36";
        $updated_ip = "3.255.23.38";
        if($forwardedFor != $current_ip  && $forwardedFor != $updated_ip)
        {
            \Log::info('WRONG_IP_ADDRESS_SENT_WEBHOOK'. __LINE__ .':WEBHOOK IP ADDRESS: '.$forwardedFor ."\n");
            return response()->json(['status'=>false,'message'=>'Wrond Server IP '.$updated_ip.'-'.$forwardedFor],400);

        }


        $account_ref = $input['virtualAccount']['virtualAccountNumber'];
        $account_email = $input['customer']['email'];
        $transaction_type = 'NUBAN';
        $transaction_ref = $input['transaction']['reference'];
        $payment_ref = $input['transaction']['reference'];
        $payment_from = $input['sender']['senderAccountNumber'];
        $amount = $input['order']['amount'];
        $transaction = Transaction::whereTrx($transaction_ref)->first();
        $fee = env('DEDICATEDACCOUNTFEE');

        if($transaction)
        {
            return response()->json(['status'=>false,'message'=>'Transaction Already Processed'],400);
        }
        $user = User::whereNubanRef($account_ref)->whereEmail($account_email)->firstOrFail();

        //$commission = (@$amount / 100) * @$fee;
        $commission = $fee;
        $credit = $amount - $commission;

        $user->balance += $credit;
        $user->save();


        $transaction               = new Transaction();
        $transaction->user_id      = $user->id;
        $transaction->amount       = round($credit);
        $transaction->val_1        = json_encode($input);
        $transaction->post_balance = $user->balance;
        $transaction->charge       = round($commission);
        $transaction->trx_type     = '+';
        $transaction->details      = 'Wallet funding via dedicated account number';
        $transaction->trx          = $transaction_ref;
        $transaction->remark       = 'Funding via dedicated account number';
        $transaction->save();

        $transaction1               = new Transaction();
        $transaction1->user_id      = $user->id;
        $transaction1->amount       = round($fee);
        $transaction1->post_balance = $user->balance;
        $transaction1->charge       = round(0.0);
        $transaction1->trx_type     = '-';
        $transaction1->details      = 'Charges for Wallet funding via dedicated account number';
        $transaction1->trx          = $input['trx'];
        $transaction1->val_1          = json_encode($input);
        $transaction1->remark       = 'Charges for Funding via dedicated account number';
        $transaction1->save();
        \Log::info('TRANSACION_COMPLETED WITH '. __LINE__ .':WEBHOOK IP ADDRESS: '.$forwardedFor ."\n");

        return response()->json(['status'=>true,'message'=>'Transaction Completed Successfuly '],200);
    }


    public function monnifywebhook()
    {
        $json = file_get_contents('php://input');
        $input = json_decode($json, true);
        $account_ref = $input['eventData']['product']['reference'];
        $transaction_type = $input['eventData']['product']['type'];
        $transaction_ref = $input['eventData']['transactionReference'];
        $payment_ref = $input['eventData']['paymentReference'];
        $payment_from = $input['eventData']['paymentSourceInformation'];
        $amount = $input['eventData']['amountPaid'];
        $transaction = Transaction::whereTrx($transaction_ref)->first();
        $fee = env('DEDICATEDACCOUNTFEE');

        if($transaction)
        {
            return response()->json(['status'=>false,'message'=>'Transaction Already Processed'],400);
        }
        $user = User::whereAccountRef($account_ref)->firstOrFail();
        $user->balance += $amount;
        $user->save();
        $user = User::whereAccountRef($account_ref)->firstOrFail();

        $commission = (@$amount / 100) * @$fee;
        $credit = $amount - $commission;

        $transaction               = new Transaction();
        $transaction->user_id      = $user->id;
        $transaction->amount       = round($credit);
        $transaction->val_1        = json_encode($input);
        $transaction->post_balance = $user->balance;
        $transaction->charge       = round($commission);
        $transaction->trx_type     = '+';
        $transaction->details      = 'Wallet funding via dedicated account number';
        $transaction->trx          = $transaction_ref;
        $transaction->remark       = 'Funding via dedicated account number';
        $transaction->save();

        $transaction1               = new Transaction();
        $transaction1->user_id      = $user->id;
        $transaction1->amount       = round($fee);
        $transaction1->post_balance = $user->balance;
        $transaction1->charge       = round(0.0);
        $transaction1->trx_type     = '-';
        $transaction1->details      = 'Charges for Wallet funding via dedicated account number';
        $transaction1->trx          = $input['trx'];
        $transaction1->val_1          = json_encode($input);
        $transaction1->remark       = 'Charges for Funding via dedicated account number';
        $transaction1->save();
        return response()->json(['status'=>true,'message'=>'Transaction Completed Successfuly'],200);
    }

    public function vpaywebhook()
    {
        $json = file_get_contents('php://input');
        $input = json_decode($json, true);
        $transaction_type = 'NUBAN';
        $transaction_ref = $input['reference'];
        $session_id = $input['session_id'];
        $account_number = $input['account_number'];
        $amount = $input['amount'];
        $timestamp = $input['timestamp'];
        $originator_account_name = $input['originator_account_name'];
        $originator_account_number = $input['originator_account_number'];
        $originator_bank = $input['originator_bank'];
        $transaction = Transaction::whereTrx($transaction_ref)->first();
        if($transaction)
        {
            return response()->json(['status'=>false,'message'=>'Transaction already processed'],400);
        }
        $customer = Customer::whereAccountNumber($account_number)->first();
        if(!$customer)
        {
            return response()->json(['status'=>false,'message'=>'Customer NUBAN Not Found'],400);
        }
        $user = User::whereId($customer->user_id)->first();
        if(!$user)
        {
            return response()->json(['status'=>false,'message'=>'Merchant Account Not Found'],400);
        }

        $fee = env('VPAY_ACCOUNT_FEE');
        $commission = (@$amount / 100) * @$fee;
        $credit = $amount - $commission;
        $user->balance += $credit;
        $user->save();

        $transaction               = new Transaction();
        $transaction->user_id      = $user->id;
        $transaction->amount       = round($credit);
        $transaction->val_1        = json_encode($input);
        $transaction->post_balance = $user->balance;
        $transaction->charge       = round($commission);
        $transaction->trx_type     = '+';
        $transaction->details      = 'Wallet funding via API using virtual account number';
        $transaction->trx          = $transaction_ref;
        $transaction->remark       = 'Funding via dedicated virtual account number';
        $transaction->save();

        $transaction1               = new Transaction();
        $transaction1->user_id      = $user->id;
        $transaction1->amount       = round($fee);
        $transaction1->post_balance = $user->balance;
        $transaction1->charge       = round(0.0);
        $transaction1->trx_type     = '-';
        $transaction1->details      = 'Charges for Wallet funding via dedicated account number';
        $transaction1->trx          = $input['trx'];
        $transaction1->val_1          = json_encode($input);
        $transaction1->remark       = 'Charges for Funding via dedicated account number';
        $transaction1->save();
        //SEND WEBHOOK NOTIFICATION START;
            $url = $user->webhook_url;
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
            $headers = array(
                "Authorization: Token ".$user->api_key."",
                "Content-Type: application/json",
            );
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
            $code = getTrx();
            $data = <<<DATA
            {
                "amount_requested": "$amount",
                "transaction_fee": "$commission",
                "amount_credited": "$credit",
                "transaction_ref": "$transaction_ref",
                "credit_account_number": "$account_number",
                "originator_account_name": "$originator_account_name",
                "originator_account_number": "$originator_account_number",
                "originator_bank": "$originator_bank",
                "transaction_date": "$timestamp"
            }
            DATA;
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            //for debug only!
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            $resp = curl_exec($curl);
            curl_close($curl);
            //var_dump($resp);
        //END SEND WEBHOOK NOTIFCATION
        return response()->json(['status'=>true,'message'=>'Merchant Account Funded Successfuly'],200);

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
