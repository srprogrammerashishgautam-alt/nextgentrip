<?php

namespace App\Services\Events;

use App\Contracts\Events\EventBusInterface;
use Illuminate\Support\Facades\Log;

class MockKafkaEventBus implements EventBusInterface
{
    public function publish(string $topic, array $payload, ?string $key = null): void
    {
        Log::info('Mock Kafka event published', [
            'topic' => $topic,
            'key' => $key,
            'payload' => $payload,
        ]);
    }
}
