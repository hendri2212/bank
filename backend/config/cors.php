<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your settings for cross-origin resource sharing
    | or "CORS". This determines what cross-origin operations may execute
    | in web browsers. You are free to adjust these settings as needed.
    |
    | To learn more: https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS
    |
    */

    'paths' => ['api/*', 'sanctum/csrf-cookie'],
    // 'paths' => ['api/*', 'sanctum/csrf-cookie', 'https://smkn1kotabaru.sch.id/*', 'https://smkn1kotabaru.sch.id'],
    // 'paths' => ['*'],

    'allowed_methods' => ['*'],
    // 'allowed_methods' => ['GET', '*'],

    'allowed_origins' => ['*'],
    // 'allowed_origins' => ['*', 'http://127.0.0.1:8000'],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],
    // 'allowed_headers' => ['Access-Control-Allow-Origin', '*'],

    'exposed_headers' => [],

    'max_age' => 0,

    // 'supports_credentials' => true,
    'supports_credentials' => false,

];
