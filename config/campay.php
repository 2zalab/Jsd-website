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

    // ── Méthode 1 : Token permanent (APP KEYS du dashboard CamPay) ──────────────
    // Disponible dans : CamPay Dashboard → Applications → APP KEYS → Token
    // Avantage : pas besoin d'appeler /token/ avant chaque requête
    'token' => env('CAMPAY_TOKEN', ''),

    // ── Méthode 2 : Username + Password (token temporaire via /token/) ──────────
    // Disponible dans : CamPay Dashboard → Applications → APP KEYS
    'app_username' => env('CAMPAY_USERNAME', ''),
    'app_password' => env('CAMPAY_PASSWORD', ''),

    // ── URL de base ─────────────────────────────────────────────────────────────
    // 'https://campay.net/api/'      → production
    // 'https://demo.campay.net/api/' → test/démo
    'base_url' => env('CAMPAY_BASE_URL', 'https://demo.campay.net/api/'),

    'currency' => 'XAF',

    // URL de webhook pour recevoir les notifications de paiement
    'webhook_url' => env('CAMPAY_WEBHOOK_URL', ''),
];
