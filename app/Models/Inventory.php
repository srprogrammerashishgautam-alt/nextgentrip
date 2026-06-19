<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Inventory extends BaseModel
{
    use HasFactory;

    protected $table = 'inventory';

    protected $fillable = [
        'hotel_id',
        'room_type_id',
        'inventory_date',
        'available',
        'sold',
        'blocked',
        'stop_sell',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'inventory_date' => 'date',
        'available' => 'integer',
        'sold' => 'integer',
        'blocked' => 'integer',
        'stop_sell' => 'boolean',
    ];

    public function hotel(): BelongsTo
    {
        return $this->belongsTo(Hotel::class);
    }

    public function roomType(): BelongsTo
    {
        return $this->belongsTo(RoomType::class);
    }
}
