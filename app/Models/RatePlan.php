<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RatePlan extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'hotel_id',
        'room_type_id',
        'name',
        'code',
        'meal_plan',
        'currency',
        'base_rate',
        'tax_rate',
        'is_refundable',
        'cancellation_policy',
        'status',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'base_rate' => 'decimal:2',
        'tax_rate' => 'decimal:2',
        'is_refundable' => 'boolean',
    ];

    public function hotel(): BelongsTo
    {
        return $this->belongsTo(Hotel::class);
    }

    public function roomType(): BelongsTo
    {
        return $this->belongsTo(RoomType::class);
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }
}
