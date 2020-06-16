<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function renderCartPage()
    {
        return view('customers.cart')->with([
            'title' => 'Giỏ hàng',
        ]);
    }
}
