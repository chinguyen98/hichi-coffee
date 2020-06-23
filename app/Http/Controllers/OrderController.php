<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use stdClass;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $carts = json_decode($request->input('cart'));
        $shippingType = DB::table('shipping_types')->where('id', $request->input('shippingType'))->first(['id', 'name', 'price']);
        $totalPrice = $request->input('totalPrice');
        $customerAddress = DB::table('customer_addresses')->where('id_customer', Auth::user()->id)->where('is_current', 1)->first(['id', 'full_address']);
        $shippingAddress = DB::table('shipping_addresses')->where('id', $request->input('id_shipping_address'))->first(['id', 'price']);
        $beforeDiscountPrice = 0;

        $id_order = DB::table('orders')->insertGetId([
            'total_price' => $totalPrice,
            'id_customer' => Auth::user()->id,
            'id_shipping_type' => $shippingType->id,
            'id_customer_address' => $customerAddress->id,
            'id_shipping_address' => $shippingAddress->id,
            'before_discount_price' => $beforeDiscountPrice,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $cartForMail = [];

        foreach ($carts as $cart) {
            $cartForMailItem = new stdClass();

            $id_valuation = null;
            $id_coffee = $cart->id;
            $coffee = DB::table('coffees')->where('id', $id_coffee)->first(['price', 'name']);
            $quantity = $cart->qty;
            $totalSubPrice = 0;
            if (property_exists($cart, 'valuation')) {
                $id_valuation = $cart->valuation;
                $valuation = DB::table('valuations')->where('id', $id_valuation)->first(['price', 'discount']);
                $totalSubPrice = $valuation->price * $quantity;

                $cartForMailItem->discountPrice = $valuation->discount;
                $cartForMailItem->newPrice = $valuation->price;
            } else {
                $totalSubPrice = $coffee->price * $quantity;

                $cartForMailItem->discountPrice = 0;
                $cartForMailItem->newPrice = $coffee->price;
            }

            $cartForMailItem->name = $coffee->name;
            $cartForMailItem->oldPrice = $coffee->price;
            $cartForMailItem->quantity = $quantity;
            $beforeDiscountPrice += $coffee->price * $quantity;

            DB::table('orders')->where('id', $id_order)->update(['before_discount_price' => $beforeDiscountPrice]);

            $cartForMail[] = $cartForMailItem;

            DB::table('order_details')->insert([
                'quantity' => $quantity,
                'price' => $coffee->price,
                'total_sub_price' => $totalSubPrice,
                'id_coffee' => $id_coffee,
                'id_order' => $id_order,
                'id_valuation' => $id_valuation,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $details = [
            'idOrder' => $id_order,
            'date_created' => now()->toDateTimeString(),
            'name' => Auth::user()->name,
            'address' => $customerAddress->full_address,
            'totalPrice' => $totalPrice,
            'shippingType' => $shippingType,
            'shippingAddress' => $shippingAddress,
            'cartForMail' => $cartForMail,
            'beforeDiscountPrice' => $beforeDiscountPrice,
        ];

        dd($details);
    }
}
