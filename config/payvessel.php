<?php

return [
    'base_url' => env('PAYVESSEL_BASE_URL', 'https://api.payvessel.com'),
    'api_key' => env('PAYVESSELAPIKEY'),
    'api_secret' => env('PAYVESSELSEK'),
    'business_id' => env('PAYVESSELBIZID'),
    'virtual_account_banks' => array_filter(explode(',', env('PAYVESSEL_VIRTUAL_ACCOUNT_BANKS', '999991,120001'))),
    'webhook_ips' => ['3.255.23.38', '162.246.254.36'],
];
