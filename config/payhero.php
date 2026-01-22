<?php


    /**
     * PayHeroKenya API Configuration
     * This configuration is used to set up the PayHeroKenya API integration.
     */
    return [
        'base_url' => env('PAYHERO_BASE_URL', 'https://api.payhero.co.ke'), 
        'basic_auth_token' => env('PAYHERO_BASIC_AUTH_TOKEN'),
        'channel_id' => env('PAYHERO_CHANNEL_ID'),
        'callback_url' => env('PAYHERO_CALLBACK_URL'),
    ];
