<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{

    protected $fillable = ['product_id', 'order_id', 'product_name', 'quantity', 'price'];

    public function order()
    {
        $this->belongsTo(Order::class);
    }
}
