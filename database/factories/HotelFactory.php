<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<\App\Models\Hotel>
 */
class HotelFactory extends Factory
{
    public function definition(): array
    {
        $name = fake()->company().' Hotel';

        return [
            'hotel_name' => $name,
            'hotel_slug' => Str::slug($name).'-'.fake()->unique()->numberBetween(1000, 9999),
            'email' => fake()->safeEmail(),
            'mobile' => fake()->phoneNumber(),
            'address' => fake()->streetAddress(),
            'city' => fake()->city(),
            'state' => fake()->state(),
            'country' => 'India',
            'latitude' => fake()->latitude(),
            'longitude' => fake()->longitude(),
            'gst_number' => fake()->bothify('##?????####?#?#'),
            'pan_number' => fake()->bothify('?????####?'),
            'star_rating' => fake()->numberBetween(2, 5),
            'status' => 'active',
        ];
    }
}
