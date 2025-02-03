<?php

return [
    'drivers' => [
        'gerp' => [
            'class' => \App\Services\Erp\GerpService::class,
            'config' => [
                'api_key' => env('GERP_API_KEY'),
                'api_secret' => env('GERP_API_SECRET'),
                'api_url' => env('GERP_API_URL'),
            ]
        ],
        'default' => [
            'class' => \App\Services\Erp\DefaultService::class,
            'config' => []
        ],
    ]
];
