<?php

namespace App\Http\Requests\Acquisition;

use Illuminate\Foundation\Http\FormRequest;

class DiscoverHotelsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'location' => ['required', 'string', 'max:160'],
            'radius_km' => ['nullable', 'numeric', 'min:1', 'max:100'],
            'category' => ['nullable', 'string', 'max:80'],
            'min_rating' => ['nullable', 'numeric', 'min:0', 'max:5'],
        ];
    }
}
