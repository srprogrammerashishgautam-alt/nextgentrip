<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hotel extends Model
{
    use HasUuids, SoftDeletes;

    protected $fillable = [
        'hotel_name',
        'hotel_slug',
        'email',
        'mobile',
        'address',
        'city',
        'state',
        'country',
        'latitude',
        'longitude',
        'gst_number',
        'pan_number',
        'star_rating',
        'status'
    ];
}