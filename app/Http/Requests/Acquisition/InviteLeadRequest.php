<?php

namespace App\Http\Requests\Acquisition;

use Illuminate\Foundation\Http\FormRequest;

class InviteLeadRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'channels' => ['required', 'array', 'min:1'],
            'channels.*' => ['required', 'string', 'in:email,whatsapp,sms'],
        ];
    }
}
