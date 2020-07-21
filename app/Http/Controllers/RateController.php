<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RateController extends Controller
{
    public function index()
    {
        $coffees = DB::table('orders')
            ->join('order_details', 'orders.id', '=', 'order_details.id_order')
            ->join('coffees', 'coffees.id', '=', 'order_details.id_coffee')
            ->where('orders.id_customer', Auth::user()->id)
            ->distinct('coffees.id')
            ->get([
                'coffees.slug',
                'coffees.image',
                'coffees.name',
            ]);

        return view('customers.rates.index')->with([
            'title' => 'Nhận xét sản phẩm đã mua',
            'coffees' => $coffees,
        ]);
    }
}
