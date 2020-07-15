<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CoffeeCommentReply extends Model
{
    protected $table = "coffee_comment_replys";

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'id_customer', 'id');
    }
}
