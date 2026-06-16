<?php

return [
    'brokers' => env('KAFKA_BROKERS', '127.0.0.1:9092'),
    'consumer_group' => env('KAFKA_CONSUMER_GROUP', 'nextgentrip-platform'),
    'topics' => [
        'hotel.created' => ['partitions' => 12, 'retention_days' => 7],
        'hotel.kyc.submitted' => ['partitions' => 12, 'retention_days' => 7],
        'hotel.activated' => ['partitions' => 6, 'retention_days' => 7],
        'rate.updated' => ['partitions' => 24, 'retention_days' => 7],
        'inventory.updated' => ['partitions' => 24, 'retention_days' => 7],
        'booking.received' => ['partitions' => 24, 'retention_days' => 7],
        'booking.cancelled' => ['partitions' => 24, 'retention_days' => 7],
        'ai.content.requested' => ['partitions' => 12, 'retention_days' => 7],
        'ai.images.requested' => ['partitions' => 12, 'retention_days' => 7],
        'ai.pricing.requested' => ['partitions' => 6, 'retention_days' => 7],
        'notification.send' => ['partitions' => 12, 'retention_days' => 7],
        'analytics.update' => ['partitions' => 6, 'retention_days' => 7],
    ],
];
