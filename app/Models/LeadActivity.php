<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LeadActivity extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'acquisition_lead_id',
        'type',
        'channel',
        'status',
        'notes',
        'payload',
        'scheduled_at',
        'completed_at',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'payload' => 'array',
        'scheduled_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    public function lead(): BelongsTo
    {
        return $this->belongsTo(AcquisitionLead::class, 'acquisition_lead_id');
    }
}