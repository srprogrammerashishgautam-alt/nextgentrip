<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<\App\Models\AcquisitionLead>
 */
class AcquisitionLeadFactory extends Factory
{
    public function definition(): array
    {
        $name = fake()->company();

        return [
            'source' => 'manual',
            'hotel_id' => fake()->unique()->uuid(),
            'hotel_name' => $name,
            'slug' => Str::slug($name),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->phoneNumber(),
            'website' => fake()->url(),
            'address' => fake()->streetAddress(),
            'city' => fake()->city(),
            'state' => fake()->state(),
            'country' => fake()->country(),
            'latitude' => fake()->latitude(),
            'longitude' => fake()->longitude(),
            'star_rating' => fake()->numberBetween(2, 5),
            'review_rating' => fake()->randomFloat(1, 3, 5),
            'review_count' => fake()->numberBetween(10, 1200),
            'estimated_room_count' => fake()->numberBetween(12, 180),
            'estimated_average_rate' => fake()->numberBetween(1800, 12000),
            'ota_presence' => fake()->randomElements(['booking.com', 'expedia', 'agoda'], 2),
            'nearby_points_of_interest' => fake()->randomElements(['airport', 'business district', 'hospital', 'wedding venue'], 2),
            'score' => fake()->numberBetween(20, 90),
            'status' => 'new',
            'last_scored_at' => now(),
            'raw_payload' => [],
        ];
    }
}
