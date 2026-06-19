<?php

namespace Database\Factories;

use App\Models\Hotel;
use App\Models\RatePlan;
use App\Models\RoomType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    public function definition(): array
    {
        $hotel = Hotel::factory();
        $roomType = RoomType::factory()->state(['hotel_id' => $hotel]);

        return [
            'hotel_id' => $hotel,
            'room_type_id' => $roomType,
            'rate_plan_id' => RatePlan::factory()->state(['hotel_id' => $hotel, 'room_type_id' => $roomType]),
            'booking_reference' => 'NGT-'.Str::upper(Str::random(8)),
            'guest_name' => fake()->name(),
            'guest_email' => fake()->safeEmail(),
            'guest_phone' => fake()->phoneNumber(),
            'check_in' => now()->addDay()->toDateString(),
            'check_out' => now()->addDays(2)->toDateString(),
            'rooms' => 1,
            'adults' => 2,
            'children' => 0,
            'currency' => 'INR',
            'total_amount' => 3500,
            'status' => 'confirmed',
            'channel' => 'direct',
            'metadata' => [],
        ];
    }
}
