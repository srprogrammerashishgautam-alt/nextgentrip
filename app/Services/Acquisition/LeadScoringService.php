<?php

namespace App\Services\Acquisition;

use App\Models\AcquisitionLead;
use App\Models\LeadScore;

class LeadScoringService
{
    public function score(AcquisitionLead $lead): LeadScore
    {
        $breakdown = [
            'star_rating_score' => $this->starRatingScore($lead),
            'review_score' => min(20, (int) round(((float) $lead->review_rating) * 4)),
            'location_score' => $this->locationScore($lead),
            'revenue_potential_score' => $this->revenuePotentialScore($lead),
            'ota_presence_score' => $this->otaPresenceScore($lead),
            'photo_quality_score' => 3,
            'medical_tourism_score' => $this->poiScore($lead, ['hospital'], 5),
            'wedding_events_score' => $this->poiScore($lead, ['wedding', 'venue', 'garden', 'banquet'], 5),
            'corporate_travel_score' => $this->poiScore($lead, ['business', 'airport'], 5),
            'international_traveler_score' => $this->otaPresenceScore($lead) >= 6 ? 4 : 2,
        ];

        $total = min(100, array_sum($breakdown));

        $score = LeadScore::updateOrCreate(
            ['acquisition_lead_id' => $lead->id],
            array_merge($breakdown, [
                'total_score' => $total,
                'breakdown' => $breakdown,
            ])
        );

        $lead->forceFill([
            'score' => $total,
            'last_scored_at' => now(),
        ])->save();

        return $score;
    }

    private function starRatingScore(AcquisitionLead $lead): int
    {
        return match ((int) $lead->star_rating) {
            5 => 15,
            4 => 12,
            3 => 8,
            2 => 5,
            1 => 2,
            default => 0,
        };
    }

    private function locationScore(AcquisitionLead $lead): int
    {
        $text = strtolower(implode(' ', $lead->nearby_points_of_interest ?? []));

        return min(15, 5
            + (str_contains($text, 'airport') ? 5 : 0)
            + (str_contains($text, 'business') ? 3 : 0)
            + (str_contains($text, 'hospital') ? 2 : 0));
    }

    private function revenuePotentialScore(AcquisitionLead $lead): int
    {
        $potential = (int) $lead->estimated_room_count * (float) $lead->estimated_average_rate;

        return match (true) {
            $potential >= 900000 => 15,
            $potential >= 450000 => 12,
            $potential >= 200000 => 8,
            $potential > 0 => 4,
            default => 0,
        };
    }

    private function otaPresenceScore(AcquisitionLead $lead): int
    {
        $count = count($lead->ota_presence ?? []);

        return match (true) {
            $count >= 3 => 10,
            $count === 2 => 6,
            $count === 1 => 3,
            default => 0,
        };
    }

    private function poiScore(AcquisitionLead $lead, array $needles, int $max): int
    {
        $text = strtolower(implode(' ', $lead->nearby_points_of_interest ?? []));

        foreach ($needles as $needle) {
            if (str_contains($text, $needle)) {
                return $max;
            }
        }

        return 1;
    }
}
