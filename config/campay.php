<?php

return [
    /*
    |--------------------------------------------------------------------------
    | CamPay Configuration
    |--------------------------------------------------------------------------
    | CamPay est une passerelle de paiement mobile money camerounaise.
    | Supports: MTN Mobile Money, Orange Money
    |
    | Documentation: https://documenter.getpostman.com/view/2391374/T1LV8PVA
    */

    'app_username' => env('CAMPAY_USERNAME', ''),
    'app_password' => env('CAMPAY_PASSWORD', ''),

    // 'https://campay.net/api/' pour la production
    // 'https://demo.campay.net/api/' pour le test/demo
    'base_url' => env('CAMPAY_BASE_URL', 'https://demo.campay.net/api/'),

    'currency' => 'XAF',

    // URL de webhook pour recevoir les notifications de paiement
    'webhook_url' => env('CAMPAY_WEBHOOK_URL', ''),
];
