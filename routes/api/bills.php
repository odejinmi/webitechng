<?php

use Illuminate\Support\Facades\Route;

Route::controller('Api\Mobile\BillsController')->group(function () {
    Route::get('bills/services', 'services')->name('bills.services');

    Route::prefix('airtime')->middleware('mobile.feature:airtime')->name('airtime.')->group(function () {
        Route::get('operators', 'airtimeOperators')->name('operators');
        Route::post('buy/airtime', 'buyAirtime')->middleware('kyc.status')->name('buy');
        Route::post('to_cash/request/fee', 'airtimeToCashFee')->middleware('mobile.feature:airtime2cash')->name('to-cash.fee');
        Route::post('to_cash/request', 'convertAirtimeToCash')
            ->middleware(['mobile.feature:airtime2cash', 'kyc.status'])
            ->name('to-cash.submit');
    });

    Route::prefix('internet')->middleware('mobile.feature:internetsme')->name('internet.')->group(function () {
        Route::get('operators', 'internetOperators')->name('operators');
        Route::post('internet_operator_id', 'internetPlans')->name('plans');
        Route::post('buy/internet', 'buyInternet')->middleware('kyc.status')->name('buy');
    });

    Route::prefix('utility')->middleware('mobile.feature:utilitylocal')->name('utility.')->group(function () {
        Route::get('providers', 'utilityProviders')->name('providers');
        Route::post('utility_operator_id', 'validateUtility')->name('validate');
        Route::post('buy/utility', 'buyUtility')->middleware('kyc.status')->name('buy');
    });

    Route::prefix('cabletv')->middleware('mobile.feature:cabletv')->name('cabletv.')->group(function () {
        Route::get('buy/cabletv', 'cableProviders')->name('providers');
        Route::post('cabletv_operator_id', 'cablePlans')->name('plans');
        Route::post('cabletv_verify', 'validateCable')->name('validate');
        Route::post('buy/cabletv', 'buyCable')->middleware('kyc.status')->name('buy');
    });

    Route::prefix('education')->name('education.')->group(function () {
        Route::get('buy/education', 'educationProviders')->name('providers');
        Route::post('education_operator_id', 'educationPlans')->name('plans');
        Route::post('education_verify', 'validateEducation')->name('validate');
        Route::post('buy/education', 'buyEducation')->middleware('kyc.status')->name('buy');
    });

    Route::prefix('betting')->middleware('mobile.feature:betting')->name('betting.')->group(function () {
        Route::get('providers', 'bettingProviders')->name('providers');
        Route::post('verify/merchant', 'validateBettingAccount')->name('validate');
        Route::post('fund/wallet', 'fundBettingWallet')->middleware('kyc.status')->name('fund');
    });

    Route::prefix('bills')->name('bills.payvessel.')->group(function () {
        Route::get('billers', 'payVesselBillers')->name('billers');
        Route::get('billers/{billerId}/items', 'payVesselItems')->name('items');
        Route::post('validate-account', 'validatePayVesselAccount')->name('validate');
        Route::post('orders', 'createPayVesselOrder')->middleware('kyc.status')->name('order');
    });
});
