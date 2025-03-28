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
use Illuminate\Validation\Rules\Password;
use App\Rules\FileTypeValidate;
use Image;
use DB;
use Carbon\Carbon;
class BuyCryptoController extends Controller
{


    public function __construct()
    {
        $this->middleware('buy_crypto.status');
        $this->middleware('kyc.status');
        $this->activeTemplate = activeTemplate();
    }


    public function index(Request $request)
    {
        $pageTitle       = 'Buy Crypto';
        $user = auth()->user();
        $log = Order::whereUserId($user->id)->whereType('buy_crypto')->searchable(['trx'])->orderBy('id', 'desc')->paginate(getPaginate());
        $activeTemplate = checkTemplate();
        $data['activeTemplate'] = $activeTemplate;
        $data['activeTemplateTrue'] = checkTemplate(true);

        return view($activeTemplate. 'user.assets.crypto.buycrypto.index', $data,compact('pageTitle', 'log'));
    }

    public function buy(Request $request)
    {
        $pageTitle = 'Buy Crypto';
        $countries = [];
        $plans = [];
        $currencies = Cryptocurrency::whereStatus(1)->get();
        $activeTemplate = checkTemplate();
        $data['activeTemplate'] = $activeTemplate;
        $data['activeTemplateTrue'] = checkTemplate(true);

        return view($activeTemplate. 'user.assets.crypto.buycrypto.buy', $data,compact('pageTitle','currencies'));
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
            return response()->json(['ok'=>true,'status'=>'success','message'=> 'Asset Price Calculated','rate'=>$resp['data'],'ourrate'=>$currency->buy_rate],200);
        }
        return response()->json(['ok'=>false,'status'=>'error','message'=> 'Sorry, we cant calculate asset rate at the moment.'],200);
       }
       return response()->json(['ok'=>true,'status'=>'success','message'=> 'Asset Price Calculated','rate'=>$currency->buy_rate,'ourrate'=>$currency->buy_rate],200);

    }



    public function buyProcess()
    {
        $general = gs();
        $user = auth()->user();

        if($general->crypto_auto == 1)
        {
        try {
        $json = file_get_contents('php://input');
        $input = json_decode($json, true);
        $coin = $input['coin'];
        $amount = $input['amount'];
        $wallet = $input['wallet'];
        $currency = Cryptocurrency::whereId($coin)->firstOrFail();
        $total = $currency->buy_rate * $amount;
        if($wallet == 'main' && $user->balance < $total)
            {
                return response()->json(['ok'=>false,'status'=>'error','message'=> 'Insufficient main wallet balance'],200);
            }
        elseif($wallet != 'main' && $user->ref_balance < $total)
            {
                return response()->json(['ok'=>false,'status'=>'error','message'=> 'Insufficient referral wallet balance'],200);
            }
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
            if($resp['msg'] != 'success')
            {
                return response()->json(['ok'=>false,'status'=>'error','message'=> 'Sorry, we cant calculate asset rate at the moment.'],200);
            }
        $code = getTrx();
        $crypto = $resp['data']['crypto_amount'];
        $usdvalue = $resp['data']['fiat_amount'];
        $order               = new Order();
        $order->user_id      = @$user->id;
        $order->type         = 'buy_crypto';
        $order->deposit_code   = @getTrx();
        $order->product_id   = @$currency->id;
        $order->product_name = @$currency->name;
        $order->product_logo = @$currency->image;
        $order->details      = json_encode($resp,true);
        $order->quantity     = 1;
        $order->value        = @$crypto;
        $order->price        = $currency->buy_rate;
        $order->currency     = @$resp['data']['crypto_symbol'];
        $order->status       = 'success';
        $order->payment      = @$total;
        $order->trx          = $code;
        $order->source       = @$wallet;
        $order->transaction_id  = getTrx();
        $order->save();
        return response()->json(['ok'=>true,'status'=>'success','message'=> 'Trade Created Successfully','coin'=> $crypto.$currency->symbol,'usd'=> $usdvalue,'fiat'=> $total,'auto'=> true],200);
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

                $coin = $input['coin'];
                $amount = $input['amount'];
                $wallet = $input['wallet'];
                $total = $currency->buy_rate * $amount;

                $user = auth()->user();
                $value = $amount*$currency->buy_rate;
                $order               = new Order();
                    $order->user_id      = @$user->id;
                    $order->type         = 'buy_crypto';
                    $order->deposit_code   = @getTrx();
                    $order->product_id   = @$currency->id;
                    $order->product_name = @$currency->name;
                    $order->product_logo = @$currency->image;
                    $order->details      = json_encode($input,true);
                    $order->quantity     = 1;
                    $order->value        = @$value;
                    $order->price        = $currency->buy_rate;
                    $order->currency     = 'USD';
                    $order->status       = 'pending';
                    $order->payment      = $amount;
                    $order->trx          = getTrx();
                    $order->source       = @$wallet;
                    $order->transaction_id  = rand(1000000,100000000);
                    $order->save();
                    return response()->json(['ok'=>true,'status'=>'success','message'=> 'Trade Created Successfully','coin'=> $currency,'trx'=> $order->trx,'usd'=> $value,'fiat'=> $total,'auto'=> false],200);
                } catch (\Exception $exp) {
                    return response()->json(['ok'=>false,'status'=>'error','message'=> $exp->getMessage()],200);

                }
        }

    }
    public function buyConfirmManual(Request $request)
    {
        $general = gs();
        $user = auth()->user();
        $order = Order::whereTrx($request->trx)->whereUserId($user->id)->firstOrFail();
        $order->val_1 = $request->walletaddress;
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
        $order->save();


				//SEND ADMIN MAIL
				 $general =  GeneralSetting::first();
				 $admin = [
                        'username' => $general->site_name,
                        'email'    => $general->email_from,
                        'fullname' => $general->site_name,
                    ];
				 notify($admin, 'USER_MESSAGE', [
					'message' => $user->username.' just initiated a crypto purchase order. Please login to account to check status',
					'subject' => 'Pending Crypto Purchase'
				]);
				//END SEND ADMIN MAIL


        $notify[] = ['success', 'Transaction submitted successfuly successfuly.'];
        return redirect()->route('user.crypto.buy.log')->withNotify($notify);
    }

    public function log(Request $request)
    {
        $pageTitle       = 'Purchase Log';
        $user = auth()->user();
        $log = Order::whereUserId($user->id)->whereType('buy_crypto')->searchable(['deposit_code'])->with('asset')->orderBy('id', 'desc')->paginate(getPaginate());
        $activeTemplate = checkTemplate();
        $data['activeTemplate'] = $activeTemplate;
        $data['activeTemplateTrue'] = checkTemplate(true);

        return view($activeTemplate. 'user.assets.crypto.buycrypto.buy_log', $data,compact('pageTitle', 'log'));
    }


}
