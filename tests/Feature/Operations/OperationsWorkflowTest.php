<?php

use App\Models\Hotel;
use App\Models\Inventory;
use App\Models\RatePlan;
use App\Models\RoomType;
use App\Models\User;

it('creates room type rate inventory and booking through APIs', function (): void {
    $hotel = Hotel::factory()->create();

    $roomResponse = $this->postJson('/api/v1/operations/room-types', [
        'hotel_id' => $hotel->id,
        'name' => 'Deluxe Room',
        'code' => 'DLX',
        'base_occupancy' => 2,
        'max_occupancy' => 3,
        'total_rooms' => 10,
        'amenities' => ['wifi'],
        'status' => 'active',
    ])->assertCreated();

    $roomTypeId = $roomResponse->json('data.id');

    $rateResponse = $this->postJson('/api/v1/operations/rate-plans', [
        'hotel_id' => $hotel->id,
        'room_type_id' => $roomTypeId,
        'name' => 'Room Only',
        'code' => 'RO',
        'meal_plan' => 'EP',
        'currency' => 'INR',
        'base_rate' => 3000,
        'tax_rate' => 12,
        'is_refundable' => true,
        'status' => 'active',
    ])->assertCreated();

    $ratePlanId = $rateResponse->json('data.id');

    foreach ([now(), now()->addDay()] as $date) {
        $this->postJson('/api/v1/operations/inventory', [
            'hotel_id' => $hotel->id,
            'room_type_id' => $roomTypeId,
            'inventory_date' => $date->toDateString(),
            'available' => 5,
            'sold' => 0,
            'blocked' => 0,
        ])->assertOk();
    }

    $this->postJson('/api/v1/operations/bookings', [
        'hotel_id' => $hotel->id,
        'room_type_id' => $roomTypeId,
        'rate_plan_id' => $ratePlanId,
        'guest_name' => 'Test Guest',
        'guest_email' => 'guest@example.test',
        'check_in' => now()->toDateString(),
        'check_out' => now()->addDays(2)->toDateString(),
        'rooms' => 2,
        'adults' => 2,
    ])->assertCreated()->assertJsonPath('data.status', 'confirmed');

    expect(RoomType::whereKey($roomTypeId)->exists())->toBeTrue()
        ->and(RatePlan::whereKey($ratePlanId)->exists())->toBeTrue()
        ->and(Inventory::where('room_type_id', $roomTypeId)->sum('available'))->toBe(6)
        ->and(Inventory::where('room_type_id', $roomTypeId)->sum('sold'))->toBe(4);
});

it('renders hotel management screens for authenticated users', function (): void {
    $user = User::factory()->create();
    $hotel = Hotel::factory()->create();

    $this->actingAs($user)->get('/hotels')->assertOk();
    $this->actingAs($user)->get('/hotels/create')->assertOk();
    $this->actingAs($user)->get("/hotels/{$hotel->id}")->assertOk();
    $this->actingAs($user)->get("/hotels/{$hotel->id}/edit")->assertOk();
});
