<?php
return [
    'key' => env('STRIPE_KEY'),
    'secret' => env('STRIPE_SECRET'),
    'currency' => env('CASHIER_CURRENCY'),
    'currency_symbol' => env('CASHIER_CURRENCY_SYMBOL'),//"₹",
    'webhook' => [
        'secret' => env('STRIPE_WEBHOOK_SECRET'),
        'tolerance'=>env('STRIPE_WEBHOOK_TOLERANCE')
    ]
];