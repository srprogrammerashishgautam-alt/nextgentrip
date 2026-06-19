<?php

use App\Models\AcquisitionLead;
use App\Models\LeadScore;

it('discovers and scores acquisition leads from the configured provider', function (): void {
    $response = $this->postJson('/api/v1/acquisition/discover', [
        'location' => 'Jaipur',
        'radius_km' => 15,
    ]);

    $response
        ->assertAccepted()
        ->assertJsonPath('success', true)
        ->assertJsonPath('data.total_rows', 2)
        ->assertJsonStructure([
            'data' => [
                'job_id',
                'total_rows',
                'leads' => [
                    '*' => ['id', 'hotel_name', 'score', 'status'],
                ],
            ],
        ]);

    expect(AcquisitionLead::count())->toBe(2)
        ->and(LeadScore::count())->toBe(2);
});

it('deduplicates repeated discovery results by source reference', function (): void {
    $payload = ['location' => 'Goa', 'radius_km' => 10];

    $this->postJson('/api/v1/acquisition/discover', $payload)->assertAccepted();
    $this->postJson('/api/v1/acquisition/discover', $payload)->assertAccepted();

    expect(AcquisitionLead::count())->toBe(2);
});
