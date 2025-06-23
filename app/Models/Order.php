<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;

    protected $fillable = [
        'order_email',
        'total_amount',
    ];

    public function user(){
        $this->belongsTo(User::class);
    }

    public function address(){
        $this->belongsTo(OrderAddress::class);
    }

    public function items(){
        $this->hasMany(OrderItem::class);
    }
}
