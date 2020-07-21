<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RateController extends Controller
{
    public function index()
    {
        return view('customers.rates.index')->with([
            'title' => 'Nhận xét sản phẩm đã mua',
        ]);
    }
}
