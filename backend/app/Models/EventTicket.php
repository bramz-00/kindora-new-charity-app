<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventTicket extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'event_id',
        'name',
        'price',
        'quantity',
        'sold_count',
    ];

}
