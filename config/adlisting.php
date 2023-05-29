<?php

return [
    'settings' => '',

    /*
    |--------------------------------------------------------------------------
    | Application language Configuration
    |--------------------------------------------------------------------------
    */

    'lang' => env('APP_DEFAULT_LANGUAGE'),

    /*
    |--------------------------------------------------------------------------
    | Application Currency Configuration
    |--------------------------------------------------------------------------
    */

    'currency' => env('APP_CURRENCY','USD'),
    'currency_symbol' => env('APP_CURRENCY_SYMBOL','$'),
    'currency_symbol_position' => env('APP_CURRENCY_SYMBOL_POSITION','left'),
];
