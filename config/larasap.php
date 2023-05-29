<?php

return [

    'telegram' => [
        'api_token' => '',
        'bot_username' => '',
        'channel_username' => '', // Channel username to send message
        'channel_signature' => '', // This will be assigned in the footer of message
        'proxy' => false,   // True => Proxy is On | False => Proxy Off
    ],

    'twitter' => [
        'consurmer_key' => '',
        'consurmer_secret' => '',
        'access_token' => '',
        'access_token_secret' => ''
    ],

    'facebook' => [
        // 'app_id' => '3330790947249438',
        // 'app_secret' => 'bf7e7187c8ce7c2e5c30e6fe4156204b',
        // 'default_graph_version' => 'v15.0',
        // 'page_access_token' => 'EAAvVVjM7XR4BAAPHu4jUjc6IiwZAXmhQvZBaPyLRCrwqgFXCS1nfqTUcUbB4wTvtBKCMZB2e5MS5ZCoGlMhZCGXl0Y0aaxe2ZBw46unS8bwOvERB5v95OpF9CGmByMom5jGb7YNawU609DuC4T59sxjDmIN4V70E2tL4HSH4A4igFLZCU9eq6gq2yAQjIhWQuyhZBaytlRlCZCBjQ4XsSvN9n'
        
        'app_id' => env('FACEBOOK_APP_ID'),
        'app_secret' => env('FACEBOOK_APP_SECRET'),
        'page_access_token' => env('FACEBOOK_ACCESS_TOKEN'),
        'default_graph_version' => env('FACEBOOK_ACCESS_GRAPH'),
    ],

    // Set Proxy for Servers that can not Access Social Networks due to Sanctions or ...
    'proxy' => [
        'type' => '',   // 7 for Socks5
        'hostname' => '', // localhost
        'port' => '' , // 9050
        'username' => '', // Optional
        'password' => '', // Optional
    ]
];
