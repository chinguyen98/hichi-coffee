<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CoffeeComment extends Model
{
    protected $table = 'coffee_comments';

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'id_customer', 'id');
    }

    public function images(){
        return $this->hasMany(CoffeeCommentImage::class, 'id_comment', 'id');
    }
}
