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
        $customer_address = DB::table('customer_addresses')->where('id_customer', Auth::user()->id)->where('is_current', 1)->first(['id', 'id_city', 'id_district', 'id_ward', 'address', 'full_address', 'name', 'phone_number']);

        $customer_addresses = DB::table('customer_addresses')->where('id_customer', Auth::user()->id)->where('id_city', 4)->get(['id', 'id_city', 'id_district', 'id_ward', 'address', 'is_current', 'is_current', 'full_address', 'is_current', 'name', 'phone_number']);

        $have_hcmc_address = false;
        if (count($customer_addresses) > 0) {
            $have_hcmc_address = true;
        }

        $shipping_address = DB::table('shipping_addresses')->where('id_address', $customer_address->id_district)->first();
        if ($shipping_address === null) {
            $shipping_address = '';
        }

        return view('customers.checkout')->with([
            'title' => 'Thanh toán',
            'shipping_infos' => $shipping_infos,
            'customer_address' => $customer_address,
            'shipping_address' => $shipping_address,
            'customer_addresses' => $customer_addresses,
            'have_hcmc_address' => $have_hcmc_address,
        ]);
    }
}
