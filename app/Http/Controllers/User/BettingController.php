<?php

namespace App\Http\Controllers\User;

use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Lib\GoogleAuthenticator;
use App\Models\Order;
use App\Models\GeneralSetting;
 use App\Models\AdminNotification;
use App\Models\User;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use DB;
use Carbon\Carbon;
class BettingController extends Controller
{


    public function __construct()
    {
        $this->middleware('betting.status');
        $this->middleware('kyc.status');
        $this->activeTemplate = activeTemplate();
    }


    public function betting(Request $request)
    {
        $pageTitle       = 'Betting Service';
        $user = auth()->user();
        $activeTemplate = checkTemplate();
        $data['activeTemplate'] = $activeTemplate;

        return view($activeTemplate. 'user.bills.betting.index', $data,compact('pageTitle'));
    }

    public function fund_wallet(Request $request)
    {
        $encryption = hash_hmac('SHA512', 'Welcome to Tutorialspoint', 'any_secretkey');
        //return $encryption;
        $pageTitle = 'Sport Betting';
        $networks = json_decode(file_get_contents(resource_path('views/partials/betting.json')), true);
        $user = auth()->user();
        $data['bettinglog'] = Order::whereUserId($user->id)->whereType('betting')->searchable(['trx'])->orderBy('id', 'desc')->paginate(getPaginate());
        $data['value'] = Order::whereUserId($user->id)->whereType('betting')->sum('price');
        $data['count'] = Order::whereUserId($user->id)->whereType('betting')->count();
        $activeTemplate = checkTemplate();
        $data['activeTemplate'] = $activeTemplate;

        return view($activeTemplate. 'user.bills.betting.betting_buy', $data, compact('pageTitle','networks'));
    }

    public function verify_merchant(Request $request){

		$decoder = $request->decoder;
		$number = $request->number;
        $mode = env('MODE');
        $publickey = env('OPAYPUBLICKEY');
        $merchantid = env('OPAYMERCHANTID');
        $curl = curl_init();

        $json = file_get_contents('php://input');
        $input = json_decode($json, true);

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://cashierapi.opayweb.com/api/v3/bills/validate',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>'{
            "serviceType": "betting",
            "provider": "'.$request->merchant.'",
            "customerId": "'.$request->number.'"
        }',
        CURLOPT_HTTPHEADER => array(
            'MerchantId: '.$merchantid,
            'Content-Type: application/json',
            'Authorization: Bearer '.$publickey.''
        ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        $resp = curl_exec($curl);
        $reply = json_decode($resp, true);

    curl_close($curl);
    //$rep = json_encode($reply);
    if(!isset($reply['data']['customerId']))
    {
        return response()->json(['ok'=>false,'status'=>'danger','message'=> @json_encode($reply['message']).'Invalid Customer ID','content'=> 'INVALID'],200);

    }
    else
    {
        return response()->json(['ok'=>true,'status'=>'success','message'=> 'Valid Customer Number','content'=> @$reply['data']['firstName'].' '.@$reply['data']['lastName']],200);

    }

	}



    public function fund_wallet_post()
    {

        $user = auth()->user();
        $json = file_get_contents('php://input');
        $input = json_decode($json, true);
        $password = $input['password'];
        $amount = $input['amount'];
        $customername = $input['customerName'];
        $customerId = $input['customerId'];
        $wallet = @$input['wallet'];
        $companyId = @$input['companyId'];

        if (Hash::check($password, $user->trx_password)) {
            $passcheck = true;
            } else {
            $passcheck = false;
                return response()->json(['ok'=>false,'status'=>'danger','message'=> 'The password doesn\'t match!'],400);
            }


        $total = env('BETTINGCHARGE')+$amount;
        $payment = $total;
        $code = getTrx();
        if($wallet == 'main')
        {
            $balance = $user->balance;
        }
        else
        {
            $balance = $user->ref_balance;
        }
        if($payment > $balance)
        {
            return response()->json(['ok'=>false,'status'=>'danger','message'=> 'Insufficient wallet balance'],400);
        }

        $parseamount = $amount*100;
        $url = 'https://cashierapi.opayweb.com/api/v3/bills/bulk-bills';
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS =>'
        "bulkData": [
            {
              "amount": "'.$parseamount.'",
              "country": "NG",
              "currency": "NGN",
              "customerId": "'.$customerId.'",
              "provider": "'.$companyId.'",
              "reference": "'.$code.'"
            }
        ]',
      CURLOPT_HTTPHEADER => array(
    'Authorization: Basic '.env('OPAYPUBLICKEY'),
    'MerchantId: '.env('OPAYMERCHANTID'),
    'Content-Type: application/json',
      ),
    ));

    $resp = curl_exec($curl);
    $response = $resp;
    $reply = json_decode($resp, true);
    curl_close($curl);
    if(!isset($reply['code'] ))
    {
        return response()->json(['ok'=>false,'status'=>'danger','message'=> @json_encode($reply).'We cant processs this request at the moment'],400);
    }

    if(!isset($reply['bulkData'][0]['reference']))
    {
        return response()->json(['ok'=>false,'status'=>'danger','message'=> @json_encode($reply).'We cant processs this request at the moment'],400);

    }

        if($reply['bulkData'][0]['reference'])
        {
            if($wallet == 'main')
            {
                $user->balance -= $payment;
                $balance_after = $user->balance;
            }
            else
            {
                $user->ref_balance -= $payment;
                $balance_after = $user->ref_balance;
            }
           //return $reply;

            $user->save();
            $order               = new Order();
            $order->user_id      = $user->id;
            $order->type         =  'betting';
            $order->val_1   = $customerName;
            $order->val_2   = $customerId;
            $order->product_id   = @$customerId;
            $order->product_name = @$customerName;
            $order->product_logo = @$reply['bulkData'][0]['provider'];
            $order->details      = @json_encode($response,true);
            $order->quantity     = 1;
            $order->price        = @$reply['bulkData'][0]['amount'];
            $order->currency     = @$reply['bulkData'][0]['currency'];
            $order->status       = 'success';
            $order->payment      = @$payment;
            $order->trx          = @$code;
            $order->source       = $wallet;
            $order->balance_before  = $balance;
            $order->balance_after   = $balance_after;
            $order->transaction_id  = @$reply['bulkData'][0]['reference'];
            $order->save();


            $transaction               = new Transaction();
            $transaction->user_id      = $order->user_id;
            $transaction->amount       = $order->payment;
            $transaction->post_balance = $order->balance_after;
            $transaction->charge       = env('BETTINGCHARGE');
            $transaction->trx_type     = '-';
            $transaction->details      = 'Fund betting wallet via ' . strToUpper($wallet).' Wallet';
            $transaction->trx          = $order->trx;
            $transaction->remark       = 'betting';
            $transaction->save();

            notify($user,'BETTING_BUY', [
                'provider'        => @$customerId,
                'amount'          => @showAmount($payment),
                'product'         => @$plan,
                'beneficiary'     => @$customerName,
                'rate'            => @showAmount($payment),
                'purchase_at'     => @Carbon::now(),
                'trx'             => @$trx,
            ]);

            return response()->json(['ok'=>true,'status'=>'success','message'=> 'Transaction Was Successfull','orderid'=> $trx],200);
        }
        else
        {
            return response()->json(['ok'=>false,'status'=>'danger','message'=> json_encode($response). 'API ERROR'],400);
        }
        //return json_decode($resp,true);
    }

    public function history(Request $request)
    {
        $pageTitle       = 'Betting Log';
        $user = auth()->user();
        $log = Order::whereUserId($user->id)->whereType('betting')->searchable(['trx'])->orderBy('id', 'desc')->paginate(getPaginate());
        $activeTemplate = checkTemplate();
        $data['activeTemplate'] = $activeTemplate;

        return view($activeTemplate. 'user.bills.betting.betting_log', $data,compact('pageTitle', 'log'));
    }



}
