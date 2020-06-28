<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Order;
use Illuminate\Http\Request;

class CheckordermangentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $checkorders =Order::all();
        return view('admins.checkorderManagement.index')->with([
            'title' => 'QUẢN LÝ ĐƠN ĐẶT HÀNG',
            'checkorder'=>$checkorders
        ]);
    }

}
