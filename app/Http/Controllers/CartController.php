<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CartController extends Controller
{
    public function renderCartPage(Request $request)
    {
        if (Gate::denies('test-gate')) {
            $request->session()->flash('failed_message', 'Khong duoc phep!');
            return redirect()->route('customers.home');
        }

        return view('customers.cart')->with([
            'title' => 'Giỏ hàng',
        ]);
    }
}
