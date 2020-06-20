<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function renderCheckoutPage()
    {
        $shipping_infos = DB::table('shipping_types')->get();
        $customer_addresses = DB::table('customer_addresses')->where('id_customer', Auth::user()->id)->where('is_current', 1)->first(['id_city', 'id_district', 'id_ward', 'address']);
        $shipping_address = DB::table('shipping_addresses')->where('id_address', $customer_addresses->id_district)->first();
        if ($shipping_address === null) {
            $shipping_address = '';
        }

        return view('customers.checkout')->with([
            'title' => 'Thanh toán',
            'shipping_infos' => $shipping_infos,
            'customer_addresses' => $customer_addresses,
            'shipping_address' => $shipping_address,
        ]);
    }
}
