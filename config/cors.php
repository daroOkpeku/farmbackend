<?php

// return [

//     /*
//     |--------------------------------------------------------------------------
//     | Cross-Origin Resource Sharing (CORS) Configuration
//     |--------------------------------------------------------------------------
//     |
//     | Here you may configure your settings for cross-origin resource sharing
//     | or "CORS". This determines what cross-origin operations may execute
//     | in web browsers. You are free to adjust these settings as needed.
//     |
//     | To learn more: https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS
//     |
//     */

//     'paths' => ['api/*', 'sanctum/csrf-cookie'],

//     'allowed_methods' => ['*'],

//     'allowed_origins' => ['*'],

//     'allowed_origins_patterns' => [],

//     'allowed_headers' => ['*'],

//     'exposed_headers' => [],

//     'max_age' => 0,

//     'supports_credentials' => false,

// ];


return [
    'paths' => ['api/*', 'sanctum/csrf-cookie'],
    'allowed_methods' => ['*'],
    'allowed_origins' => ['*'],
    //this is working 'allowed_origins' => ['https://ranchidpro.com', 'https://farms-frontend-djj6gwjcx-okpeku-stephens-projects.vercel.app',  'https://www.ranchidpro.com', 'http://localhost:3000', 'http://127.0.0.1:8000', ], // or specify the necessary origins 'http://localhost:3000', 'http://127.0.0.1:8000'
    'allowed_origins_patterns' => [],
    'allowed_headers' => ['*'],
    'exposed_headers' => [],
    'max_age' => 0,
    'supports_credentials' => true,





];
