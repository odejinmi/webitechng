<?php

namespace App\Http\Controllers\User;

use App\Lib\GoogleAuthenticator;
use App\Http\Controllers\Controller;
use App\Models\AdminNotification;
use App\Models\GeneralSetting;
use App\Models\Transaction;
use App\Models\Giftcard;
use App\Models\Giftcardtype;
use App\Models\Giftcardsale;
use App\Rules\FileTypeValidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Carbon\Carbon;
use Session;
use Route;

class GiftcardController extends Controller
{
    public function __construct()
    {
        $this->middleware('kyc.status');
        $this->activeTemplate = activeTemplate();
    }

    public function index()
    {
        $get['pageTitle'] = "Trade Giftcard";
       $activeTemplate = checkTemplate();
        $data['activeTemplate'] = $activeTemplate;
        $data['activeTemplateTrue'] = checkTemplate(true);

        return view($activeTemplate. 'user.giftcard.index', $data, $get);
    }

    public function buygift()
    {
        $get['pageTitle'] = "Buy Giftcard";
        $get['currency'] = Giftcard::whereStatus(1)->orderBy('name','asc')->get();
       $activeTemplate = checkTemplate();
        $data['activeTemplate'] = $activeTemplate;
        $data['activeTemplateTrue'] = checkTemplate(true);

        return view($activeTemplate. 'user.giftcard.giftcard', $data,$get);
    }

    public function sellgift()
    {
        $get['pageTitle'] = "Sell Giftcard";
        $get['currency'] = Giftcard::whereStatus(1)->orderBy('name','asc')->get();
       $activeTemplate = checkTemplate();
        $data['activeTemplate'] = $activeTemplate;
        $data['activeTemplateTrue'] = checkTemplate(true);

        return view($activeTemplate. 'user.giftcard.giftcard', $data, $get);
    }


    public function selectgiftcard($id)
    {
        if(Route::is('user.selectgiftcardsell') )
        {
            $get['pageTitle'] = "Sell Giftcard";
            $get['tradetype'] = "sell";
        }
        else
        {
            $get['pageTitle'] = "Buy Giftcard";
            $get['tradetype'] = "buy";
        }
        $get['card'] = Giftcard::whereId($id)->first();
        $get['type'] = Giftcardtype::whereStatus(1)->whereCard_id($id)->orderBy('name','asc')->get();

        $activeTemplate = checkTemplate();
        $data['activeTemplate'] = $activeTemplate;
        $data['activeTemplateTrue'] = checkTemplate(true);

        return view($activeTemplate. 'user.giftcard.giftcard-select', $data, $get);
    }

    public function sellcard(Request $request)
    {
     $this->validate($request,
            [
            'card' => 'required',
            'typeofcard' => 'required',
            'amount' => 'required',
            'type' => 'required',
            ]);
       $card = Giftcard::whereId($request->card)->first();
       if($request->typeofcard == "Physical")
            {
              $this->validate($request,
            [
            'front' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'back' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            ]);

            }

             if($request->typeofcard == "Digital")
            {
              $this->validate($request,
            [
             'code' => 'required',
            ]);

            }

         $type = Giftcardtype::whereId($request->type)->first();
         if(!$type){
            $notify[] = ['warning', 'There is no giftcard type available for '.$card->name.' at the moment. Please check back or try another giftcard'];
            return back()->withNotify($notify);
          }
         $get = $request->amount * $type->rate;

        $docm['user_id'] = Auth::id();
        $docm['type'] = $request->typeofcard;
        $docm['card_id'] = $request->card;
        $docm['currency'] = $request->typeid;
        $docm['amount'] = $request->amount;
        $docm['country'] = $request->typecurrency;
        $docm['rate'] = $request->typerate;
        $docm['pay'] = $get;
        $docm['trx_type'] = 'sell';
        $docm['status'] = 0;
        $docm['trx'] = getTrx();
        if($request->code)
            {
            $docm['code'] = $request->code;
            }
        if($request->hasFile('front'))
            {
             $this->validate($request,
            [
            'front' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            ]);
                $docm['image'] = uniqid().'.jpg';
                $request->front->move('assets/images/giftcards',$docm['image']);
            }
          if($request->hasFile('back'))
            {
             $this->validate($request,
            [
            'back' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            ]);
                $docm['image2'] = uniqid().'.jpg';
                $request->back->move('assets/images/giftcards',$docm['image2']);
            }

            Giftcardsale::create($docm);


        $auth = Auth::user();


                $notify[] = ['success', 'Giftcard Exchange Request Sent Successfully.'];
                return redirect()->route('user.sellcardlog')->withNotify($notify);
    }

    public function buycard(Request $request)
    {
     $this->validate($request,
            [
            'card' => 'required',
            'typeofcard' => 'required',
            'amount' => 'required',
            'type' => 'required',
            ]);
        $card = Giftcard::whereId($request->card)->first();

        $type = Giftcardtype::whereId($request->type)->first();
         if(!$type){

    $notify[] = ['There is no giftcard type available for '.$card->name.' at the moment. Please check back or try another giftcard'];
    return back()->withNotify($notify);

          }
        $get = $request->amount * $type->buy_rate;
        $docm['user_id'] = Auth::id();
        $docm['type'] = $request->typeofcard;
        $docm['card_id'] = $request->card;
        $docm['currency'] = $request->typeid;
        $docm['amount'] = $request->amount;
        $docm['country'] = $request->typecurrency;
        $docm['rate'] = $request->typerate;
        $docm['pay'] = $get;
        $docm['status'] = 0;
        $docm['trx_type'] = 'buy';
        $docm['trx'] = getTrx();

        Giftcardsale::create($docm);


        $auth = Auth::user();


    $notify[] = ['success', 'Giftcard Purchase Request Successfully.'];
    return redirect()->route('user.buycardlog')->withNotify($notify);
    }


    public function sellcardlog()
    {
        $auth = Auth::user();
        $get['pageTitle'] = "Sell Giftcard Log";
        $get['card'] = Giftcardsale::whereUser_id($auth->id)->whereTrxType('sell')->orderBy('created_at','desc')->paginate(7);

       $activeTemplate = checkTemplate();
        $data['activeTemplate'] = $activeTemplate;
        $data['activeTemplateTrue'] = checkTemplate(true);

        return view($activeTemplate. 'user.giftcard.giftcard-log', $data, $get);
    }

    public function buycardlog()
    {
        $auth = Auth::user();
        $get['pageTitle'] = "Buy Giftcard Log";
        $get['card'] = Giftcardsale::whereUser_id($auth->id)->whereTrxType('buy')->orderBy('created_at','desc')->paginate(7);

       $activeTemplate = checkTemplate();
        $data['activeTemplate'] = $activeTemplate;
        $data['activeTemplateTrue'] = checkTemplate(true);

        return view($activeTemplate. 'user.giftcard.giftcard-log', $data, $get);
    }

}
