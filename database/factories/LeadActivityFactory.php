<?php

namespace Database\Factories;

use App\Models\AcquisitionLead;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\LeadActivity>
 */
class LeadActivityFactory extends Factory
{
    public function definition(): array
    {
        return [
            'acquisition_lead_id' => AcquisitionLead::factory(),
            'type' => fake()->randomElement(['discovered', 'score_refreshed', 'invitation', 'note']),
            'channel' => fake()->randomElement(['system', 'email', 'whatsapp']),
            'status' => 'completed',
            'notes' => fake()->sentence(),
            'payload' => [],
            'completed_at' => now(),
        ];
    }
}
