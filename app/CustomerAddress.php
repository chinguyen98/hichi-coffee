<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerAddress extends Model
{
    protected $fillable = [
        'id_city', 'id_district', 'id_ward', 'address', 'id_customer', 'is_current', 'id_customer', 'city', 'district', 'ward', 'full_address'
    ];
}
