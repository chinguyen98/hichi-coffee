<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coffee extends Model
{
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'id_brand');
    }

    public function coffee_type()
    {
        return $this->belongsTo(CoffeeType::class, 'id_coffee_type');
    }
}
