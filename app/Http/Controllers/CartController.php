<?php

namespace App\Http\Controllers;
use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Lib\GoogleAuthenticator;
use App\Models\Storefront;
use App\Models\GeneralSetting;
use App\Models\AdminNotification;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use App\Rules\FileTypeValidate;
use App\Models\GatewayCurrency;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use DB;
use Carbon\Carbon;
class CartController extends Controller
{

    public function __construct()
    {
        $this->middleware('storefront.status');
        $this->activeTemplate = activeTemplate();
    }

    public function storefront($id)
    {
        $storefront = Storefront::whereTrx(strToUpper($id))->whereStatus(1)->firstOrFail();
        $pageTitle       = $storefront->name;
        $products = Product::whereStoreId($storefront->id)->whereStatus(1)->paginate(10);
        $activeTemplate = checkTemplate();
        $data['activeTemplate'] = $activeTemplate;
        $data['activeTemplateTrue'] = checkTemplate(true);

        return view($activeTemplate.'user.vendor.storefront.front_storefront', $data,compact('pageTitle', 'storefront','products'));
    }

    public function product($id)
    {
        $pageTitle       = 'View Product';
        $user = auth()->user();
        $product = Product::where('trx',$id)->firstOrFail();
        $storefront = Storefront::whereId($product->store_id)->firstOrFail();
        $orders = Order::whereProductId($product->id)->whereStatus(1)->sum('quantity');
        $activeTemplate = checkTemplate();
        $data['activeTemplate'] = $activeTemplate;
        $data['activeTemplateTrue'] = checkTemplate(true);

        return view($activeTemplate. 'user.vendor.storefront.front_product', $data,compact('pageTitle', 'product', 'storefront','orders'));
    }

}
