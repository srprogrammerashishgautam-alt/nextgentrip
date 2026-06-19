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

    $leadIds = collect($response->json('data.leads'))->pluck('id');

    expect(AcquisitionLead::whereKey($leadIds)->count())->toBe(2)
        ->and(LeadScore::whereIn('acquisition_lead_id', $leadIds)->count())->toBe(2);
});

it('deduplicates repeated discovery results by source reference', function (): void {
    $payload = ['location' => 'Udaipur', 'radius_km' => 10];

    $first = $this->postJson('/api/v1/acquisition/discover', $payload)->assertAccepted();
    $second = $this->postJson('/api/v1/acquisition/discover', $payload)->assertAccepted();

    expect(collect($second->json('data.leads'))->pluck('id')->all())
        ->toBe(collect($first->json('data.leads'))->pluck('id')->all());
});
