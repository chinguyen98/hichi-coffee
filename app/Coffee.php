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

    public function coffee_comments()
    {
        return $this->hasMany(CoffeeComment::class, 'id_coffee', 'id');
    }

    public function avgRating()
    {
        return $this->coffee_comments->avg('rating');
    }

    public function countRating()
    {
        return $this->coffee_comments->count();
    }
}
