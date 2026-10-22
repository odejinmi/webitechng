<?php

use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('v1', 'ApiController@process')->name('api.v1');
Route::post('/verify/voucher', 'SiteController@verifypinPost')->name('api.verifyvoucher');
Route::middleware('throttle:webhooks')->group(function () {
    Route::post('/strowallet/webhook', 'ApiController@strowalletwebhook')->name('api.nuban.strowalletwebhook');
    Route::post('/paylony/webhook', 'ApiController@paylonywebhook')->name('api.nuban.paylonywebhook');
    Route::post('/monnify/webhook', 'ApiController@monnifywebhook')->name('api.nuban.monnifywebhook');
    Route::post('/payvessel/webhook', 'ApiController@payvesselwebhook')->name('api.nuban.payvesselwebhook');
    Route::post('/vpay/webhook', 'ApiController@vpaywebhook');
    Route::post('/crypto/wallet', 'ApiController@cryptoWallet');
});
Route::middleware(['cron.secret', 'throttle:api'])->group(function () {
    Route::post('/savings/cronjob', 'ApiController@savings')->name('api.savings');
    Route::post('/fixed/cronjob', 'ApiController@fixed')->name('api.fixed');
});


Route::prefix('v1')->group(function () {
Route::get('networks', 'ApiMerchantController@networks');
Route::get('intenet/plans', 'ApiMerchantController@dataplans');
Route::post('intenet/buy', 'ApiMerchantController@dataplanBuy');
Route::post('transaction/verify', 'ApiMerchantController@TRXVERIFY');
Route::post('create/customer', 'ApiMerchantController@CREATECUSTOMER');
Route::post('fetch/customer', 'ApiMerchantController@FETCHCUSTOMER');
Route::post('identity/verify', 'ApiMerchantController@IDVERIFY');
});

// Mobile User API Routes
Route::prefix('user')->group(base_path('routes/api/user.php'));

