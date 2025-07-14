<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GoodProposal extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'good_id',
        'user_id',
        'exchange_good_id',
        'status',
        'reject_reason',
    ];
}
