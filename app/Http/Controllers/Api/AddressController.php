<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AddressController extends Controller
{
    public function deleteAddress($id)
    {
        DB::table('customer_addresses')->delete($id);
    }
}
