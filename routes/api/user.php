<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Mobile User API Routes
|--------------------------------------------------------------------------
|
| Here are the mobile API routes mapped from web routes in user.php.
| Unauthenticated routes are grouped separately from routes protected
| by Sanctum authentication (auth:sanctum).
|
*/

Route::name('api.user.')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Authentication Routes
    |--------------------------------------------------------------------------
    */
    Route::namespace('Api\Auth')->group(function () {
        Route::post('login', 'LoginController@login')->name('login');
        Route::post('register', 'RegisterController@register')->name('register');
        Route::post('check-mail', 'RegisterController@checkUser')->name('checkUser');

        Route::prefix('password')->name('password.')->group(function () {
            Route::post('email', 'ForgotPasswordController@sendResetCodeEmail')->name('email');
            Route::post('verify-code', 'ForgotPasswordController@verifyCode')->name('verify.code');
            Route::post('reset', 'ResetPasswordController@reset')->name('update');
        });
    });

    /*
    |--------------------------------------------------------------------------
    | Public Invoice & Account Request Routes
    |--------------------------------------------------------------------------
    */
    Route::namespace('User')->controller('InvoiceController')->prefix('invoice')->group(function () {
        Route::get('pay/{id}', 'invoice_pay');
        Route::post('pay/{id}', 'invoice_pay_submit');
        Route::get('confirm', 'invoiceConfirm')->name('invoice.confirm');
        Route::get('request/account', 'request_account')->name('request_account');
    });

    Route::namespace('User')->controller('QrController')->group(function () {
        Route::get('qr/{id?}', 'index')->name('qr');
        Route::post('qr/{id}', 'receivepayment');
    });

    /*
    |--------------------------------------------------------------------------
    | Authenticated Mobile API Routes (auth:sanctum)
    |--------------------------------------------------------------------------
    */
    Route::middleware(['auth:sanctum'])->group(function () {

        // Logout
        Route::post('logout', 'Api\Auth\LoginController@logout')->name('logout');

        // RND Token Purchases
        Route::namespace('User')->controller('RndTokenPurchaseController')->prefix('rnd')->name('rnd.')->group(function () {
            Route::get('purchases', 'index')->name('purchases.index');
            Route::get('purchases/create', 'create')->name('purchases.create');
            Route::post('purchases', 'store')->name('purchases.store');
            Route::get('purchases/{purchase}', 'show')->name('purchases.show');
            Route::get('purchases/{purchase}/download/receipt', 'downloadReceipt')->name('purchases.download.receipt');
        });

        // Verification / Authorization
        Route::namespace('Api')->controller('AuthorizationController')->group(function () {
            Route::get('authorization', 'authorization')->name('authorization');
            Route::get('resend-verify/{type}', 'sendVerifyCode')->name('send.verify.code');
            Route::post('verify-email', 'emailVerification')->name('verify.email');
            Route::post('verify-mobile', 'smsVerification')->name('verify.mobile');
            Route::post('verify-g2fa', 'g2faVerification')->name('go2fa.verify');
        });

        // User Core & Dashboard
        Route::namespace('Api')->controller('UserController')->group(function () {
            Route::get('dashboard', 'dashboard')->name('home');
            Route::get('withdraw/methods', 'withdrawMethods')->name('withdraw.methods');
            Route::post('withdraw', 'withdrawStore')->name('withdraw.money');
            Route::post('withdraw/preview', 'withdrawConfirm')->name('withdraw.confirm');
            Route::get('withdraw/history', 'withdrawLog')->name('withdraw.history');
            Route::get('deposit/history', 'depositHistory')->name('deposit.history');
            Route::get('transactions', 'transactions')->name('transactions');
            Route::get('orders', 'orders')->name('orders');
            Route::get('cashbacks', 'cashbacks')->name('cashbacks');
            Route::get('cashback-balance', 'cashbackbalance')->name('cashback.balance');
            Route::get('order/details/{order_number}', 'orderDetails')->name('order.details');
        });

        // Additional User operations (from User\UserController)
        Route::namespace('User')->controller('UserController')->group(function () {
            Route::get('user-data', 'userData')->name('data');
            Route::post('user-data-submit', 'userDataSubmit')->name('data.submit');
            Route::get('api/key', 'apikey')->name('api.key');
            Route::get('api/key/generate', 'apikeyGenerate')->name('api.key.generate');
            Route::post('api/webhook', 'apiWebhook')->name('api.webhook');

            Route::post('trxpass', 'trxpass')->name('trxpass');
            Route::get('trade/assets', 'CryptoTrade')->name('crypto.trade.index');
            Route::get('login_earn', 'login_earn')->name('login_earn');

            Route::match(['get', 'post'], 'generatenuban', 'generatenuban')->name('generate.nuban');
            Route::match(['get', 'post'], 'qrcode', 'qrcode')->name('qr.index');
            Route::get('kyc', 'kyc')->name('kyc.index');
            Route::post('kyc', 'kycpost');

            // P2P
            Route::get('p2p/log', 'p2plog')->name('p2p.history');
            Route::get('p2p/transfer', 'p2p')->name('p2p');
            Route::post('p2p/transfer', 'p2ppost');

            // 2FA
            Route::get('twofactor', 'show2faForm')->name('twofactor');
            Route::post('twofactor/enable', 'create2fa')->name('twofactor.enable');
            Route::post('twofactor/disable', 'disable2fa')->name('twofactor.disable');

            Route::get('transaction/receipt/{id}', 'transactionreceipt')->name('transaction.receipt');
            Route::get('attachment-download/{fil_hash}', 'attachmentDownload')->name('attachment.download');
        });

        // Invoices
        Route::namespace('User')->controller('InvoiceController')->prefix('invoice')->group(function () {
            Route::get('/', 'index')->name('invoice.index');
            Route::get('create', 'create')->name('invoice.create');
            Route::post('create', 'create_link');
            Route::get('edit/{id}', 'edit')->name('invoice.edit');
            Route::post('edit/{id}', 'update');
            Route::get('history', 'history')->name('invoice.history');
            Route::get('details/{id}', 'invoice')->name('invoice.details');
            Route::post('details/{id}', 'invoicesubmit');
        });

        // Request Payment Account
        Route::namespace('User')->controller('RequestAccountController')->prefix('request/account')->group(function () {
            Route::get('/', 'index')->name('requestaccount.index');
            Route::get('create', 'create')->name('requestaccount.create');
            Route::post('create', 'createRequest');
            Route::get('confirm/{id}', 'confirm')->name('requestaccount.confirm');
            Route::post('confirm/{id}', 'confirmPost');
            Route::get('cancel/{id}', 'cancel')->name('requestaccount.cancel');
            Route::get('history', 'history')->name('requestaccount.history');
        });

        // Giftcard Auto
        Route::namespace('User')->controller('GiftcardAutoController')->prefix('giftcard/auto')->group(function () {
            Route::get('digital', 'index')->name('giftcard.digital.index');
            Route::get('shop', 'shop')->name('giftcard.digital.shop');
            Route::get('history', 'giftcardHistory')->name('giftcard.digital.history');
            Route::get('details/{id}', 'giftcardDetails')->name('giftcard.details');
            Route::get('redeem/code/{id}', 'giftcardRedeemCode')->name('giftcard.redeem');
            Route::get('getToken', 'authenticate')->name('giftcard.authenticate');
            Route::get('buy', 'buygiftcard')->name('buy.giftcard');
            Route::get('fetch', 'fecthgiftcards')->name('fecthgiftcards');
            Route::get('get', 'giftcardbyid')->name('giftcardbyid');
            Route::post('buy/{id}', 'giftcardBuy')->name('giftcard.auto.buy');
        });

        // Giftcard Manual Trade
        Route::namespace('User')->controller('GiftcardController')->prefix('giftcard/trade')->group(function () {
            Route::get('index', 'index')->name('tradegift');
            Route::get('sell-giftcard', 'sellgift')->name('sellgift');
            Route::get('sell-gift-card/{id}', 'selectgiftcard')->name('selectgiftcardsell');
            Route::post('sell-gift-card/{id}', 'sellcard')->name('sellcard');
            Route::get('sell/giftcard-log', 'sellcardlog')->name('sellcardlog');

            Route::get('buy-giftcard', 'buygift')->name('buygift');
            Route::get('buy-gift-card/{id}', 'selectgiftcard')->name('selectgiftcardbuy');
            Route::post('buy-gift-card/{id}', 'buycard');
            Route::get('buy/giftcard-log', 'buycardlog')->name('buycardlog');
        });

        // Escrow
        Route::namespace('User')->controller('EscrowController')->name('escrow.')->prefix('escrow')->group(function () {
            Route::get('welcome', 'welcome')->name('welcome');
            Route::get('step-one', 'stepOne')->name('step.one');
            Route::post('step-one', 'submitStepOne')->name('step.one.submit');
            Route::get('step-two', 'stepTwo')->name('step.two');
            Route::post('step-two', 'submitStepTwo')->name('step.two.submit');
            Route::get('details/{id}', 'details')->name('details');

            Route::post('cancel/{id}', 'cancel')->name('cancel');
            Route::post('accept/{id}', 'accept')->name('accept');
            Route::post('dispute/{id}', 'dispute')->name('dispute');
            Route::post('dispatch/{id}', 'dispatchEscrow')->name('dispatch');
            Route::post('complete/{id}', 'completeEscrow')->name('completed');

            Route::post('message-reply', 'replyMessage')->name('message.reply');
            Route::get('get-messages', 'getMessages')->name('message.get');
            Route::get('{type?}', 'index')->name('index');
        });

        // Escrow Milestones
        Route::namespace('User')->controller('MilestoneController')->name('escrow.milestone.')->prefix('escrow/milestone')->group(function () {
            Route::get('{id}', 'milestones')->name('index');
            Route::post('{id}', 'createMilestone')->name('create');
            Route::post('pay/{id}', 'payMilestone')->name('pay');
        });

        // Loans
        Route::namespace('User')->controller('LoanController')->name('loan.')->prefix('loan')->group(function () {
            Route::get('plans', 'plans')->name('plans');
            Route::post('apply/{id}', 'applyLoan')->name('apply');
            Route::get('application-preview', 'loanPreview')->name('apply.form');
            Route::post('apply-confirm', 'confirm')->name('apply.confirm');
            Route::get('list', 'list')->name('list');
            Route::get('instalment/logs/{loan_number}', 'installments')->name('instalment.logs');
        });

        // Buy Crypto
        Route::namespace('User')->controller('BuyCryptoController')->prefix('buy/asset')->name('crypto.')->group(function () {
            Route::get('/', 'index')->name('buy.index');
            Route::get('request', 'buy')->name('buy');
            Route::post('request', 'buy')->name('buy.request');
            Route::post('coin/details', 'coindetails')->name('buy.coin.details');
            Route::post('coin/buy', 'buyProcess')->name('buy.coin');
            Route::post('buy/verify/manual', 'buyConfirmManual')->name('buy.confirm.manual');
            Route::get('log', 'log')->name('buy.log');
        });

        // Sell Crypto
        Route::namespace('User')->controller('SellCryptoController')->prefix('sell/asset')->name('crypto.')->group(function () {
            Route::get('/', 'index')->name('sell.index');
            Route::get('request', 'sell')->name('sell');
            Route::post('coin/details', 'coindetails')->name('sell.coin.details');
            Route::post('request', 'sell')->name('sell.request');
            Route::post('coin/sell', 'sellProcess')->name('sell.coin');
            Route::post('sell/verify', 'sellConfirm')->name('sell.confirm');
            Route::post('sell/verify/manual', 'sellConfirmManual')->name('sell.confirm.manual');
            Route::get('log', 'log')->name('sell.log');
        });

        // Crypto Wallet
        Route::namespace('User')->controller('CryptoController')->prefix('crypto')->group(function () {
            Route::get('currencies', 'currencies')->name('crypto.index');
            Route::get('assets/rates', 'rates')->name('crypto.rates');
            Route::get('wallet/{id}', 'index')->name('crypto.wallet');
            Route::get('wallet/transactions/{id}', 'transactions')->name('crypto.wallet.trx');
            Route::post('wallet/validate/{id}', 'validatewallet')->name('crypto.wallet.validate');
            Route::post('wallet/exchange/{id}', 'exchange')->name('crypto.exchange');
            Route::post('wallet/send/{id}', 'send')->name('crypto.send');
            Route::post('wallet/swap/{id}', 'swap')->name('crypto.swap');
            Route::post('wallet/sellall/{id}', 'sellall')->name('crypto.sellall');
        });

        // Bank Transfer
        Route::namespace('User')->controller('BankTransferController')->prefix('bank/transfer')->group(function () {
            Route::get('/', 'index')->name('bank.transfer');
            Route::get('new', 'start')->name('bank.transfer.start');
            Route::post('validate/strowallet', 'validatebankstrowallet')->name('bank.validate.strowallet');
            Route::post('strowallet', 'banktransferStrowallet')->name('bank.transfer.strowallet');
            Route::post('validate/monnify', 'validatebankmonnify')->name('bank.validate.monnify');
            Route::post('monnify', 'banktransfernubanMonnify')->name('bank.transfer.monnify');
            Route::post('validate/blochq', 'validatebankblochq')->name('bank.validate.blochq');
            Route::post('blochq', 'banktransfernubanBlochq')->name('bank.transfer.blochq');
            Route::get('log', 'history')->name('bank.transfer.history');
        });

        // VCard
        Route::namespace('User')->controller('VCardController')->prefix('vcard')->group(function () {
            Route::get('create/customer', 'showCreateForm')->name('create.customer');
            Route::post('create/customer/add', 'savedata')->name('create.customer.add');
            Route::get('create/card', 'create_card')->name('create.card');
            Route::post('create/card/add', 'save_card')->name('create.card.add');
            Route::get('list/card', 'list_cards')->name('list.card');
            Route::get('view/card/{id}', 'view_card')->name('view.card');
            Route::get('fund/card/{id}', 'fund_card')->name('fund.card');
            Route::post('post_fund/card/{id}', 'post_fund_card')->name('post_fund.card');
            Route::get('withdraw/card/{id}', 'withdraw_card')->name('withdraw.card');
            Route::post('post_withdraw/card/{id}', 'post_withdraw_card')->name('post_withdraw.card');
            Route::get('freez/card/{id}', 'freez_card')->name('freez.card');
            Route::get('unfreez/card/{id}', 'unfreez_card')->name('unfreez.card');
        });

        // Virtual Cards
        Route::namespace('User')->controller('VirtualCardController')->prefix('virtualcard')->group(function () {
            Route::get('request', 'index')->name('virtualcard.index');
            Route::post('request', 'Request_virtualCard');
            Route::get('history', 'history')->name('virtualcard.history');
            Route::get('details/{id}', 'details')->name('virtualcard.details');
            Route::get('status/block/{id}', 'block')->name('virtualcard.status.block');
            Route::post('status/password/{id}', 'password')->name('virtualcard.status.password');
            Route::post('fund/balance/{id}', 'fundbalance')->name('virtualcard.fund.balance');
        });

        // Voucher
        Route::namespace('User')->controller('VoucherController')->prefix('voucher')->group(function () {
            Route::get('/', 'index')->name('voucher.index');
            Route::get('create', 'create')->name('voucher.create');
            Route::post('create', 'create_voucher');
            Route::post('redeem', 'redeem')->name('voucher.redeem');
            Route::get('history', 'history')->name('voucher.history');
        });

        // Savings
        Route::namespace('User')->controller('SavingsController')->prefix('savings')->group(function () {
            Route::get('/', 'index')->name('savings.index');
            Route::get('request/savings', 'requestsavings')->name('savings.start');
            Route::post('request/savings', 'requestsubmit');
            Route::get('my-savings', 'mysavings')->name('savings.history');
            Route::get('savings/{id}', 'viewsaved')->name('viewsaved');
            Route::post('savings/{id}', 'savenow')->name('save.pay');
            Route::post('savings/close/{id}', 'saveclose')->name('save.close');
        });

        // Storefront
        Route::namespace('User')->controller('StorefrontController')->prefix('storefront')->group(function () {
            Route::get('/', 'index')->name('storefront.index');
            Route::get('create', 'create')->name('storefront.create');
            Route::post('create', 'create_store');
            Route::get('history', 'history')->name('storefront.history');
            Route::get('edit/{id}', 'edit')->name('storefront.edit');
            Route::post('edit/{id}', 'update');
            Route::get('products/{id}', 'products')->name('storefront.products');
            Route::post('products/{id}', 'productsAdd');
            Route::post('product/{id}', 'productUpdate')->name('storefront.product');
            Route::get('storefront/{id}', 'storefront')->name('storefront');
            Route::post('product/buy/{id}', 'productBuy')->name('product.buy');
            Route::get('purchase/order', 'Myorder')->name('storefront.purchase.order');
            Route::get('order/status/{id}', 'orderStatus')->name('storefront.order.status');
        });

        // Events
        Route::namespace('User')->controller('EventController')->prefix('event')->group(function () {
            Route::get('/', 'event')->name('event.index');
            Route::get('events', 'events')->name('event.list');
            Route::get('view/{id}', 'eventDetails')->name('event.view');
            Route::get('buy/ticket/{id}', 'eventBuy')->name('event.ticket.buy');
            Route::get('buy/ticket/pay/{id}', 'buyTicket')->name('event.ticket.buy.proceed');
            Route::get('tickets/{id}', 'Tickets')->name('event.tickets');

            Route::post('add-to-cart', 'addToCart')->name('event.add-to-cart');
            Route::get('cart/cart-data', 'getCart')->name('event.get-cart-data');
            Route::get('cart/cart-data2', 'getCart2')->name('event.get-cart-data2');
            Route::get('get_cart-total', 'getCartTotal')->name('event.get-cart-total');
            Route::post('remove_cart_item/{id}', 'removeCartItem')->name('event.remove-cart-item');

            Route::get('history', 'history')->name('event.history');
        });

        // Betting
        Route::namespace('User')->controller('BettingController')->prefix('betting')->group(function () {
            Route::get('/', 'betting')->name('betting.index');
            Route::get('fund/wallet', 'fund_wallet')->name('fund.betting.wallet');
            Route::get('verify/merchant', 'verify_merchant')->name('betting.wallet.verify');
            Route::post('fund/wallet', 'fund_wallet_post')->name('fund.betting.wallet');
            Route::get('history', 'history')->name('betting.history');
        });

        // Airtime (VTU)
        Route::namespace('User')->controller('AirtimeController')->prefix('airtime')->group(function () {
            Route::get('/', 'airtime')->name('airtime.index');
            Route::get('buy/airtime', 'buy_airtime')->name('buy.airtime');
            Route::post('buy/airtime', 'buy_airtime_post')->name('buy.airtime');
            Route::get('airtime_operators', 'airtime_operators')->name('airtime.operators');

            Route::get('local', 'airtimelocal')->name('airtime.indexlocal');
            Route::get('buy/airtime/local', 'buy_airtime_local')->name('buy.airtime.local');
            Route::post('buy/airtime/local/post', 'buy_airtime_post_local')->name('buy.airtime.local.post');

            Route::get('history', 'history')->name('airtime.history');
            Route::get('to_cash', 'to_cash')->name('airtime.tocash');
            Route::get('to_cash/request', 'to_cash_request')->name('airtime.tocash.request');
            Route::post('to_cash/request', 'to_cash_request_post');
            Route::get('to_cash/history', 'to_cash_history')->name('airtime.tocash.history');
            Route::post('to_cash/request/fee', 'to_cash_request_fee')->name('airtime.tocash.fee');
        });

        // Internet Data (VTU)
        Route::namespace('User')->controller('InternetController')->prefix('internet')->group(function () {
            Route::get('/', 'internet')->name('internet.index');
            Route::get('buy/internet', 'buy_internet')->name('buy.internet');
            Route::post('buy/internet', 'buy_internet_post')->name('buy.internet');
            Route::get('internet_operators', 'internet_operators')->name('internet.operators');
            Route::post('internet_operator_id', 'operatorsInternetdetails')->name('internet.operatorsInternetdetails');
            Route::get('history', 'history')->name('internet.history');
        });

        // Internet SME (VTU)
        Route::namespace('User')->controller('InternetSmeController')->prefix('internet/sme')->group(function () {
            Route::get('/', 'internet')->name('internet_sme.index');
            Route::get('buy/internet', 'buy_internet')->name('buy.internet_sme');
            Route::post('buy/internet/n3tdata', 'buy_internet_post_n3tdata')->name('buy.internet_sme_n3tdata');
            Route::post('buy/internet/gsubz', 'buy_internet_post_gsubz')->name('buy.internet_sme_gsubz');
            Route::post('buy/internet/gtidings', 'buy_internet_sme_gtidings')->name('buy.internet_sme_gtidings');
            Route::post('buy/internet/natkemlinks', 'buy_internet_sme_natkemlinks')->name('buy.internet_sme_natkemlinks');
            Route::post('buy/internet/techhub', 'buy_internet_sme_techhub')->name('buy.internet_sme_techhub');
            Route::get('internet_operators', 'internet_operators')->name('internet_sme.operators');
            Route::post('internet_operator_id/n3tdata', 'operatorsInternetdetailsN3TDATA')->name('internet_sme.operatorsInternetdetailsN3TDATA');
            Route::post('internet_operator_id/gsubz', 'operatorsInternetdetailsGSUBZ')->name('internet_sme.operatorsInternetdetailsGSUBZ');
            Route::post('internet_operator_id/gtidings', 'operatorsInternetdetailsGTIDINGS')->name('internet_sme.operatorsInternetdetailsGTIDINGS');
            Route::post('internet_operator_id/natkemlinks', 'operatorsInternetdetailsNATKEMLINKS')->name('internet_sme.operatorsInternetdetailsNATKEMLINKS');
            Route::post('internet_operator_id/techhub', 'operatorsInternetdetailsTECHHUB')->name('internet_sme.operatorsInternetdetailsTECHHUB');
            Route::get('history', 'history')->name('internet_sme.history');
        });

        // Utility Bills
        Route::namespace('User')->controller('UtilityController')->prefix('utility')->group(function () {
            Route::get('/', 'utility')->name('utility.index');
            Route::get('buy/utility', 'buy_utility')->name('buy.utility');
            Route::post('buy/utility', 'buy_utility_post')->name('buy.utility');
            Route::get('utility_operators', 'utility_operators')->name('utility.operators');
            Route::post('utility_operator_id', 'operatorsUtilitydetails')->name('utility.operatorsUtilitydetails');
            Route::get('history', 'history')->name('utility.history');
        });

        // Utility Bills Local
        Route::namespace('User')->controller('UtilityLocalController')->prefix('utility/local')->group(function () {
            Route::get('/', 'utility')->name('utility.local.index');
            Route::get('buy/utility', 'buy_utility')->name('buy.local.utility');
            Route::post('buy/utility', 'buy_utility_post')->name('buy.local.utility');
            Route::get('verify/utility', 'verify_utility')->name('local.utility.verify');
            Route::get('history', 'history')->name('utility.local.history');
        });

        // Cable TV
        Route::namespace('User')->controller('CabletvController')->prefix('cabletv')->group(function () {
            Route::get('/', 'cabletv')->name('cabletv.index');
            Route::get('buy/cabletv', 'buy_cabletv')->name('buy.cabletv');
            Route::post('buy/cabletv', 'buy_cabletv_post')->name('buy.cabletv');
            Route::get('cabletv_operators', 'cabletv_operators')->name('cabletv.operators');
            Route::get('cabletv_verify', 'cabletv_verify')->name('cabletv.verifydecoder');
            Route::post('cabletv_operator_id', 'operatorsUtilitydetails')->name('cabletv.operatorsUtilitydetails');
            Route::get('history', 'history')->name('cabletv.history');
        });

        // Education
        Route::namespace('User')->controller('EducationController')->prefix('education')->group(function () {
            Route::get('/', 'education')->name('education.index');
            Route::get('buy/education', 'buy_education')->name('buy.education');
            Route::post('buy/education', 'buy_education_post')->name('buy.education');
            Route::get('education_operators', 'education_operators')->name('education.operators');
            Route::get('education_verify', 'education_verify')->name('education.verifydecoder');
            Route::post('education_operator_id', 'operatorsUtilitydetails')->name('education.operatorsUtilitydetails');
            Route::get('history', 'history')->name('education.history');
        });

        // Insurance
        Route::namespace('User')->controller('InsuranceController')->prefix('insurance')->group(function () {
            Route::get('/', 'insurance')->name('insurance.index');
            Route::get('buy/insurance', 'buy_insurance')->name('buy.insurance');
            Route::post('buy/insurance', 'buy_insurance_post')->name('buy.insurance');
            Route::get('insurance_operators', 'insurance_operators')->name('insurance.operators');
            Route::post('buy/insurance/motor', 'buy_insurance_post_motor')->name('buy.insurance.motor');
            Route::post('buy/insurance/personal', 'buy_insurance_post_personal')->name('buy.insurance.personal');
            Route::get('history', 'history')->name('insurance.history');
        });

        // Profile Settings
        Route::namespace('User')->controller('ProfileController')->prefix('profile')->group(function () {
            Route::get('downlines', 'downlines')->name('downlines');
            Route::get('profile-setting', 'profile')->name('profile.setting');
            Route::post('profile-setting', 'submitProfile');
            Route::get('change-password', 'changePassword')->name('change.password');
            Route::post('change-password', 'submitPassword');
            Route::post('change-trxpassword', 'submitTrxPassword')->name('change.trxpassword');
            Route::post('deactivate-account', 'deactivate')->name('account.deactivate');
        });

        // Payment Deposits
        Route::namespace('Api')->controller('PaymentController')->prefix('deposit')->name('deposit.')->group(function () {
            Route::get('methods', 'depositMethods')->name('methods');
            Route::post('insert', 'depositInsert')->name('insert');
            Route::post('confirm', 'depositConfirm')->name('confirm');
            Route::get('manual', 'manualDepositConfirm')->name('manual.confirm');
            Route::post('manual', 'manualDepositUpdate')->name('manual.update');
        });

    });
});
