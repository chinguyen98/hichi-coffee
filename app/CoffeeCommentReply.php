<?php

namespace App;

use Awobaz\Compoships\Database\Eloquent\Model;

class CoffeeCommentReply extends Model
{
    protected $table = "coffee_comment_replies";

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'id_customer', 'id');
    }

    public function customer_reply()
    {
        return $this->belongsTo(Customer::class, 'id_customer_reply', 'id');
    }
}
