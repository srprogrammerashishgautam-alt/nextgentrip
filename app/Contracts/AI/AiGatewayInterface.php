<?php

namespace App\Contracts\AI;

interface AiGatewayInterface
{
    public function request(string $capability, array $payload = []): array;
}
