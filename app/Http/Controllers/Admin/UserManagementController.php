<?php

namespace App\Http\Controllers\Admin;

use App\Customer;
use App\Http\Controllers\Controller;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserManagementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $customer =Customer::all();
        return view('admins.customerManagement.index')->with([
            'title' => 'QUẢN LÝ KHÁCH HÀNG',
            'customers'=>$customer
        ]);
    }
    public function detail($id)
    {
        $customer=Customer::where('id',$id)->first();
        return view('admins.customerManagement.detail')->with([
            'title' => 'CHI TIẾT KHÁCH HÀNG',
            'customers'=> $customer,
        ]);
    }
    public function lockAccount(Request $request, $id)
    {
        DB::table('customers')->where('id',$id)->update(['status'=> 0]);
        $request->session()->flash('flash_message', 'KHÓA TÀI KHOẢN THÀNH CÔNG!');
        return redirect()->route('admins.manage.user.index');
    }

}