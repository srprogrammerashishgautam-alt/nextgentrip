<?php

namespace App\Services\AI;

use App\Contracts\AI\AiGatewayInterface;

class MockAiGateway implements AiGatewayInterface
{
    public function request(string $capability, array $payload = []): array
    {
        return [
            'capability' => $capability,
            'payload' => $payload,
            'mocked' => true,
        ];
    }
}
