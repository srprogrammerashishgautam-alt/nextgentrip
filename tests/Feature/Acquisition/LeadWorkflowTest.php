<?php

use App\Models\AcquisitionLead;
use App\Models\LeadActivity;

it('refreshes a lead score on demand', function (): void {
    $lead = AcquisitionLead::factory()->create(['score' => 0, 'last_scored_at' => null]);

    $response = $this->postJson("/api/v1/acquisition/leads/{$lead->id}/score");

    $response
        ->assertOk()
        ->assertJsonPath('success', true)
        ->assertJsonStructure([
            'data' => ['total_score', 'breakdown'],
        ]);

    expect($lead->fresh()->score)->toBeGreaterThan(0);
});

it('sends invitations through selected channels and records activity', function (): void {
    $lead = AcquisitionLead::factory()->create(['status' => 'new']);

    $response = $this->postJson("/api/v1/acquisition/leads/{$lead->id}/invite", [
        'channels' => ['email', 'whatsapp'],
    ]);

    $response
        ->assertOk()
        ->assertJsonPath('success', true)
        ->assertJsonPath('data.invitations_sent', 2);

    expect($lead->fresh()->status)->toBe('invited')
        ->and(LeadActivity::where('acquisition_lead_id', $lead->id)->where('type', 'invitation')->count())->toBe(2);
});
