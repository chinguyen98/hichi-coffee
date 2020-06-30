<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Status;
use App\Http\Controllers\Controller;
use App\Order;
use App\OrderStatus;
use App\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use stdClass;

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

    public function showAllReceivedOrder()
    {
        $orderStatuses = OrderStatus::where('id_status', Status::OrderReceived)->where('is_current', 1)->get();

        return view('admins.orderManagement.allReceiveOrder')->with([
            'title' => 'TIẾP NHẬN ĐƠN HÀNG',
            'orderStatuses' => $orderStatuses,
        ]);
    }

    public function showAllShipOrder()
    {
        $orderStatuses = OrderStatus::where('id_status', Status::OrderShip)->where('is_current', 1)->get();

        return view('admins.orderManagement.allShipOrder')->with([
            'title' => 'GIAO HÀNG',
            'orderStatuses' => $orderStatuses,
        ]);
    }

    public function showAllFinishOrder()
    {
        $orderStatuses = OrderStatus::where('id_status', Status::OrderFinish)->where('is_current', 1)->get();

        return view('admins.orderManagement.allFinishOrder')->with([
            'title' => 'HOÀN THÀNH',
            'orderStatuses' => $orderStatuses,
        ]);
    }

    

    public function updateToReceivedOrder(Request $request, $id)
    {
        $order = Order::where('id', $id)->first();
        $note = $request->input('note') == null ? 'Đã tiếp nhận đơn hàng' : $request->input('note');
        $time = now();
        $needMoreCoffee = [];
        foreach ($order->order_details as $order_detail) {
            if ($order_detail->coffee->expected_quantity > $order_detail->coffee->quantity) {
                $needMoreCoffee[] = $order_detail->coffee->id;
            }
        }
        if (count($needMoreCoffee) == 0) {
            /* Khong can nhap kho */
            DB::table('order_statuses')->where('id_order', $id)->update(['is_current' => 0]);
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
            /* Can nhap kho */
            DB::table('order_statuses')->where('id_order', $id)->update(['is_current' => 0]);
            $idReceiveOrder = DB::table('order_statuses')->insertGetId([
                'note' => $note,
                'id_order' => $id,
                'id_status' => Status::OrderReceived,
                'is_current' => 1,
                'created_at' => $time,
                'updated_at' => $time,
            ]);

            return redirect()->route('admins.manage.order.receive.show', ['id' => $idReceiveOrder]);
        }
    }

    public function updateToShipOrder(Request $request, $id)
    {
        $note = $request->input('note') == null ? 'Đã tiếp nhận đơn hàng' : $request->input('note');
        $time = now();

        DB::table('order_statuses')->where('id_order', $id)->update(['is_current' => 0]);
        $idShipOrder = DB::table('order_statuses')->insertGetId([
            'note' => 'Đang giao cho đơn vị vận chuyển',
            'id_order' => $id,
            'id_status' => Status::OrderShip,
            'is_current' => 1,
            'created_at' => $time,
            'updated_at' => $time,
        ]);

        return redirect()->route('admins.manage.order.ship.show', ['id' => $idShipOrder]);
    }

    public function updateToFinishOrder(Request $request, $id)
    {
        $note = $request->input('note') == null ? 'Giao hàng thành công' : $request->input('note');
        $time = now();

        DB::table('order_statuses')->where('id_order', $id)->update(['is_current' => 0]);
        $idShipOrder = DB::table('order_statuses')->insertGetId([
            'note' => $note,
            'id_order' => $id,
            'id_status' => Status::OrderFinish,
            'is_current' => 1,
            'created_at' => $time,
            'updated_at' => $time,
        ]);

        return redirect()->route('admins.manage.order.finish.index');
    }

    public function showDetailCheckingOrder($id)
    {
        $orderStatus = OrderStatus::where('id', $id)->first();

        return view('admins.orderManagement.detailCheckOrder')->with([
            'title' => 'CHI TIẾT ĐƠN HÀNG',
            'orderStatus' => $orderStatus,
        ]);
    }

    public function showDetailReceiveOrder($id)
    {
        $orderStatus = OrderStatus::where('id', $id)->first();
        $suppliers = Supplier::all();
        $needMoreCoffee = [];

        foreach ($orderStatus->order->order_details as $order_detail) {
            $quantity = $order_detail->coffee->quantity;
            $expected_quantity = $order_detail->coffee->expected_quantity;
            $id_coffee = $order_detail->coffee->id;
            $coffee_name = $order_detail->coffee->name;
            $need = $expected_quantity - $quantity;

            if ($expected_quantity > $quantity) {
                $info = new stdClass();
                $info->quantity = $quantity;
                $info->expected_quantity = $expected_quantity;
                $info->need = $need;
                $info->id_coffee = $id_coffee;
                $info->coffee_name = $coffee_name;
                $needMoreCoffee[] = $info;
            }
        }

        return view('admins.orderManagement.detailReceiveOrder')->with([
            'title' => 'CHI TIẾT TIẾP NHẬN',
            'orderStatus' => $orderStatus,
            'needMoreCoffee' => $needMoreCoffee,
            'suppliers' => $suppliers,
        ]);
    }

    public function showDetailShippingOrder($id)
    {
        $orderStatus = OrderStatus::where('id', $id)->first();

        return view('admins.orderManagement.detailShipOrder')->with([
            'title' => 'CHI TIẾT GIAO HÀNG',
            'orderStatus' => $orderStatus,
        ]);
    }

    public function showDetailFinishOrder($id)
    {
        $orderStatus = OrderStatus::where('id', $id)->first();

        return view('admins.orderManagement.detailFinishOrder')->with([
            'title' => 'CHI TIẾT HOÀN THÀNH',
            'orderStatus' => $orderStatus,
        ]);
    }

    public function addCoffeeForOrder(Request $request)
    {
        $data = $request->input('data');
        $id_supplier = $request->input('id_supplier');
        $inputList = json_decode($data, true);

        $id_input = DB::table('inputs')->insertGetId([
            'id_supplier' => $id_supplier,
            'id_admin' => Auth::user()->id,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        foreach ($inputList as $item) {
            DB::table('input_details')->insert([
                'input_count' => $item["quantity"],
                'id_coffee' => $item["coffeeId"],
                'id_input' => $id_input,
                'created_at' => now(),
                'updated_at' => now()
            ]);
            $oldQuantity = DB::table('coffees')->where('id', $item["coffeeId"])->first(['quantity'])->quantity;
            DB::table('coffees')->where('id', $item["coffeeId"])->update(['quantity' => $oldQuantity + $item["quantity"]]);
        }

        //$request->session()->flash('flash_message', 'Thêm sản phẩm thành công!');
        return redirect()->back();
    }
}
