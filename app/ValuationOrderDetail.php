<?php

namespace App;

use Awobaz\Compoships\Database\Eloquent\Model;

class ValuationOrderDetail extends Model
{
    public function coffee()
    {
        return $this->belongsTo(Coffee::class, 'id_coffee');
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'id_order');
    }

    public function valuation()
    {
        return $this->belongsTo(Valuation::class, 'id_valuation');
    }
}
