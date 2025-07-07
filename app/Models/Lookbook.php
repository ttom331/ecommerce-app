<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lookbook extends Model
{
    public function items(){
        return $this->hasMany(LookbookItem::class);
    }
}
