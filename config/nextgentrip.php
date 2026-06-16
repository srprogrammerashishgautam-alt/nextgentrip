<?php

return [
    'api_version' => 'v1',
    'queues' => [
        'default',
        'high',
        'critical',
        'ai-jobs',
        'channel-sync',
        'notifications',
    ],
    'modules' => [
        'hotels',
        'rooms',
        'rates',
        'inventory',
        'channels',
        'bookings',
        'kyc',
        'onboarding',
        'content',
        'contracts',
        'revenue',
        'pms',
        'analytics',
        'notifications',
        'support',
        'audit',
    ],
];
