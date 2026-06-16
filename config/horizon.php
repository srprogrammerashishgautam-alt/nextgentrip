<?php

return [
    'domain' => env('HORIZON_DOMAIN'),
    'path' => env('HORIZON_PATH', 'horizon'),
    'use' => 'default',
    'prefix' => env('HORIZON_PREFIX', 'nextgentrip_horizon:'),
    'middleware' => ['web'],
    'waits' => [
        'redis:default' => 60,
        'redis:critical' => 10,
        'redis:channel-sync' => 20,
    ],
    'environments' => [
        'production' => [
            'supervisor-critical' => [
                'connection' => 'redis',
                'queue' => ['critical', 'channel-sync'],
                'balance' => 'auto',
                'maxProcesses' => 20,
                'tries' => 3,
            ],
            'supervisor-default' => [
                'connection' => 'redis',
                'queue' => ['default', 'high', 'ai-jobs', 'notifications'],
                'balance' => 'auto',
                'maxProcesses' => 10,
                'tries' => 3,
            ],
        ],
        'local' => [
            'supervisor-local' => [
                'connection' => 'redis',
                'queue' => ['default', 'high', 'critical', 'ai-jobs', 'channel-sync', 'notifications'],
                'balance' => 'simple',
                'maxProcesses' => 3,
                'tries' => 1,
            ],
        ],
    ],
];
