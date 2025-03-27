<?php

namespace App\Http\Controllers\User;

use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Lib\GoogleAuthenticator;
use App\Models\VirtualCard;
use App\Models\GeneralSetting;
 use App\Models\AdminNotification;
use App\Models\User;
use App\Models\Order;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use DB;
use Carbon\Carbon;
class VirtualCardController extends Controller
{


    public function __construct()
    {
        $this->middleware('kyc.status');
        $this->middleware('virtualcard.status');
        $this->activeTemplate = activeTemplate();
    }
    public function index(Request $request)
    {
        $pageTitle       = 'Virtual Card';
        $user = auth()->user();
        $log = Order::whereUserId($user->id)->whereType('airtime')->searchable(['trx'])->orderBy('id', 'desc')->paginate(getPaginate());
        $activeTemplate = checkTemplate();
        $data['activeTemplate'] = $activeTemplate;

        return view($activeTemplate. 'user.vendor.virtualcard.create', $data, compact('pageTitle', 'log'));
    }


    public function Request_virtualCard(Request $request)
    {
        $general = gs();
        if ($general->virtualcard == 0) {
            $notify[] = ['error', 'Feature is currently disabled'];
            return back()->withNotify($notify);
        }
        $passwordValidation = Password::min(6);
        $general            = gs();
        $this->validate($request, [
            'code_1' => 'required',
            'type' => 'required',
            'bvn' => 'required|string|max:11',
        ]);

        $user = auth()->user();

        if($general->virtualcard_request_fee > $user->balance)
        {
            $notify[] = ['error', 'Sorry you do not have enough balance to make this request'];
            return back()->withNotify($notify);
        }
        $code = $request->code_1.$request->code_2.$request->code_3.$request->code_4.$request->code_5.$request->code_6;
        if(Hash::check($code, $user->trx_password))
        {
        	$user = auth()->user();

        if($request->type == 'visa' && $user->customer_id_visa == null)
        {
            $url = 'https://strowallet.com/api/bitvcard/create-user';
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
            CURLOPT_POSTFIELDS =>'{
                "email": "'.$user->email.'",
                "phone_number": "'.$user->mobile.'",
                "first_name": "'.$user->firstname.'",
                "last_name": "'.$user->lastname.'",
                "customer_type": "Personal",
                "bvn": "'.$request->bvn.'"
            }',

            CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer '.env('VIRTUALCARDSK'),
            'Content-Type: application/json',
            'accept: application/json',
                 ),
            ));
            $resp = curl_exec($curl);
            $reply = json_decode($resp, true);
            curl_close($curl);
            if(!isset($reply['data']['id']))
            {
                $notify[] = ['error', $reply['message']];
                return back()->withNotify($notify);
            }
            $user->customer_id = $reply['data']['id'];
            $user->save();
        }
        if($request->type != 'visa' && $user->customer_id == null)
        {
            $url = 'https://api.blochq.io/v1/customers';
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
            CURLOPT_POSTFIELDS =>'{
                "email": "'.$user->email.'",
                "phone_number": "'.$user->mobile.'",
                "first_name": "'.$user->firstname.'",
                "last_name": "'.$user->lastname.'",
                "customer_type": "Personal",
                "bvn": "'.$request->bvn.'"
            }',

            CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer '.env('VIRTUALCARDSK'),
            'Content-Type: application/json',
            'accept: application/json',
                 ),
            ));
            $resp = curl_exec($curl);
            $reply = json_decode($resp, true);
            curl_close($curl);
            if(!isset($reply['data']['id']))
            {
                $notify[] = ['error', $reply['message']];
                return back()->withNotify($notify);
            }
            $user->customer_id = $reply['data']['id'];
            $user->save();
        }

        //NEXT UPGRADE CUSTOMER TO TIER 1
        if($user->customer_tier == null)
        {

            //$imagedata = file_get_contents(getImage(getFilePath('userProfile') . '/' . auth()->user()->image, getFileSize('userProfile')) );
            $imagedata = getImage(getFilePath('userProfile') . '/' . auth()->user()->image, getFileSize('userProfile'));
            //$base64 = base64_encode($imagedata);

            $image = base64_encode(file_get_contents($imagedata));
            $user = auth()->user();



            $curl = curl_init();

            curl_setopt_array($curl, [
              CURLOPT_URL => "https://api.blochq.io/v1/customers/upgrade/t1/".$user->customer_id,
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 30,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "PUT",
              CURLOPT_POSTFIELDS => json_encode([
                'address' => [
                    'street' => 'Lagos',
                    'city' => 'Lagos',
                    'state' => 'Lagos',
                    'country' => 'Nigeria',
                    'postal_code' => '234'
                ],
                'place_of_birth' => 'Lagos',
                'dob' => '1992-11-11',
                'gender' => 'Male',
                'country' => 'Nigeria',
                'image' => $imagedata
              ]),
              CURLOPT_HTTPHEADER => [
                "accept: application/json",
                "Authorization: Bearer ".env('VIRTUALCARDSK'),
                "content-type: application/json"
              ],
            ]);

            $response = curl_exec($curl);
            $reply = json_decode($response, true);
            $err = curl_error($curl);
            curl_close($curl);
            //return $reply;



            if(!isset($reply['data']['id']) || !isset($reply['data']['kyc_tier']))
            {
                $notify[] = ['error', $reply['message']];
                return back()->withNotify($notify);
            }
            $user->customer_tier = $reply['data']['kyc_tier'];
            $user->save();
            }

            //CREATE VIRTUAL CARD
            $user = auth()->user();
            $url = 'https://api.blochq.io/v1/cards';
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
            CURLOPT_POSTFIELDS =>'{
                "customer_id": "'.$user->customer_id.'",
                "brand": "'.$request->type.'"
              }',

            CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer '.env('VIRTUALCARDSK'),
            'Content-Type: application/json',
            'accept: application/json',
                 ),
            ));
            $resp = curl_exec($curl);
            $reply = json_decode($resp, true);
            curl_close($curl);
            //return $reply;
            if(!isset($reply['data']['id']) && !isset($reply['data']['pan']))
            {
                $notify[] = ['error', $reply['message']];
                return back()->withNotify($notify);
            }

            //DEBIT USER
            $user->balance -= $general->virtualcard_request_fee;
            $user->save();

            $transaction               = new Transaction();
            $transaction->user_id      = $user->id;
            $transaction->amount       = $general->virtualcard_request_fee;
            $transaction->post_balance = $user->balance;
            $transaction->charge       = 0;
            $transaction->trx_type     = '-';
            $transaction->details      = 'Request virtual card via wallet balance';
            $transaction->trx          = getTrx();
            $transaction->remark       = 'request card';
            $transaction->save();

            //SAVE Card Details
            $order               = new VirtualCard();
            $order->user_id      = $user->id;
            $order->customer_id  =  $user->customer_id;
            $order->card_id        = $reply['data']['id'];
            $order->brand        = $reply['data']['brand'];
            $order->currency   = @$reply['data']['currency'];
            $order->status = @$reply['data']['status'];
            $order->expiry_month = @$reply['data']['expiry_month'];
            $order->expiry_year      = @$reply['data']['expiry_year'];
            $order->pan     = $reply['data']['pan'];
            $order->environment     = @$reply['data']['environment'];
            $order->status       = @$reply['data']['status'];
            $order->api = @json_encode($reply['data'],true);
            $order->save();
            // END Virtual Card

        $notify[] = ['success', 'Virtual Card Created Successfully'];
        return redirect()->route('user.virtualcard.history')->withNotify($notify);

        } else {
            $notify[] = ['error', 'Invalid Account Transaction Password!'];
            return back()->withNotify($notify);
        }
    }

    public function history(Request $request)
    {
        $pageTitle       = 'Card History';
        $user = auth()->user();
        $log = VirtualCard::whereUserId($user->id)->searchable(['pan'])->orderBy('id', 'desc')->paginate(getPaginate());
        $activeTemplate = checkTemplate();
        $data['activeTemplate'] = $activeTemplate;

        return view($activeTemplate. 'user.vendor.virtualcard.history', $data, compact('pageTitle', 'log'));
    }


    public function details($id)
    {
        $pageTitle       = 'Details';
        $user = auth()->user();
        $card = VirtualCard::whereUserId($user->id)->whereCardId($id)->orderBy('id', 'desc')->firstOrFail();

        $url = 'https://api.blochq.io/v1/cards/secure-data/'.$id;
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_POSTFIELDS =>'',

        CURLOPT_HTTPHEADER => array(
        'Authorization: Bearer '.env('VIRTUALCARDSK'),
        'Content-Type: application/json',
        'accept: application/json',
             ),
        ));
        $resp = curl_exec($curl);
        $reply = json_decode($resp, true);
        curl_close($curl);
        if(!isset($reply['data']['id']) && !isset($reply['data']['pan']))
        {
            $notify[] = ['error', $reply['message']];
            return back()->withNotify($notify);
        }

        $activeTemplate = checkTemplate();
        $data['activeTemplate'] = $activeTemplate;

        return view($activeTemplate. 'user.vendor.virtualcard.details', $data, compact('pageTitle', 'card','reply'));
    }
    public function deactivate($id)
    {
        $pageTitle       = 'Details';
        $user = auth()->user();
        $card = VirtualCard::whereUserId($user->id)->whereCardId($id)->orderBy('id', 'desc')->firstOrFail();

        $url = 'https://api.blochq.io/v1/cards/freeze/'.$id;
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "PUT",
        CURLOPT_POSTFIELDS =>'',

        CURLOPT_HTTPHEADER => array(
        'Authorization: Bearer '.env('VIRTUALCARDSK'),
        'Content-Type: application/json',
        'accept: application/json',
             ),
        ));
        $resp = curl_exec($curl);
        $reply = json_decode($resp, true);
        curl_close($curl);
        if(!isset($reply['data']['id']) && !isset($reply['data']['pan']))
        {
            $notify[] = ['error', @$reply['message']];
            return back()->withNotify($notify);
        }

        $card->status = $reply['data']['status'];
        $card->save();
        $notify[] = ['success', $reply['message']];
        return back()->withNotify($notify);

    }

    public function activate($id)
    {
        $pageTitle       = 'Details';
        $user = auth()->user();
        $card = VirtualCard::whereUserId($user->id)->whereCardId($id)->orderBy('id', 'desc')->firstOrFail();

        $url = 'https://api.blochq.io/v1/cards/unfreeze/'.$id;
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "PUT",
        CURLOPT_POSTFIELDS =>'',

        CURLOPT_HTTPHEADER => array(
        'Authorization: Bearer '.env('VIRTUALCARDSK'),
        'Content-Type: application/json',
        'accept: application/json',
             ),
        ));
        $resp = curl_exec($curl);
        $reply = json_decode($resp, true);
        curl_close($curl);
        if(!isset($reply['data']['id']) && !isset($reply['data']['pan']))
        {
            $notify[] = ['error', @$reply['message']];
            return back()->withNotify($notify);
        }

        $card->status = $reply['data']['status'];
        $card->save();
        $notify[] = ['success', $reply['message']];
        return back()->withNotify($notify);

    }

    public function block($id)
    {
        $pageTitle       = 'Details';
        $user = auth()->user();
        $card = VirtualCard::whereUserId($user->id)->whereCardId($id)->orderBy('id', 'desc')->firstOrFail();

        $url = 'https://api.blochq.io/v1/cards/block/'.$id;
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "PUT",
        CURLOPT_POSTFIELDS =>'
        {
          "account_id": "'.env('VIRTUALCARD_ACCOUNTID').'",
          "reason": "lost"
        }
        ',

        CURLOPT_HTTPHEADER => array(
        'Authorization: Bearer '.env('VIRTUALCARDSK'),
        'Content-Type: application/json',
        'accept: application/json',
             ),
        ));
        $resp = curl_exec($curl);
        $reply = json_decode($resp, true);
        curl_close($curl);
        if(!isset($reply['data']['id']) && !isset($reply['data']['pan']))
        {
            $notify[] = ['error', @$reply['message']];
            return back()->withNotify($notify);
        }

        $card->status = $reply['data']['status'];
        $card->save();
        $notify[] = ['success', $reply['message']];
        return back()->withNotify($notify);

    }


    public function password(Request $request, $id)
    {
        $this->validate($request, [
            'old_pin' => 'required',
            'new_pin' => 'required',
            'password' => 'required',
        ]);

        $user = auth()->user();
        $card = VirtualCard::whereUserId($user->id)->whereCardId($id)->orderBy('id', 'desc')->firstOrFail();

        if (Hash::check($request->password, $user->trx_password))
     {
        $url = 'https://api.blochq.io/v1/cards/change-pin/'.$id;
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "PUT",
        CURLOPT_POSTFIELDS =>'
        {
            "old_pin": "'.$request->old_pin.'",
            "new_pin": "'.$request->new_pin.'"
          }
        ',

        CURLOPT_HTTPHEADER => array(
        'Authorization: Bearer '.env('VIRTUALCARDSK'),
        'Content-Type: application/json',
        'accept: application/json',
             ),
        ));
        $resp = curl_exec($curl);
        $reply = json_decode($resp, true);
        curl_close($curl);
        if(!isset($reply['data']['id']) && !isset($reply['data']['pan']))
        {
            $notify[] = ['error', @$reply['message']];
            return back()->withNotify($notify);
        }

        $card->status = $reply['data']['status'];
        $card->save();
        $notify[] = ['success', $reply['message']];
        return back()->withNotify($notify);
    } else {
        $notify[] = ['error', 'Invalid Account Transaction Password!'];
        return back()->withNotify($notify);
    }

    }

    public function fundbalance(Request $request, $id)
    {
        $this->validate($request, [
            'amount' => 'required',
            'password' => 'required',
        ]);
        $general = gs();
        $usdrate = $general->virtualcard_usd_rate;
        $user = auth()->user();

        if($general->virtualcard_fee_type == 'PERCENT')
        {
            $fee = ($request->amount*$general->virtualcard_fee_pecent)/100;
        }
        if($general->virtualcard_fee_type == 'FIXED')
        {
            $fee = $general->virtualcard_fee_flat;
        }
        if($general->virtualcard_fee_type == 'BOTH')
        {
            $percent = ($request->amount*$general->virtualcard_fee_pecent)/100;
            $fee =     $percent + $general->virtualcard_fee_flat;
        }
        $amount = $request->amount;
        $total = $amount+$fee;
        $card = VirtualCard::whereUserId($user->id)->whereCardId($id)->orderBy('id', 'desc')->firstOrFail();

        if($card->currency == 'USD')
        {
            $total = ($amount+$fee)*$usdrate;
            $amount = $request->amount * $usdrate;
        }

        if($total > $user->balance)
        {
            $notify[] = ['error', 'Sorry you do not have enough balance to make this request'];
            return back()->withNotify($notify);
        }

        if (Hash::check($request->password, $user->trx_password))
        {
        $url = 'https://api.blochq.io/v1/cards/fund/'.$id;
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
        {
            "amount": '.intval($request->amount*100).',
            "from_account_id": "'.env('VIRTUALCARD_ACCOUNTID').'",
            "currency": "'.$card->currency.'"
        }',

        CURLOPT_HTTPHEADER => array(
        'Authorization: Bearer '.env('VIRTUALCARDSK'),
        'Content-Type: application/json',
        'accept: application/json',
             ),
        ));
        $resp = curl_exec($curl);
        $reply = json_decode($resp, true);
        curl_close($curl);
        if(!isset($reply['data']['id']) && !isset($reply['data']['pan']))
        {
            $notify[] = ['error', @$reply['message']];
            return back()->withNotify($notify);
        }

        $user->balance -= $total;
        $user->save();

        $transaction               = new Transaction();
        $transaction->user_id      = $user->id;
        $transaction->amount       = $amount;
        $transaction->post_balance = $user->balance;
        $transaction->charge       = $fee;
        $transaction->trx_type     = '-';
        $transaction->details      = 'Fund virtual card';
        $transaction->trx          = getTrx();
        $transaction->remark       = 'fund card';
        $transaction->save();

        $notify[] = ['success', $reply['message']];
        return back()->withNotify($notify);
        } else {
            $notify[] = ['error', 'Invalid Account Transaction Password!'];
            return back()->withNotify($notify);
        }

    }

}
