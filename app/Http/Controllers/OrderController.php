<?php

namespace App\Http\Controllers;

use App\Enums\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotifyOrderMail;
use App\Order;
use stdClass;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $orders = Order::where('id_customer', Auth::user()->id)->orderByDesc('created_at')->get();

        return view('customers.orders.index')->with([
            'title' => 'Đơn hàng của tôi',
            'orders' => $orders,
        ]);
    }

    public function store(Request $request)
    {
        $carts = json_decode($request->input('cart'));
        $shippingType = DB::table('shipping_types')->where('id', $request->input('shippingType'))->first(['id', 'name', 'price']);
        $totalPrice = $request->input('totalPrice');
        $customerAddress = DB::table('customer_addresses')->where('id_customer', Auth::user()->id)->where('is_current', 1)->first(['id', 'full_address']);
        $shippingAddress = DB::table('shipping_addresses')->where('id_address', $request->input('id_shipping_address'))->first(['id', 'price']);
        $beforeDiscountPrice = 0;
        $totalDiscountPrice = 0;
        $created_at = now();
        $updated_at = now();

        $id_order = DB::table('orders')->insertGetId([
            'total_price' => $totalPrice,
            'id_customer' => Auth::user()->id,
            'id_shipping_type' => $shippingType->id,
            'id_customer_address' => $customerAddress->id,
            'id_shipping_address' => $shippingAddress->id,
            'before_discount_price' => $beforeDiscountPrice,
            'created_at' => $created_at,
            'updated_at' => $updated_at,
        ]);

        $cartForMail = [];

        foreach ($carts as $cart) {
            $cartForMailItem = new stdClass();
            $id_valuation = null;
            $id_coffee = $cart->id;
            $coffee = DB::table('coffees')->where('id', $id_coffee)->first(['price', 'name', 'quantity', 'expected_quantity']);
            $quantity = $cart->qty;
            $totalSubPrice = 0;

            if (property_exists($cart, 'valuation')) {
                $id_valuation = $cart->valuation;
                $valuation = DB::table('valuations')->where('id', $id_valuation)->first(['price', 'discount']);
                $totalSubPrice = $valuation->price * $quantity;

                DB::table('valuation_order_details')->insert([
                    'id_order' => $id_order,
                    'id_coffee' => $cart->id,
                    'id_valuation' => $id_valuation,
                ]);

                $cartForMailItem->discountPrice = $valuation->discount;
                $cartForMailItem->newPrice = $valuation->price;
                $totalDiscountPrice += $valuation->discount;
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
                'created_at' => $created_at,
                'updated_at' => $updated_at,
            ]);

            DB::table('coffees')->where('id', $id_coffee)->update([
                'expected_quantity' => $coffee->expected_quantity + $quantity,
            ]);
        }

        $details = [
            'idOrder' => $id_order,
            'date_created' => now()->toDateTimeString(),
            'name' => Auth::user()->name,
            'email' => Auth::user()->email,
            'address' => $customerAddress->full_address,
            'totalPrice' => $totalPrice,
            'shippingPrice' => $shippingType->price + $shippingAddress->price,
            'cartForMail' => $cartForMail,
            'beforeDiscountPrice' => $beforeDiscountPrice,
            'totalDiscountPrice' => $totalDiscountPrice,
        ];

        DB::table('order_statuses')->insert([
            'note' => 'Nhân viên của chúng tôi đang duyệt đơn hàng của bạn.',
            'id_order' => $id_order,
            'id_status' => Status::OrderChecking,
            'is_current' => 1,
            'created_at' => $created_at,
            'updated_at' => $updated_at,
        ]);

        Mail::to(Auth::user()->email)->send(new NotifyOrderMail($details));

        $request->session()->flash('success_message', 'Đặt hàng thành công! Nhân viên đang kiểm tra đơn hàng của bạn!');
        return redirect()->route('customers.orders.show', ['id' => $id_order]);
    }

    public function show($id)
    {
        $order = Order::where('id', $id)->first();

        if ($order == null || $order->id_customer != Auth::user()->id) {
            return redirect()->route('customers.orders.index');
        }

        return view('customers.orders.detail')->with([
            'title' => 'Chi tiết đơn hàng',
            'order' => $order,
        ]);
    }
}
