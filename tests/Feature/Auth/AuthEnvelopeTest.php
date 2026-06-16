<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('returns the standard envelope for otp send', function (): void {
    $this->postJson('/api/v1/auth/otp/send', [
        'email' => 'owner@example.com',
    ])
        ->assertOk()
        ->assertJsonStructure([
            'success',
            'data' => ['otp_ref', 'expires_in'],
            'message',
            'meta',
        ]);
});
