<?php

namespace App\Http\Requests\Operations;

use Illuminate\Foundation\Http\FormRequest;

class UpsertInventoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'hotel_id' => ['required', 'uuid', 'exists:hotels,id'],
            'room_type_id' => ['required', 'uuid', 'exists:room_types,id'],
            'inventory_date' => ['required', 'date'],
            'available' => ['required', 'integer', 'min:0'],
            'sold' => ['nullable', 'integer', 'min:0'],
            'blocked' => ['nullable', 'integer', 'min:0'],
            'stop_sell' => ['nullable', 'boolean'],
        ];
    }
}
