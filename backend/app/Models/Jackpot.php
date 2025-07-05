<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Jackpot extends Model
{
    /** @use HasFactory<\Database\Factories\JackpotFactory> */
    use HasFactory ,SoftDeletes;
    protected $fillable = [
        'organisation_id',
        'created_by_id',
        'title',
        'description',
        'target_amount',
        'collected_amount',
        'start_date',
        'ends_at',
        'status',
        'is_active',
    ];
}
