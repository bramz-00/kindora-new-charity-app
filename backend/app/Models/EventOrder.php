<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventOrder extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'event_ticket_id',
        'user_id',
        'total_price',
        'quantity',
        'status',
        'payment_method',
        'purchased_at',
    ];
}
