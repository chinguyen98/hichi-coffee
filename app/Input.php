<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Input extends Model
{
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'id_supplier');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'id_admin');
    }

    public function input_details()
    {
        return $this->hasMany(InputDetail::class, 'id_input', 'id');
    }
}
