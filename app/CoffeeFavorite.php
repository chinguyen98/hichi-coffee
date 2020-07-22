<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CoffeeFavorite extends Model
{
    protected $table = 'coffee_favorites';

    protected $fillable = [
        'id_coffee', 'id_customer', 'created_at', 'updated_at',
    ];

    protected $hidden = [
        'id',
    ];
}
