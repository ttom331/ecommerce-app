<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LookbookItem extends Model
{
    public function lookbook(){
        return $this->belongsTo(Lookbook::class);
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
