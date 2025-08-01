<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VolunteerApplication extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'volunteer_opportunity_id',
        'user_id',
    ];
}
