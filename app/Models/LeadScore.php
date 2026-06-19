<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LeadScore extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'acquisition_lead_id',
        'star_rating_score',
        'review_score',
        'location_score',
        'revenue_potential_score',
        'ota_presence_score',
        'photo_quality_score',
        'medical_tourism_score',
        'wedding_events_score',
        'corporate_travel_score',
        'international_traveler_score',
        'total_score',
        'breakdown',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'star_rating_score' => 'integer',
        'review_score' => 'integer',
        'location_score' => 'integer',
        'revenue_potential_score' => 'integer',
        'ota_presence_score' => 'integer',
        'photo_quality_score' => 'integer',
        'medical_tourism_score' => 'integer',
        'wedding_events_score' => 'integer',
        'corporate_travel_score' => 'integer',
        'international_traveler_score' => 'integer',
        'total_score' => 'integer',
        'breakdown' => 'array',
    ];

    public function lead(): BelongsTo
    {
        return $this->belongsTo(AcquisitionLead::class, 'acquisition_lead_id');
    }
}