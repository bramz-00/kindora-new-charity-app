<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    /** @use HasFactory<\Database\Factories\EventFactory> */
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'organisation_id',
        'created_by_id',
        'title',
        'description',
        'location',
        'start_date',
        'end_date',
        'target_amount',
        'status',
        'type',
        'is_active',
    ];
}
