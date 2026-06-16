<?php

namespace App\Contracts\Events;

interface EventBusInterface
{
    public function publish(string $topic, array $payload, ?string $key = null): void;
}
