<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'hotel_id',
        'room_type_id',
        'rate_plan_id',
        'booking_reference',
        'guest_name',
        'guest_email',
        'guest_phone',
        'check_in',
        'check_out',
        'rooms',
        'adults',
        'children',
        'currency',
        'total_amount',
        'status',
        'channel',
        'metadata',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'check_in' => 'date',
        'check_out' => 'date',
        'rooms' => 'integer',
        'adults' => 'integer',
        'children' => 'integer',
        'total_amount' => 'decimal:2',
        'metadata' => 'array',
    ];

    public function hotel(): BelongsTo
    {
        return $this->belongsTo(Hotel::class);
    }

    public function roomType(): BelongsTo
    {
        return $this->belongsTo(RoomType::class);
    }

    public function ratePlan(): BelongsTo
    {
        return $this->belongsTo(RatePlan::class);
    }
}
