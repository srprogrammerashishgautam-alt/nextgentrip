<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class AcquisitionLead extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'hotel_id',
        'hotel_name',
        'slug',
        'status',
        'source',
        'website',
        'email',
        'phone',
        'address',
        'city',
        'state',
        'country',
        'latitude',
        'longitude',
        'star_rating',
        'review_rating',
        'review_count',
        'estimated_room_count',
        'estimated_average_rate',
        'ota_presence',
        'nearby_points_of_interest',
        'raw_payload',
        'score',
        'last_scored_at',
        'invited_at',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'latitude' => 'decimal:7',
        'longitude' => 'decimal:7',
        'review_rating' => 'decimal:2',
        'estimated_average_rate' => 'decimal:2',
        'ota_presence' => 'array',
        'nearby_points_of_interest' => 'array',
        'raw_payload' => 'array',
        'last_scored_at' => 'datetime',
        'invited_at' => 'datetime',
        'score' => 'integer',
        'review_count' => 'integer',
        'estimated_room_count' => 'integer',
        'star_rating' => 'integer',
    ];

    public function scoreRecord(): HasOne
    {
        return $this->hasOne(LeadScore::class);
    }

    public function activities(): HasMany
    {
        return $this->hasMany(LeadActivity::class);
    }

    public function scopeStatus($query, ?string $status)
    {
        return $status ? $query->where('status', $status) : $query;
    }

    public function scopeScoreMin($query, ?int $score)
    {
        return $score !== null ? $query->where('score', '>=', $score) : $query;
    }

    public function scopeScoreMax($query, ?int $score)
    {
        return $score !== null ? $query->where('score', '<=', $score) : $query;
    }
}