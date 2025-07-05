<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Jackpot extends Model
{
    /** @use HasFactory<\Database\Factories\JackpotFactory> */
    use HasFactory ,SoftDeletes;
}
