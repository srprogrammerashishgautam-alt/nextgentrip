<?php

namespace App\Services\Auth;

use App\Contracts\Auth\OtpServiceInterface;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class MockOtpService implements OtpServiceInterface
{
    public function send(string $destination): string
    {
        $reference = (string) Str::uuid();

        Cache::put("otp:{$reference}", [
            'destination' => $destination,
            'code' => '123456',
        ], now()->addMinutes(10));

        return $reference;
    }

    public function verify(string $reference, string $code): bool
    {
        $payload = Cache::get("otp:{$reference}");

        return is_array($payload) && hash_equals($payload['code'], $code);
    }
}
