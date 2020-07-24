<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CoffeeFavorite extends Model
{
    protected $table = 'coffee_favorites';

    protected $hidden = ['id', 'created_at', 'updated_at'];

    protected $fillable = [
        'id_coffee', 'id_customer', 'created_at', 'updated_at',
    ];

    public function coffee()
    {
        return $this->belongsTo(Coffee::class, 'id_coffee', 'id');
    }
}
