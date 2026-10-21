<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Mobile User Authentication Routes
|--------------------------------------------------------------------------
|
| Authentication remains API-specific because mobile clients need Sanctum
| tokens. Public and authenticated product routes are loaded from the web
| user route file so both clients execute the same controller methods.
|
*/

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

Route::middleware(['auth:sanctum', 'latest.api.token'])
    ->name('api.user.')
    ->group(function () {
        Route::post('logout', 'Api\Auth\LoginController@logout')->name('logout');
    });

$isMobileRoute = true;
require base_path('routes/user.php');
unset($isMobileRoute);
