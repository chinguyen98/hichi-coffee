<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function current_status()
    {
        return $this->hasOne(Status::class, 'id_order', 'id')->where('is_current', 1);
    }

    public function customer_address()
    {
        return $this->belongsTo(CustomerAddress::class, 'id_customer_address');
    }

    public function statuses()
    {
        return $this->hasMany(Status::class, 'id_order', 'id');
    }

    public function shipping_type()
    {
        return $this->belongsTo(ShippingType::class, 'id_shipping_type');
    }

    public function shipping_address()
    {
        return $this->belongsTo(ShippingAddress::class, 'id_shipping_address');
    }

    public function order_details()
    {
        return $this->hasMany(OrderDetail::class, 'id_order', 'id');
    }
}
