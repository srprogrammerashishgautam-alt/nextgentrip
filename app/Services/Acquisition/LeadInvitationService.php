<?php

namespace App\Services\Acquisition;

use App\Models\AcquisitionLead;

class LeadInvitationService
{
    public function invite(AcquisitionLead $lead, array $channels): array
    {
        $lead->forceFill([
            'status' => 'invited',
            'invited_at' => now(),
        ])->save();

        foreach ($channels as $channel) {
            $lead->activities()->create([
                'type' => 'invitation',
                'channel' => $channel,
                'status' => 'completed',
                'notes' => "Mock {$channel} invitation sent.",
                'completed_at' => now(),
                'payload' => ['onboarding_link' => url("/register?lead={$lead->id}")],
            ]);
        }

        return [
            'invitations_sent' => count($channels),
            'onboarding_link' => url("/register?lead={$lead->id}"),
        ];
    }
}
