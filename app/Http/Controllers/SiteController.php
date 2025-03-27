<?php

namespace App\Http\Controllers;

use App\Constants\Status;
use App\Models\AdminNotification;
use App\Models\Frontend;
use App\Models\Language;
use App\Models\Page;
use App\Models\User;
use App\Models\Review;
use App\Models\Order;
use App\Models\Giftcard;
use App\Models\Subscriber;
use App\Models\Transaction;
use App\Models\SupportMessage;
use App\Models\SupportTicket;
use App\Models\Cryptocurrency;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;

use DB;
class SiteController extends Controller
{

    public function index()
    {

        $pageTitle = 'Home';
        $sections  = Page::where('tempname', $this->activeTemplate)->where('slug', '/')->first();
        $country = session()->get('country');
        $activeTemplate = checkTemplate();
        $data['activeTemplate'] = $activeTemplate;

        return view($activeTemplate. 'home', $data,compact('pageTitle', 'sections','country'));
    }

    public function rates()
	{
		$pageTitle = 'Currency Assets Rates';
		$coins = Cryptocurrency::whereStatus(1)->get();
		$giftcards = Giftcard::whereStatus(1)->with('types')->get();
        $activeTemplate = checkTemplate();
        $data['activeTemplate'] = $activeTemplate;

        return view($activeTemplate. 'rates', $data,compact('pageTitle', 'coins','giftcards'));
	}

    public function pages($slug)
    {
        $page      = Page::where('tempname', $this->activeTemplate)->where('slug', $slug)->firstOrFail();
        $pageTitle = $page->name;
        $sections  = $page->secs;
        $activeTemplate = checkTemplate();
        $data['activeTemplate'] = $activeTemplate;

        return view($activeTemplate. 'pages', $data,compact('pageTitle', 'sections'));
    }

    public function page($slug)
    {
        $pageTitle = $slug;
        $activeTemplate = checkTemplate();
        $data['activeTemplate'] = $activeTemplate;

        return view($activeTemplate. $slug, $data,compact('pageTitle'));
    }

    public function subscribe(Request $request)
    {
        $rules = [
            'email' => 'required|email|unique:subscribers,email',
        ];
        $message = [
            "email.unique" => 'You are already subscribe',
        ];
        $validator = validator()->make($request->all(), $rules, $message);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->getMessages()]);
        }

        $subscribe        = new Subscriber();
        $subscribe->email = $request->email;
        $subscribe->save();

        return response()->json(['success' => true, 'message' => 'Thanks for subscribe']);
    }

    public function contact()
    {
        $pageTitle = "Contact";
        $activeTemplate = checkTemplate();
        $data['activeTemplate'] = $activeTemplate;

        return view($activeTemplate. 'contact', $data,compact('pageTitle'));
    }


    public function custompage($id)
    {
        $pageTitle = strToUpper($id);
        $activeTemplate = checkTemplate();
        $data['activeTemplate'] = $activeTemplate;

        return view($activeTemplate. $id, $data,compact('pageTitle'));
    }

    public function contactSubmit(Request $request)
    {
        $this->validate($request, [
            'name'    => 'required',
            'email'   => 'required',
            'subject' => 'required|string|max:255',
            'message' => 'required',
        ]);

        if (!verifyCaptcha()) {
            $notify[] = ['error', 'Invalid captcha provided'];
            return back()->withNotify($notify);
        }

        $request->session()->regenerateToken();
        $random = getNumber();
        $ticket           = new SupportTicket();
        $ticket->user_id  = auth()->id() ?? 0;
        $ticket->name     = $request->name;
        $ticket->email    = $request->email;
        $ticket->priority = Status::PRIORITY_MEDIUM;

        $ticket->ticket     = $random;
        $ticket->subject    = $request->subject;
        $ticket->last_reply = Carbon::now();
        $ticket->status     = Status::TICKET_OPEN;
        $ticket->save();

        $adminNotification            = new AdminNotification();
        $adminNotification->user_id   = auth()->user() ? auth()->user()->id : 0;
        $adminNotification->title     = 'A new support ticket has opened ';
        $adminNotification->click_url = urlPath('admin.ticket.view', $ticket->id);
        $adminNotification->save();

        $message                    = new SupportMessage();
        $message->support_ticket_id = $ticket->id;
        $message->message           = $request->message;
        $message->save();

        $notify[] = ['success', 'Ticket created successfully!'];

        return to_route('ticket.view', [$ticket->ticket])->withNotify($notify);
    }

    public function policyPages($slug, $id)
    {
        $policy    = Frontend::where('id', $id)->where('data_keys', 'privacy_policy.element')->firstOrFail();
        $pageTitle = $policy->data_values->title;
        $activeTemplate = checkTemplate();
        $data['activeTemplate'] = $activeTemplate;

        return view($activeTemplate. 'policy', $data,compact('policy', 'pageTitle'));
    }

    public function changeLanguage($lang = null)
    {
        $language = Language::where('code', $lang)->first();
        if (!$language) {
            $lang = 'en';
        }
        session()->put('lang', $lang);
        return back();
    }

    public function blogDetails($id, $slug)
    {
        $blog         = Frontend::where('id', $id)->where('data_keys', 'blog.element')->firstOrFail();
        $blog->val_1 += 1;
        $blog->save();
        $recent_blogs = Frontend::where('id', '!=', $id)->where('data_keys', 'blog.element')->latest()->take(5)->get();
        $pageTitle    = $blog->data_values->title;
        $activeTemplate = checkTemplate();
        $data['activeTemplate'] = $activeTemplate;

        return view($activeTemplate. 'blog_details', $data,compact('blog', 'pageTitle', 'recent_blogs'));
    }

    public function cookieAccept()
    {
        $general = gs();
        Cookie::queue('gdpr_cookie', $general->site_name, 43200);
        return back();
    }

    public function apiDocumentation()
    {
        $pageTitle = 'API Documentation';
        $activeTemplate = checkTemplate();
        $data['activeTemplate'] = $activeTemplate;

        return view($activeTemplate. 'api_documentation',$data, compact('pageTitle'));
    }

    public function track()
    {
        $pageTitle   = "Track Giftcard";
        $activeTemplate = checkTemplate();
        $data['activeTemplate'] = $activeTemplate;

        return view($activeTemplate. 'track', $data,compact('pageTitle'));
    }
    public function trackOrder(Request $request)
    {
        $user = User::whereEmail($request->email)->first();
        if(!$user)
        {
            return response()->json([
                'status'=> false,
                'message'=> 'Invalid Customer Email',
            ],200);
        }
        $orders = Order::whereUserId($user->id)->whereDepositCode($request->orderid)->select('product_name','price','quantity','currency','status','created_at')->get();
        if(count($orders) < 1)
        {
            return response()->json([
                'status'=> false,
                'message'=> 'Order Not Found',
            ],200);
        }
        return response()->json([
            'status'=> true,
            'message'=> 'Order Found',
            'orders'=> $orders,
        ],200);
    }


    public function blog()
    {
        $pageTitle   = "View Blog Post";
        $blogElements         = Frontend::where('data_keys', 'blog.element')->latest('id')->paginate(getPaginate());
        $activeTemplate = checkTemplate();
        $data['activeTemplate'] = $activeTemplate;

        return view($activeTemplate. 'blog', $data,compact('pageTitle', 'blogElements'));
    }

    public function cookiePolicy()
    {
        $pageTitle = 'Cookie Policy';
        $cookie    = Frontend::where('data_keys', 'cookie.data')->first();
        $activeTemplate = checkTemplate();
        $data['activeTemplate'] = $activeTemplate;

        return view($activeTemplate. 'cookie', $data,compact('pageTitle', 'cookie'));
    }

    public function placeholderImage($size = null)
    {
        $imgWidth  = explode('x', $size)[0];
        $imgHeight = explode('x', $size)[1];
        $text      = $imgWidth . '×' . $imgHeight;
        $fontFile  = realpath('assets/font/RobotoMono-Regular.ttf');
        $fontSize  = round(($imgWidth - 50) / 8);

        if ($fontSize <= 9) {
            $fontSize = 9;
        }

        if ($imgHeight < 100 && $fontSize > 30) {
            $fontSize = 30;
        }

        $image     = imagecreatetruecolor($imgWidth, $imgHeight);
        $colorFill = imagecolorallocate($image, 100, 100, 100);
        $bgFill    = imagecolorallocate($image, 175, 175, 175);
        imagefill($image, 0, 0, $bgFill);
        $textBox    = imagettfbbox($fontSize, 0, $fontFile, $text);
        $textWidth  = abs($textBox[4] - $textBox[0]);
        $textHeight = abs($textBox[5] - $textBox[1]);
        $textX      = ($imgWidth - $textWidth) / 2;
        $textY      = ($imgHeight + $textHeight) / 2;
        header('Content-Type: image/jpeg');
        imagettftext($image, $fontSize, 0, $textX, $textY, $colorFill, $fontFile, $text);
        imagejpeg($image);
        imagedestroy($image);
    }

    public function maintenance()
    {
        $pageTitle = 'Maintenance Mode';
        $general   = gs();

        if ($general->maintenance_mode == Status::DISABLE) {
            return to_route('home');
        }

        $maintenance = Frontend::where('data_keys', 'maintenance.data')->first();
        $activeTemplate = checkTemplate();
        $data['activeTemplate'] = $activeTemplate;

        return view($activeTemplate. 'maintenance', $data,compact('pageTitle', 'maintenance'));
    }
}
