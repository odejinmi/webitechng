<?php

namespace App\Http\Controllers\User;

use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Lib\GoogleAuthenticator;
use App\Models\Order;
use App\Models\Cryptocurrency;
use App\Models\GeneralSetting;
 use App\Models\AdminNotification;
use App\Models\User;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Rules\FileTypeValidate;
use Illuminate\Validation\Rules\Password;
use DB;
use Image;
use Carbon\Carbon;
class SellCryptoController extends Controller
{


    public function __construct()
    {
        $this->middleware('kyc.status');
        $this->middleware('sell_crypto.status');
        $this->activeTemplate = activeTemplate();
    }


    public function index(Request $request)
    {
        $pageTitle       = 'Sell Crypto';
        $user = auth()->user();
        $log = Order::whereUserId($user->id)->whereType('sell_crypto')->searchable(['trx'])->orderBy('id', 'desc')->paginate(getPaginate());
        $activeTemplate = checkTemplate();
        $data['activeTemplate'] = $activeTemplate;

        return view($activeTemplate. 'user.assets.crypto.sellcrypto.index', $data, compact('pageTitle', 'log'));
    }

    public function sell(Request $request)
    {
        $pageTitle = 'Sell Crypto';
        $countries = [];
        $plans = [];
        $currencies = Cryptocurrency::whereStatus(1)->get();
        $activeTemplate = checkTemplate();
        $data['activeTemplate'] = $activeTemplate;

        return view($activeTemplate. 'user.assets.crypto.sellcrypto.sell', $data, compact('pageTitle','currencies'));
    }

    public function coindetails()
    {
        $general = gs();

        $json = file_get_contents('php://input');
        $input = json_decode($json, true);
        $coin = $input['coin'];
        $amount = $input['amount'];
        $currency = Cryptocurrency::whereId($coin)->firstOrFail();

        if($general->crypto_auto == 1)
        {
            $url = "https://coinremitter.com/api/v3/".$currency->symbol."/get-fiat-to-crypto-rate";
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
            $headers = array(
            "Content-Type: application/json",
            );
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
            $data = <<<DATA
            {
                "api_key": "$currency->apikey",
                "password": "$currency->apipass",
                "fiat_symbol": "USD",
                "fiat_amount": "$amount"
            }
            DATA;
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            //for debug only!
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            $resp = curl_exec($curl);
            curl_close($curl);
            //var_dump($resp);
            $resp = json_decode($resp,true);
            if($resp['msg'] == 'success')
            {
                return response()->json(['ok'=>true,'status'=>'success','message'=> 'Asset Price Calculated','currency'=>$currency->symbol,'rate'=>$resp['data'],'ourrate'=>$currency->sell_rate],200);
            }
            return response()->json(['ok'=>false,'status'=>'error','message'=> 'Sorry, we cant calculate asset rate at the moment.'],200);
        }
        return response()->json(['ok'=>true,'status'=>'success','message'=> 'Asset Price Calculated','currency'=>$currency->symbol,'rate'=>$currency->sell_rate,'ourrate'=>$currency->sell_rate],200);


    }


    public function sellConfirm()
    {
        $general = gs();
        $user = auth()->user();
        $json = file_get_contents('php://input');
        $input = json_decode($json, true);
        $coin = $input['coin'];
        $invoice = $input['invoice'];
        $currency = Cryptocurrency::whereSymbol($coin)->firstOrFail();
        $order = Order::whereTrx($invoice)->whereUserId($user->id)->firstOrFail();
        $url = "https://coinremitter.com/api/v3/".$coin."/get-invoice";
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
        $headers = array(
        "Content-Type: application/json",
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        $data = <<<DATA
        {
            "api_key": "$currency->apikey",
            "password": "$currency->apipass",
            "invoice_id": "$invoice"
        }
        DATA;
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        //for debug only!
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $resp = curl_exec($curl);
        curl_close($curl);
        //var_dump($resp);
        $resp = json_decode($resp,true);

        $trx = Transaction::whereTrx($order->trx)->whereUserId($user->id)->first();

        $order->status = $resp['data']['status'];
        $order->status_code = $resp['data']['status_code'];
        $order->save();
        if($resp['data']['status_code'] == 1 || $resp['data']['status_code'] == 3)
        {
            //FUND WALLET AND CLOSE TRANSACTIONS
            if(!$trx)
            {
                if($order->source == 'main')
                {
                    $user->balance += $order->value;
                    $balance_after = $user->balance;
                }
                else
                {
                    $user->ref_balance -= $order->value ;
                    $balance_after = $user->ref_balance;
                }
                $user->save();

                $transaction               = new Transaction();
                $transaction->user_id      = $order->user_id;
                $transaction->amount       = $order->value;
                $transaction->post_balance = $balance_after;
                $transaction->charge       = 0;
                $transaction->trx_type     = '+';
                $transaction->details      = 'Sold '. $currency->name.' Digital Asset';
                $transaction->trx          = $order->trx;
                $transaction->remark       = 'sell';
                $transaction->save();
                notify($user,'ASSET_SELL', [
                    'asset'        => @$currency->name,
                    'currency'        => @$operatorCurrency,
                    'amount'          => @showAmount($order->payment),
                    'rate'           =>  @showAmount($order->value),
                    'purchase_at'     => @Carbon::now(),
                    'trx'             => @$order->trx,
                ]);
            }
            //FUND WALLET AND CLOSE TRANSACTIONS
            return response()->json(['ok'=>true,'status'=>'success','message'=> 'Invoice Is '.$resp['data']['status']],200);
        }
        return response()->json(['ok'=>false,'status'=>'error','message'=> 'Invoice Is '.$resp['data']['status']],200);
    }

    public function sellProcess()
    {
        $general = gs();
        if($general->crypto_auto == 1)
        {
        try {
        $json = file_get_contents('php://input');
        $input = json_decode($json, true);
        $coin = $input['coin'];
        $amount = $input['amount'];
        $wallet = $input['wallet'];
        $currency = Cryptocurrency::whereId($coin)->firstOrFail();
        $url = "https://coinremitter.com/api/v3/".$currency->symbol."/create-invoice";
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
        $headers = array(
        "Content-Type: application/json",
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        $data = <<<DATA
        {
            "api_key": "$currency->apikey",
            "password": "$currency->apipass",
            "currency": "USD",
            "amount": "$amount"
        }
        DATA;
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        //for debug only!
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $resp = curl_exec($curl);
        curl_close($curl);
        //var_dump($resp);
        $resp = json_decode($resp,true);
        if($resp['flag'] != 1)
        {
            return response()->json(['ok'=>false,'status'=>'error','message'=> $resp['msg']],200);
        }
        $user = auth()->user();
        $crypto = array_values($resp['data']['total_amount']);
        $value = $amount*$currency->sell_rate;
        $order               = new Order();
            $order->user_id      = @$user->id;
            $order->type         = 'sell_crypto';
            $order->deposit_code   = @getTrx();
            $order->product_id   = @$currency->id;
            $order->product_name = @$currency->name;
            $order->product_logo = @$currency->image;
            $order->details      = json_encode($resp,true);
            $order->quantity     = 1;
            $order->value        = @$value;
            $order->price        = @$resp['data']['usd_amount'];
            $order->currency     = @$resp['data']['base_currency'];
            $order->status       = @$resp['data']['status'];
            $order->payment      = $crypto[0];
            $order->trx          = @$resp['data']['invoice_id'];
            $order->source       = @$wallet;
            $order->transaction_id  = @$resp['data']['id'];
            $order->save();
        return response()->json(['ok'=>true,'status'=>'success','message'=> 'Trade Invoice Created Successfully','data'=> $resp['data'],'auto'=> true],200);
        } catch (\Exception $exp) {
            return response()->json(['ok'=>false,'status'=>'error','message'=> $exp->getMessage()],200);

        }
        }

        else
        {
            try {
                $json = file_get_contents('php://input');
                $input = json_decode($json, true);
                $coin = $input['coin'];
                $amount = $input['amount'];
                $wallet = $input['wallet'];
                $currency = Cryptocurrency::whereId($coin)->firstOrFail();

                $user = auth()->user();
                $value = $amount*$currency->sell_rate;
                $order               = new Order();
                    $order->user_id      = @$user->id;
                    $order->type         = 'sell_crypto';
                    $order->deposit_code   = @getTrx();
                    $order->product_id   = @$currency->id;
                    $order->product_name = @$currency->name;
                    $order->product_logo = @$currency->image;
                    $order->details      = json_encode($input,true);
                    $order->quantity     = 1;
                    $order->value        = @$value;
                    $order->price        = $currency->sell_rate;
                    $order->currency     = 'USD';
                    $order->status       = 'pending';
                    $order->payment      = $amount;
                    $order->trx          = getTrx();
                    $order->source       = @$wallet;
                    $order->transaction_id  = rand(1000000,100000000);
                    $order->save();
                return response()->json(['ok'=>true,'status'=>'success','message'=> 'Trade Invoice Created Successfully','coin'=> $currency,'data'=> $order,'auto'=> false],200);
                } catch (\Exception $exp) {
                    return response()->json(['ok'=>false,'status'=>'error','message'=> $exp->getMessage()],200);

                }
        }
    }


    public function sellConfirmManual(Request $request)
    {
        $general = gs();
        $user = auth()->user();
        $order = Order::whereTrx($request->trx)->whereUserId($user->id)->firstOrFail();
        $order->val_1 = $request->trxhash;
        $path = imagePath()['trade']['path'].'/'.$user->username;
        if ($request->hasFile('proof')) {
            $request->validate([
                'proof'     => ['required', 'image', new FileTypeValidate(['jpg', 'jpeg', 'png'])],
            ]);
            try {
                if (!file_exists($path)) {
                    mkdir($path, 0755, true);
                }
               $file = getTrx().'.png';
               $image = Image::make($request->proof)->save($path . '/'.$file);
               $order->val_2 = $file;

            } catch (\Exception $exp) {
                //return $exp;
                //$notify[] = ['error', 'Could not upload your Proof of payment'];
                //return back()->withNotify($notify)->withInput();
            }
        }

        //SEND ADMIN MAIL
				 $general =  GeneralSetting::first();
				 $admin = [
                        'username' => $general->site_name,
                        'email'    => $general->email_from,
                        'fullname' => $general->site_name,
                    ];
				 notify($admin, 'USER_MESSAGE', [
					'message' => $user->username.' just initiated a crypto sale order. Please login to account to check status',
					'subject' => 'Pending Crypto Sale'
				]);
				//END SEND ADMIN MAIL

        $order->save();
        $notify[] = ['success', 'Transaction submitted successfuly successfuly.'];
        return redirect()->route('user.crypto.sell.log')->withNotify($notify);
    }

    public function log(Request $request)
    {
        $pageTitle       = 'Sales Log';
        $user = auth()->user();
        $log = Order::whereUserId($user->id)->whereType('sell_crypto')->searchable(['deposit_code'])->with('asset')->orderBy('id', 'desc')->paginate(getPaginate());
        $activeTemplate = checkTemplate();
        $data['activeTemplate'] = $activeTemplate;

        return view($activeTemplate. 'user.assets.crypto.sellcrypto.sell_log', $data, compact('pageTitle', 'log'));
    }


}
