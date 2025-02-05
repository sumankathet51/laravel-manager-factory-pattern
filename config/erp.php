<?php

return [
    'drivers' => [
        'gerp' => [
            'class' => \App\Services\Erp\Gerp\GerpService::class,
            'adapters' => [
                'invoice' => \App\Services\Erp\Gerp\Adapters\GerpInvoiceAdapter::class
            ],
            'config' => [
                'api_key' => env('GERP_API_KEY'),
                'api_secret' => env('GERP_API_SECRET'),
                'api_url' => env('GERP_API_URL'),
            ]
        ],
        'default' => [
            'class' => \App\Services\Erp\Default\DefaultService::class,
            'adapters' => [
                'invoice' => \App\Services\Erp\Default\Adapters\ErpInvoiceAdapter::class
            ],
            'config' => []
        ],
    ]
];
