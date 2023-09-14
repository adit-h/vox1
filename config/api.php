<?php

return [
    // Main API
    'url' => env('API_URL'),

    // API end-point
    'url_login' => env('API_URL') . '/api/v1/users/login',
    'url_event' => env('API_URL') . '/api/v1/sport-events',
    'url_org' => env('API_URL') . '/api/v1/organizers',
    'url_user' => env('API_URL') . '/api/v1/users',

    // Login creds
    'user_email' => env('USER_EMAIL'),
    'user_pass' => env('USER_PASS'),
];
