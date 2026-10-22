<?php

return [
    'cron_secret' => env('CRON_SECRET'),
    'trusted_proxies' => array_values(array_filter(array_map(
        'trim',
        explode(',', env('TRUSTED_PROXIES', ''))
    ))),
];
