<?php

namespace App\Contracts\Auth;

interface OtpServiceInterface
{
    public function send(string $destination): string;

    public function verify(string $reference, string $code): bool;
}
