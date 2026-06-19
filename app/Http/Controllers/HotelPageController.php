<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Hotel;
use App\Models\Inventory;
use App\Models\RatePlan;
use App\Models\RoomType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Inertia\Response;

class HotelPageController extends Controller
{
    public function index(Request $request): Response
    {
        $search = $request->string('search')->toString();

        return Inertia::render('Hotels/Index', [
            'filters' => ['search' => $search],
            'hotels' => Hotel::query()
                ->when($search, fn ($query) => $query->where('hotel_name', 'like', "%{$search}%")->orWhere('city', 'like', "%{$search}%"))
                ->latest()
                ->paginate(12)
                ->withQueryString(),
            'summary' => [
                'total' => Hotel::count(),
                'active' => Hotel::where('status', 'active')->count(),
                'draft' => Hotel::where('status', 'draft')->count(),
                'inactive' => Hotel::where('status', 'inactive')->count(),
            ],
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Hotels/Create', [
            'statuses' => ['draft', 'pending', 'active', 'inactive'],
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validatedHotel($request);
        $data['hotel_slug'] = $data['hotel_slug'] ?: Str::slug($data['hotel_name']);

        Hotel::create($data);

        return redirect()->route('hotels.index')->with('success', 'Hotel created.');
    }

    public function show(Hotel $hotel): Response
    {
        return Inertia::render('Hotels/Show', [
            'hotel' => $hotel,
            'roomTypes' => RoomType::where('hotel_id', $hotel->id)->latest()->get(),
            'ratePlans' => RatePlan::where('hotel_id', $hotel->id)->latest()->get(),
            'inventory' => Inventory::where('hotel_id', $hotel->id)->orderBy('inventory_date')->limit(14)->get(),
            'bookings' => Booking::where('hotel_id', $hotel->id)->latest()->limit(10)->get(),
        ]);
    }

    public function edit(Hotel $hotel): Response
    {
        return Inertia::render('Hotels/Edit', [
            'hotel' => $hotel,
            'statuses' => ['draft', 'pending', 'active', 'inactive'],
        ]);
    }

    public function update(Request $request, Hotel $hotel): RedirectResponse
    {
        $data = $this->validatedHotel($request, $hotel);
        $data['hotel_slug'] = $data['hotel_slug'] ?: Str::slug($data['hotel_name']);

        $hotel->update($data);

        return redirect()->route('hotels.show', $hotel)->with('success', 'Hotel updated.');
    }

    public function destroy(Hotel $hotel): RedirectResponse
    {
        $hotel->delete();

        return redirect()->route('hotels.index')->with('success', 'Hotel archived.');
    }

    private function validatedHotel(Request $request, ?Hotel $hotel = null): array
    {
        return $request->validate([
            'hotel_name' => ['required', 'string', 'max:255'],
            'hotel_slug' => ['nullable', 'string', 'max:255', Rule::unique('hotels', 'hotel_slug')->ignore($hotel)],
            'email' => ['nullable', 'email', 'max:255'],
            'mobile' => ['nullable', 'string', 'max:30'],
            'address' => ['nullable', 'string'],
            'city' => ['nullable', 'string', 'max:120'],
            'state' => ['nullable', 'string', 'max:120'],
            'country' => ['required', 'string', 'max:120'],
            'latitude' => ['nullable', 'numeric', 'between:-90,90'],
            'longitude' => ['nullable', 'numeric', 'between:-180,180'],
            'gst_number' => ['nullable', 'string', 'max:30'],
            'pan_number' => ['nullable', 'string', 'max:30'],
            'star_rating' => ['nullable', 'integer', 'min:1', 'max:5'],
            'status' => ['required', 'in:draft,pending,active,inactive'],
        ]);
    }
}
