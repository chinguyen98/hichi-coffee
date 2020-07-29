<?php

namespace App;

use Awobaz\Compoships\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use \Awobaz\Compoships\Compoships;

    public function coffee()
    {
        return $this->belongsTo(Coffee::class, 'id_coffee');
    }

    public function valuation_detail($id_order, $id_coffee)
    {
        return $this->hasMany(ValuationOrderDetail::class, ['id_order', 'id_coffee'], ['id_order', 'id_coffee'])->where('id_order', $id_order)->where('id_coffee', $id_coffee)->first();
    }
}
