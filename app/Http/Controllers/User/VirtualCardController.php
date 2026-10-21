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
use App\Services\PayVesselService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
        $data['activeTemplateTrue'] = checkTemplate(true);

        return view($activeTemplate. 'user.vendor.virtualcard.create', $data, compact('pageTitle', 'log'));
    }


    public function Request_virtualCard(Request $request)
    {
        $general = gs();
        if ($general->virtualcard == 0) {
            $notify[] = ['error', 'Feature is currently disabled'];
            return back()->withNotify($notify);
        }
        $general            = gs();
        $this->validate($request, [
            'code_1' => 'required',
            'type' => 'required',
            'bvn' => 'required|digits:11',
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
		if (($general->virtualcard_provider ?? 'BLOCHQ') === 'PAYVESSEL') {
            return $this->requestPayVesselCard($request, $user, $general);
        }

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

    private function requestPayVesselCard(Request $request, $user, $general)
    {
        if (strtolower($request->type) === 'verve') {
            $notify[] = ['error', 'PayVessel supports Visa and Mastercard virtual cards only'];
            return back()->withNotify($notify);
        }

        $address = $user->address;
        $imagePath = public_path('assets/images/kyc/'.$user->username.'/front_kyc_image.png');
        if (!$user->nin || !preg_match('/^\d{11}$/', $user->nin) || !$user->dob || !$address || !is_file($imagePath)) {
            $notify[] = ['error', 'Please complete your profile, NIN and KYC before requesting a PayVessel card'];
            return back()->withNotify($notify);
        }

        try {
            $reply = app(PayVesselService::class)->createCard([
                'first_name' => $user->firstname,
                'last_name' => $user->lastname,
                'email' => $user->email,
                'phone' => $user->mobile,
                'bvn' => $request->bvn,
                'nin' => $user->nin,
                'dob' => date('Y-m-d', strtotime($user->dob)),
                'image' => 'data:image/png;base64,'.base64_encode(file_get_contents($imagePath)),
                'state' => $address->state ?? '',
                'lga' => $address->city ?? '',
                'street' => $address->address ?? '',
                'postal_code' => $address->zip ?? '',
                'brand' => strtoupper($request->type),
                'currency' => 'USD',
            ]);
            $cardData = $reply['data']['card'] ?? $reply['data'] ?? [];
            $cardId = $cardData['id'] ?? $cardData['card_id'] ?? null;
            if (!$cardId) {
                throw new \RuntimeException('PayVessel did not return a card ID.');
            }

            $user->balance -= $general->virtualcard_request_fee;
            $user->save();

            $transaction = new Transaction();
            $transaction->user_id = $user->id;
            $transaction->amount = $general->virtualcard_request_fee;
            $transaction->post_balance = $user->balance;
            $transaction->charge = 0;
            $transaction->trx_type = '-';
            $transaction->details = 'Request PayVessel virtual card via wallet balance';
            $transaction->trx = getTrx();
            $transaction->remark = 'request card';
            $transaction->save();

            $card = new VirtualCard();
            $card->user_id = $user->id;
            $card->customer_id = $cardData['customer_id'] ?? '';
            $card->card_id = $cardId;
            $card->brand = $cardData['brand'] ?? strtoupper($request->type);
            $card->currency = $cardData['currency'] ?? 'USD';
            $card->status = strtolower($cardData['status'] ?? 'pending');
            $expiry = explode('/', $cardData['expiry'] ?? '/');
            $card->expiry_month = $cardData['expiry_month'] ?? $expiry[0] ?? '';
            $card->expiry_year = $cardData['expiry_year'] ?? $expiry[1] ?? '';
            $cardNumber = preg_replace('/\D/', '', $cardData['card_number'] ?? '');
            $card->pan = $cardData['masked_pan'] ?? ($cardNumber ? '**** **** **** '.substr($cardNumber, -4) : '');
            $card->environment = 'PAYVESSEL';
            $card->provider = 'PAYVESSEL';
            unset($cardData['card_number'], $cardData['pan'], $cardData['cvv']);
            $card->api = json_encode($cardData);
            $card->save();

            $notify[] = ['success', $reply['message'] ?? 'Virtual Card Created Successfully'];
            return redirect()->route('user.virtualcard.history')->withNotify($notify);
        } catch (\Exception $exception) {
            $notify[] = ['error', $exception->getMessage()];
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
        $data['activeTemplateTrue'] = checkTemplate(true);

        return view($activeTemplate. 'user.vendor.virtualcard.history', $data, compact('pageTitle', 'log'));
    }


    public function details($id)
    {
        $pageTitle       = 'Details';
        $user = auth()->user();
        $card = VirtualCard::whereUserId($user->id)->whereCardId($id)->orderBy('id', 'desc')->firstOrFail();

        if (($card->provider ?? null) === 'PAYVESSEL') {
            try {
                $response = app(PayVesselService::class)->card($id);
                $cardData = $response['data']['card'] ?? $response['data'] ?? [];
                $expiry = explode('/', $cardData['expiry'] ?? '/');
                $reply = ['data' => [
                    'id' => $cardData['id'] ?? $cardData['card_id'] ?? $id,
                    'status' => strtolower($cardData['status'] ?? $card->status),
                    'pin' => $cardData['pin'] ?? null,
                    'pan' => $cardData['pan'] ?? $cardData['card_number'] ?? $cardData['masked_pan'] ?? $card->pan,
                    'expiry_month' => $cardData['expiry_month'] ?? $expiry[0] ?? $card->expiry_month,
                    'expiry_year' => $cardData['expiry_year'] ?? $expiry[1] ?? $card->expiry_year,
                    'cvv' => $cardData['cvv'] ?? '',
                    'currency' => $cardData['currency'] ?? $card->currency,
                ]];
                $card->status = $reply['data']['status'];
                $card->save();

                $activeTemplate = checkTemplate();
                $data['activeTemplate'] = $activeTemplate;
                $data['activeTemplateTrue'] = checkTemplate(true);
                return view($activeTemplate. 'user.vendor.virtualcard.details', $data, compact('pageTitle', 'card', 'reply'));
            } catch (\Exception $exception) {
                $notify[] = ['error', $exception->getMessage()];
                return back()->withNotify($notify);
            }
        }

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
        $data['activeTemplateTrue'] = checkTemplate(true);

        return view($activeTemplate. 'user.vendor.virtualcard.details', $data, compact('pageTitle', 'card','reply'));
    }
    public function deactivate($id)
    {
        $pageTitle       = 'Details';
        $user = auth()->user();
        $card = VirtualCard::whereUserId($user->id)->whereCardId($id)->orderBy('id', 'desc')->firstOrFail();

        if (($card->provider ?? null) === 'PAYVESSEL') {
            return $this->setPayVesselCardFreezeStatus($card, true);
        }

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

        if (($card->provider ?? null) === 'PAYVESSEL') {
            return $this->setPayVesselCardFreezeStatus($card, false);
        }

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

        if (($card->provider ?? null) === 'PAYVESSEL') {
            return $this->setPayVesselCardFreezeStatus($card, true);
        }

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


    private function setPayVesselCardFreezeStatus(VirtualCard $card, bool $freeze)
    {
        try {
            $reply = $freeze
                ? app(PayVesselService::class)->freezeCard($card->card_id)
                : app(PayVesselService::class)->unfreezeCard($card->card_id);
            $cardData = $reply['data']['card'] ?? $reply['data'] ?? [];
            $card->status = strtolower($cardData['status'] ?? ($freeze ? 'frozen' : 'active'));
            unset($cardData['card_number'], $cardData['pan'], $cardData['cvv']);
            $card->api = json_encode($cardData);
            $card->save();

            $notify[] = ['success', $reply['message'] ?? ($freeze ? 'Card frozen successfully' : 'Card unfrozen successfully')];
            return back()->withNotify($notify);
        } catch (\Exception $exception) {
            $notify[] = ['error', $exception->getMessage()];
            return back()->withNotify($notify);
        }
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

        if (($card->provider ?? null) === 'PAYVESSEL') {
            $notify[] = ['error', 'Card PIN changes are not supported by PayVessel'];
            return back()->withNotify($notify);
        }

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
        if (($card->provider ?? null) === 'PAYVESSEL') {
            try {
                $reply = app(PayVesselService::class)->fundCard($id, $request->amount);
                $user->balance -= $total;
                $user->save();

                $transaction = new Transaction();
                $transaction->user_id = $user->id;
                $transaction->amount = $amount;
                $transaction->post_balance = $user->balance;
                $transaction->charge = $fee;
                $transaction->trx_type = '-';
                $transaction->details = 'Fund PayVessel virtual card';
                $transaction->trx = getTrx();
                $transaction->remark = 'fund card';
                $transaction->save();

                $notify[] = ['success', $reply['message'] ?? 'Card funded successfully'];
                return back()->withNotify($notify);
            } catch (\Exception $exception) {
                $notify[] = ['error', $exception->getMessage()];
                return back()->withNotify($notify);
            }
        }

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
