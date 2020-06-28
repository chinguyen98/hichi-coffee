<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Status;
use App\Http\Controllers\Controller;
use App\Order;
use App\OrderStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function updateToReceivedOrder(Request $request, $id)
    {
        $order = Order::where('id', $id)->first();
        $note=$request->input('note')==null ? 'Đã tiếp nhận đơn hàng':$request->input('note');
        $time = now();
        $needMoreCoffee = [];
        foreach ($order->order_details as $order_detail) {
            if ($order_detail->coffee->expected_quantity > $order_detail->coffee->quantity) {
                $needMoreCoffee[] = $order_detail->coffee->id;
            }
        }
        if (count($needMoreCoffee) == 0) {
            DB::table('order_statuses')->where('id_order', $id)->update(['is_current'=> 0]);
            DB::table('order_statuses')->insert([
                'note' => $note,
                'id_order' => $id,
                'id_status' => Status::OrderReceived,
                'is_current' => 0,
                'created_at' => $time,
                'updated_at' => $time,
            ]);
            $idShipOrder = DB::table('order_statuses')->insertGetId([
                'note' => 'Đang giao cho đơn vị vận chuyển',
                'id_order' => $id,
                'id_status' => Status::OrderShip,
                'is_current' => 1,
                'created_at' => $time,
                'updated_at' => $time,
            ]);

            return redirect()->route('admins.manage.order.ship.show', ['id' => $idShipOrder]);
        } else {
            dd('Can nhap kho');
        }
    }

    public function showDetailShippingOrder($id)
    {
        $orderStatus = OrderStatus::where('id', $id)->first();

        return view('admins.orderManagement.detailShipOrder')->with([
            'title' => 'CHI TIẾT GIAO HÀNG',
            'orderStatus' => $orderStatus,
        ]);
    }
}
