<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class GoodProposal extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'good_id',
        'req_uuid',
        'user_id',
        'exchange_good_id',
        'status',
        'reject_reason',
        'validated_at',
    ];



    protected static function booted()
    {
        static::creating(function ($good_proposal) {
            $good_proposal->req_uuid = (string) Str::uuid();
        });
    }
}
