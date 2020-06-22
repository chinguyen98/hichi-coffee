<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AddressController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        $id_district = $request->input('id_district');
        $id_ward = $request->input('id_ward');
        $address = $request->input('address');

        DB::table('customer_addresses')->where('id_customer', Auth::user()->id)->update([
            'is_current' => 0
        ]);

        DB::table('customer_addresses')->insert([
            'id_city' => 4,
            'id_ward' => $id_ward,
            'id_district' => $id_district,
            'address' => $address,
            'is_current' => 1,
            'id_customer' => Auth::user()->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect(url()->previous());
    }

    public function changeDefaultAddress(Request $request)
    {
        $customerIdAddress = $request->input('addressOfChanging');
        DB::table('customer_addresses')->where('id_customer', Auth::user()->id)->update([
            'is_current' => 0
        ]);
        DB::table('customer_addresses')->where('id', $customerIdAddress)->update([
            'is_current' => 1
        ]);

        return redirect(url()->previous());
    }
}
