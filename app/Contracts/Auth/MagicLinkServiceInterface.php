<?php

namespace App\Contracts\Auth;

use App\Models\User;

interface MagicLinkServiceInterface
{
    public function issue(User $user): string;

    public function validate(string $token): ?User;
}
