<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $hidden = ['id', 'created_at', 'updated_at'];

    public function coffees()
    {
        return $this->hasMany(Coffee::class, 'id_brand', 'id');
    }
}
