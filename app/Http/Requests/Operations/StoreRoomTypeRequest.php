<?php

namespace App\Http\Requests\Operations;

use Illuminate\Foundation\Http\FormRequest;

class StoreRoomTypeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'hotel_id' => ['required', 'uuid', 'exists:hotels,id'],
            'name' => ['required', 'string', 'max:255'],
            'code' => ['required', 'string', 'max:50'],
            'description' => ['nullable', 'string'],
            'base_occupancy' => ['required', 'integer', 'min:1', 'max:20'],
            'max_occupancy' => ['required', 'integer', 'min:1', 'max:20', 'gte:base_occupancy'],
            'total_rooms' => ['required', 'integer', 'min:0'],
            'amenities' => ['nullable', 'array'],
            'amenities.*' => ['string', 'max:100'],
            'status' => ['nullable', 'in:draft,active,inactive'],
        ];
    }
}
