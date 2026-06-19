<?php

namespace App\Services\Operations;

use App\Models\Booking;
use App\Models\Inventory;
use App\Models\RatePlan;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use RuntimeException;

class BookingService
{
    public function create(array $data): Booking
    {
        return DB::transaction(function () use ($data): Booking {
            $nights = CarbonPeriod::create($data['check_in'], $data['check_out'])->excludeEndDate();

            foreach ($nights as $night) {
                $inventory = Inventory::query()
                    ->where('hotel_id', $data['hotel_id'])
                    ->where('room_type_id', $data['room_type_id'])
                    ->whereDate('inventory_date', $night->toDateString())
                    ->lockForUpdate()
                    ->first();

                if (! $inventory || $inventory->stop_sell || $inventory->available < $data['rooms']) {
                    throw new RuntimeException('Requested inventory is not available.');
                }

                $inventory->decrement('available', $data['rooms']);
                $inventory->increment('sold', $data['rooms']);
            }

            $ratePlan = RatePlan::findOrFail($data['rate_plan_id']);
            $nightCount = max(1, CarbonPeriod::create($data['check_in'], $data['check_out'])->excludeEndDate()->count());
            $subtotal = (float) $ratePlan->base_rate * (int) $data['rooms'] * $nightCount;
            $tax = $subtotal * ((float) $ratePlan->tax_rate / 100);

            return Booking::create([
                ...$data,
                'booking_reference' => 'NGT-'.now()->format('ymd').'-'.Str::upper(Str::random(6)),
                'currency' => $ratePlan->currency,
                'total_amount' => round($subtotal + $tax, 2),
                'status' => 'confirmed',
                'channel' => $data['channel'] ?? 'direct',
            ]);
        });
    }
}
