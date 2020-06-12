<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CoffeeType extends Model
{
    public function coffees()
    {
        return $this->hasMany(Coffee::class, 'id_coffee_type', 'id');
    }
}
