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

    'allowed_methods' => ['*'],

    'allowed_origins' => ['*', 'http://localhost:3000', 'https://localhost:3000','http://192.168.100.61:8083','https://192.168.100.61:8083','http://192.168.100.61:8084','https://192.168.100.61:8084','http://store.scldev.com:8083','http://store-admin.scldev.com:8084','http://store.scldev.com:8084', 'https://store.scldev.com:8083','https://store.scldev.com:8084', 'https://store-admin.scldev.com:8084'],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    // 'supports_credentials' => false,
    'supports_credentials' => true,
    'allowed_headers' => [
    'Content-Type',
    'X-Requested-With',
    'Authorization',
    'X-CSRF-Token',
],

];
