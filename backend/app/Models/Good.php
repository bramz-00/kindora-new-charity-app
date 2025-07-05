<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Good extends Model
{
    /** @use HasFactory<\Database\Factories\GoodFactory> */
    use HasFactory,SoftDeletes;
    protected $fillable = [
        "title",
        "description",
        "slug",
        "state",
        "exchange_condition",
        "owner_id",
        "category_id",
        "type",
        "good_uuid",
        "is_active",
        "status",
    ];





    protected static function booted()
    {
        static::creating(function ($good) {
            $good->good_uuid = (string) \Str::uuid();
        });
    }
}



