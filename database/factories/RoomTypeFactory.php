<?php

namespace Database\Factories;

use App\Models\Hotel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\RoomType>
 */
class RoomTypeFactory extends Factory
{
    public function definition(): array
    {
        return [
            'hotel_id' => Hotel::factory(),
            'name' => fake()->randomElement(['Deluxe Room', 'Executive Suite', 'Premium Room']),
            'code' => fake()->unique()->bothify('RT-###'),
            'description' => fake()->sentence(),
            'base_occupancy' => 2,
            'max_occupancy' => 3,
            'total_rooms' => fake()->numberBetween(5, 60),
            'amenities' => ['wifi', 'breakfast'],
            'status' => 'active',
        ];
    }
}
