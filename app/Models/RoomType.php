<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RoomType extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'hotel_id',
        'name',
        'code',
        'description',
        'base_occupancy',
        'max_occupancy',
        'total_rooms',
        'amenities',
        'status',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'base_occupancy' => 'integer',
        'max_occupancy' => 'integer',
        'total_rooms' => 'integer',
        'amenities' => 'array',
    ];

    public function hotel(): BelongsTo
    {
        return $this->belongsTo(Hotel::class);
    }

    public function ratePlans(): HasMany
    {
        return $this->hasMany(RatePlan::class);
    }

    public function inventory(): HasMany
    {
        return $this->hasMany(Inventory::class);
    }
}
