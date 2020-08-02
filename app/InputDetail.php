<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InputDetail extends Model
{
    public function coffee()
    {
        return $this->belongsTo(Coffee::class, 'id_coffee', 'id');
    }
}
