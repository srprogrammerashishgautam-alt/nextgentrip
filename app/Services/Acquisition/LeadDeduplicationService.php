<?php

namespace App\Services\Acquisition;

use App\Models\AcquisitionLead;
use Illuminate\Support\Str;

class LeadDeduplicationService
{
    public function findDuplicate(array $payload): ?AcquisitionLead
    {
        $email = $payload['email'] ?? null;
        $phone = $payload['phone'] ?? null;
        $slug = Str::slug(($payload['hotel_name'] ?? '').' '.($payload['city'] ?? ''));

        return AcquisitionLead::query()
            ->where(function ($query) use ($email, $phone, $slug): void {
                $query->where('slug', $slug);
                if ($email) {
                    $query->orWhere('email', $email);
                }
                if ($phone) {
                    $query->orWhere('phone', $phone);
                }
            })
            ->first();
    }
}
