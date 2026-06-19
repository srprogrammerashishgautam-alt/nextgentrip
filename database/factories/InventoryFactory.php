<?php

namespace Database\Factories;

use App\Models\Hotel;
use App\Models\RoomType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Inventory>
 */
class InventoryFactory extends Factory
{
    public function definition(): array
    {
        $hotel = Hotel::factory();

        return [
            'hotel_id' => $hotel,
            'room_type_id' => RoomType::factory()->state(['hotel_id' => $hotel]),
            'inventory_date' => now()->toDateString(),
            'available' => 10,
            'sold' => 0,
            'blocked' => 0,
            'stop_sell' => false,
        ];
    }
}
