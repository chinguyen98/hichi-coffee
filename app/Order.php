<?php

namespace App;

use Awobaz\Compoships\Database\Eloquent\Model;

class Order extends Model
{
    use \Awobaz\Compoships\Compoships;

    public function current_status()
    {
        return $this->hasOne(OrderStatus::class, 'id_order', 'id')->where('is_current', 1);
    }

    public function statuses()
    {
        return $this->hasMany(OrderStatus::class, 'id_order', 'id');
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

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'id_admin');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'id_customer');
    }
}
