<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $carts = json_decode($request->input('cart'));
        $idShippingType = $request->input('shippingType');
        $totalPrice = $request->input('totalPrice');
        $idShipingAddress = DB::table('customer_addresses')->where('is_current', 1)->first(['id'])->id;

        $id_order = DB::table('orders')->insertGetId([
            'total_price' => $totalPrice,
            'id_customer' => Auth::user()->id,
            'id_shipping_type' => $idShippingType,
            'id_shipping_address' => $idShipingAddress,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        foreach ($carts as $cart) {
            $id_valuation = null;
            $id_coffee = $cart->id;
            $price = DB::table('coffees')->where('id', $id_coffee)->first(['price'])->price;
            $quantity = $cart->qty;
            $totalSubPrice = 0;
            if (property_exists($cart, 'valuation')) {
                $id_valuation = $cart->valuation;
                $valuation_price = DB::table('valuations')->where('id', $id_valuation)->first(['price'])->price;
                $totalSubPrice = $valuation_price * $quantity;
            } else {
                $totalSubPrice = $price * $quantity;
            }

            DB::table('order_details')->insert([
                'quantity' => $quantity,
                'price' => $price,
                'total_sub_price' => $totalSubPrice,
                'id_coffee' => $id_coffee,
                'id_order' => $id_order,
                'id_valuation' => $id_valuation,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
