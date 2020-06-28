<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Status;
use App\Http\Controllers\Controller;
use App\Order;
use App\OrderStatus;
use Illuminate\Http\Request;

class OrdermangentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function showAllCheckingOrder()
    {
        $orderStatuses = OrderStatus::where('id_status', Status::OrderChecking)->where('is_current', 1)->get();

        return view('admins.orderManagement.allCheckOrder')->with([
            'title' => 'KIỂM TRA ĐƠN HÀNG',
            'orderStatuses' => $orderStatuses,
        ]);
    }

    public function showDetailCheckingOrder($id)
    {
        $orderStatus = OrderStatus::where('id', $id)->first();

        return view('admins.orderManagement.detailCheckOrder')->with([
            'title' => 'CHI TIẾT ĐƠN HÀNG',
            'orderStatus' => $orderStatus,
        ]);
    }

    public function updateToReceivedOrder($id){
        dd($id);
    }
}
