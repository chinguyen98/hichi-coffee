<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Order;
use Illuminate\Http\Request;

class OrdermangentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $order = Order::all();
        return view('admins.orderManagement.index')->with([
            'title' => 'QUẢN LÝ ĐƠN HÀNG',
            'orders' => $order
        ]);
    }
    public function detail($id)
    {
        $order = Order::where('id',$id)->first();
        
        return view('admins.orderManagement.detail')->with([
            'title' =>'CHI TIẾT ĐƠN HÀNG',
            'order' => $order
        ]);
    }

}