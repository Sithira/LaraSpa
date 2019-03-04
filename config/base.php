<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Application level authentication
    |--------------------------------------------------------------------------
    |
    | This value is the name of your application. This value is used when the
    | framework needs to place the application's name in a notification or
    | any other location as required by the application or its packages.
    |
    */

    'version' => "0.0.1",

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

        'social_login' => [
            'enabled' => true,
            'email_type' => 'thank'
        ],

        'email_login' => [
            'enabled' => true,
            'email_type' => 'confirmation'
        ]
    ]
];