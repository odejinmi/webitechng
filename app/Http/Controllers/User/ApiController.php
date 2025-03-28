<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class ApiController extends Controller
{

    //Api Documentation
    public function api()
    {
        $user  = User::whereId(auth()->user()->id)->first();

        if($user->vendor != 1)
        {
        $notify[] = ['error', 'You are not a vendor'];
        return redirect()->route('user.home')->withNotify($notify);
        }
        $pageTitle = 'API Documentation';
        $activeTemplate = checkTemplate();
        $data['activeTemplate'] = $activeTemplate;
        $data['activeTemplateTrue'] = checkTemplate(true);

        return view($activeTemplate. 'user.api.index', $data,compact('pageTitle'));
    }

    public function generateApiKey()
    {
        $user = auth()->user();
        if($user->vendor != 1)
        {
        $notify[] = ['error', 'You are not a vendor'];
        return redirect()->route('user.home')->withNotify($notify);
        }
        $user->api_key = sha1(time());
        $user->save();
        $notify[] = ['success', 'Generated new api key!'];
        return back()->withNotify($notify);
    }
}
