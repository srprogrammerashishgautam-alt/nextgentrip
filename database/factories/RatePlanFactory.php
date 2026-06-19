<?php

namespace Database\Factories;

use App\Models\Hotel;
use App\Models\RoomType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\RatePlan>
 */
class RatePlanFactory extends Factory
{
    public function definition(): array
    {
        $hotel = Hotel::factory();

        return [
            'hotel_id' => $hotel,
            'room_type_id' => RoomType::factory()->state(['hotel_id' => $hotel]),
            'name' => fake()->randomElement(['Room Only', 'Breakfast Included', 'Flexible Rate']),
            'code' => fake()->unique()->bothify('RP-###'),
            'meal_plan' => 'EP',
            'currency' => 'INR',
            'base_rate' => fake()->numberBetween(2500, 12000),
            'tax_rate' => 12,
            'is_refundable' => true,
            'cancellation_policy' => 'Free cancellation before 24 hours.',
            'status' => 'active',
        ];
    }
}
