<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VolunteerOpportunity extends Model
{
    /** @use HasFactory<\Database\Factories\VolunteerOpportunityFactory> */
    use HasFactory, SoftDeletes;


    protected $fillable = [
        'organisation_id',
        'created_by_id',
        'title',
        'description',
        'location',
        'start_date',
        'end_date',
        'status',
        'is_active',
    ];
    public function reviews()
    {
        return $this->morphMany(Review::class, 'reviewable');
    }
}
