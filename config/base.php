<?php

return [

    'authentication' => [
        'email' => true,
        'social' => true
    ],

    /*
     |--------------------------------------------------------------------------
     | Email sending on registration
     |--------------------------------------------------------------------------
     |
     | This value sets the value for the application for sending emails based on
     | their various login methods. You can enable them and disable them
     | separately.
     |
    */
    'emails' => [

        'enabled' => env('BASE_EMAILS_STATUS', true),

        'social_login' => [
            'enabled' => true
        ],

        'email_login' => [
            'enabled' => true
        ]
    ]
];