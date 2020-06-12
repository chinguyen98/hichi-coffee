<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    public function coffees()
    {
        return $this->hasMany(Coffee::class, 'id_brand', 'id');
    }
}
