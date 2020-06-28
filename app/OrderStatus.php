<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    public function status()
    {
        return $this->belongsTo(Status::class, 'id_status');
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'id_order');
    }
}
