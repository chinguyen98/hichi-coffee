<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Coffee extends Model
{
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'id_brand');
    }

    public function coffee_type()
    {
        return $this->belongsTo(CoffeeType::class, 'id_coffee_type');
    }

    public function valuations()
    {
        return $this->hasMany(Valuation::class, 'id_coffee', 'id')->where('expired', '>=', Carbon::now()->toDateString())->orderByDesc('quantity');
    }
}
