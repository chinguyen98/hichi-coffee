<?php

namespace App;

use Awobaz\Compoships\Database\Eloquent\Model;

class CoffeeComment extends Model
{
    use \Awobaz\Compoships\Compoships;
    protected $table = 'coffee_comments';

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'id_customer', 'id');
    }

    public function coffee()
    {
        return $this->belongsTo(Coffee::class, 'id_coffee', 'id');
    }

    public function images()
    {
        return $this->hasMany(CoffeeCommentImage::class, ['id_coffee', 'id_customer'], ['id_coffee', 'id_customer']);
    }

    public function coffee_comment_replys()
    {
        return $this->hasMany(CoffeeCommentReply::class, ['id_coffee', 'id_customer'], ['id_coffee', 'id_customer'])->orderByDesc('created_at')->limit(3);
    }

    public function isLike($id_coffee, $id_customer)
    {
        return $this->hasMany(CoffeeCommentLike::class,  ['id_coffee', 'id_customer'], ['id_coffee', 'id_customer'])->where('id_customer', $id_customer)->where('id_coffee', $id_coffee)->exists();
    }

    public function coffee_comment_likes_count($id_coffee, $id_customer)
    {
        return $this->hasMany(CoffeeCommentLike::class, ['id_coffee', 'id_customer'], ['id_coffee', 'id_customer'])->where('id_coffee', $id_coffee)->where('id_customer', $id_customer)->count();
    }
}
