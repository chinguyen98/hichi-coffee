<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    public function coffee()
    {
        return $this->belongsTo(Coffee::class, 'id_coffee');
    }

    public function valuation()
    {
        return $this->belongsTo(Valuation::class, 'id_valuation');
    }
}
