<?php

namespace Database\Factories;

use App\Models\AcquisitionLead;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\LeadScore>
 */
class LeadScoreFactory extends Factory
{
    public function definition(): array
    {
        $breakdown = [
            'star_rating_score' => fake()->numberBetween(1, 15),
            'review_score' => fake()->numberBetween(1, 20),
            'location_score' => fake()->numberBetween(1, 15),
            'revenue_potential_score' => fake()->numberBetween(1, 15),
            'ota_presence_score' => fake()->numberBetween(1, 10),
            'photo_quality_score' => fake()->numberBetween(1, 5),
            'medical_tourism_score' => fake()->numberBetween(1, 5),
            'wedding_events_score' => fake()->numberBetween(1, 5),
            'corporate_travel_score' => fake()->numberBetween(1, 5),
            'international_traveler_score' => fake()->numberBetween(1, 5),
        ];

        return [
            'acquisition_lead_id' => AcquisitionLead::factory(),
            ...$breakdown,
            'total_score' => min(100, array_sum($breakdown)),
            'breakdown' => $breakdown,
        ];
    }
}
