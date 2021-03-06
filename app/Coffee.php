<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Coffee extends Model
{
    protected $appends = ['avgRating', 'brand', 'coffee_comment_count'];

    protected $hidden = ['info', 'expected_quantity', 'status', 'created_at', 'updated_at'];

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
        return $this->hasMany(CoffeeComment::class, 'id_coffee', 'id')->orderByDesc('updated_at');
    }

    public function coffee_favorites()
    {
        return $this->hasMany(CoffeeFavorite::class, 'id_coffee', 'id');
    }

    public function avgRating()
    {
        return number_format($this->coffee_comments()->where('status', 1)->avg('rating'), 1);
    }

    public function countRating()
    {
        return $this->coffee_comments()->where('status', 1)->count();
    }

    public function starPercent($star)
    {
        $total_count = $this->countRating();
        if ($total_count == 0)
            return;
        $count = $this->coffee_comments()->where('status', 1)->where('rating', $star)->count();
        $percent = ($count * 100) / $total_count;
        return number_format($percent);
    }

    public function haveComment($id_customer)
    {
        return $this->coffee_comments()->where('id_customer', $id_customer)->exists();
    }

    public function haveFavorite($id_customer)
    {
        return $this->coffee_favorites()->where('id_customer', $id_customer)->exists();
    }

    /* Serialization */
    public function getAvgRatingAttribute()
    {
        return $this->avgRating();
    }

    public function getBrandAttribute()
    {
        return $this->brand()->first();
    }

    public function getCoffeeCommentCountAttribute()
    {
        return $this->coffee_comments()->count();
    }
}
