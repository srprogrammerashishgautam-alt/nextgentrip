<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Operations\CreateBookingRequest;
use App\Http\Requests\Operations\StoreRatePlanRequest;
use App\Http\Requests\Operations\StoreRoomTypeRequest;
use App\Http\Requests\Operations\UpsertInventoryRequest;
use App\Models\Booking;
use App\Models\Inventory;
use App\Models\RatePlan;
use App\Models\RoomType;
use App\Services\Operations\BookingService;
use App\Support\ApiResponse;
use Illuminate\Http\Request;
use RuntimeException;

class OperationsController extends Controller
{
    public function roomTypes(Request $request)
    {
        return ApiResponse::success(
            RoomType::query()->with('hotel')->when($request->hotel_id, fn ($query) => $query->where('hotel_id', $request->hotel_id))->latest()->paginate(20),
            'Room types retrieved',
        );
    }

    public function storeRoomType(StoreRoomTypeRequest $request)
    {
        return ApiResponse::success(RoomType::create($request->validated()), 'Room type created', status: 201);
    }

    public function ratePlans(Request $request)
    {
        return ApiResponse::success(
            RatePlan::query()->with(['hotel', 'roomType'])->when($request->hotel_id, fn ($query) => $query->where('hotel_id', $request->hotel_id))->latest()->paginate(20),
            'Rate plans retrieved',
        );
    }

    public function storeRatePlan(StoreRatePlanRequest $request)
    {
        return ApiResponse::success(RatePlan::create($request->validated()), 'Rate plan created', status: 201);
    }

    public function upsertInventory(UpsertInventoryRequest $request)
    {
        $data = $request->validated();
        $inventory = Inventory::updateOrCreate([
            'hotel_id' => $data['hotel_id'],
            'room_type_id' => $data['room_type_id'],
            'inventory_date' => $data['inventory_date'],
        ], $data);

        return ApiResponse::success($inventory, 'Inventory updated');
    }

    public function createBooking(CreateBookingRequest $request, BookingService $bookingService)
    {
        try {
            return ApiResponse::success($bookingService->create($request->validated()), 'Booking confirmed', status: 201);
        } catch (RuntimeException $exception) {
            return ApiResponse::error($exception->getMessage(), status: 409);
        }
    }

    public function bookings(Request $request)
    {
        return ApiResponse::success(
            Booking::query()->with(['hotel', 'roomType', 'ratePlan'])->when($request->hotel_id, fn ($query) => $query->where('hotel_id', $request->hotel_id))->latest()->paginate(20),
            'Bookings retrieved',
        );
    }
}
