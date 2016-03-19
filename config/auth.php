<?php

return [
    'defaults' => [
        'guard' => env('AUTH_GUARD', 'user'),
    ],
    'guards' => [
        'user' => [
            'driver' => 'oauth',
            'provider' => 'user',

        ],
        'client' => [
            'driver' => 'oauth',
            'provider' => 'client',
            'adapter' => [
                'expOffset' => 3600*24
            ]
        ],
    ],
    'providers' => [
        'user' => [
            'driver' => 'eloquent',
            'model' => CHMS\Provider\Models\User::class
        ],
        'client' => [
            'driver' => 'hubAuthProvider',
            'model' => CHMS\Provider\Models\Client::class
        ]
    ]
];
