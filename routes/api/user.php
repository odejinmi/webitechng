<?php

use Illuminate\Support\Facades\Route;

Route::get('security/public-key', 'Api\Mobile\SecurityController@publicKey')->name('api.user.security.public-key');

Route::namespace('Api\Auth')->name('api.user.')->group(function () {
    Route::post('login', 'LoginController@login')->middleware('throttle:login')->name('login');
    Route::post('register', 'RegisterController@register')
        ->middleware(['registration.status', 'throttle:registration'])
        ->name('register');

    Route::prefix('password')->name('password.')->group(function () {
        Route::post('email', 'ForgotPasswordController@sendResetCodeEmail')->middleware('throttle:password-reset')->name('email');
        Route::post('verify-code', 'ForgotPasswordController@verifyCode')->middleware('throttle:password-reset')->name('verify.code');
        Route::post('reset', 'ResetPasswordController@reset')->middleware('throttle:password-reset')->name('update');
    });
});

Route::namespace('User\Auth')->name('api.user.')->group(function () {
    Route::post('check-mail', 'RegisterController@checkUser')->middleware('throttle:registration')->name('checkUser');
});

Route::middleware(['auth:sanctum', 'latest.api.token'])->name('api.user.')->group(function () {
    Route::post('logout', 'Api\Auth\LoginController@logout')->name('logout');

    Route::controller('Api\AuthorizationController')->group(function () {
        Route::get('authorization', 'authorization')->name('authorization');
        Route::get('resend-verify', 'sendVerifyCode')->middleware('throttle:password-reset')->name('send.verify.code');
        Route::post('verify-email', 'emailVerification')->name('verify.email');
        Route::post('verify-mobile', 'smsVerification')->name('verify.sms');
        Route::post('verify-g2fa', 'g2faVerification')->name('go2fa.verify');
    });
});

Route::middleware(['auth:sanctum', 'latest.api.token', 'checkStatusApi'])
    ->name('api.user.')
    ->group(base_path('routes/api/bills.php'));
