<?php

namespace App\Services\Auth;

use App\Contracts\Auth\MagicLinkServiceInterface;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class MockMagicLinkService implements MagicLinkServiceInterface
{
    public function issue(User $user): string
    {
        $token = Str::random(48);

        Cache::put("magic-link:{$token}", $user->getKey(), now()->addMinutes(15));

        return $token;
    }

    public function validate(string $token): ?User
    {
        $userId = Cache::pull("magic-link:{$token}");

        return $userId ? User::find($userId) : null;
    }
}
