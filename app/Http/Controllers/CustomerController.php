<?php

namespace App\Http\Controllers;

use App\Enums\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $haveOrderInProcessing = $this->haveOrderInProcessing();
        return view('customers.account')->with([
            'title' => 'Tài khoản của tôi',
            'haveOrderInProcessing' => $haveOrderInProcessing,
        ]);
    }

    public function update(Request $request)
    {
        $validateList = [
            'name' => 'required|max:255',
            'phone_number' => 'required|max:255',
        ];

        if ($request->input('showChangePasswordForm') != null) {
            $validateList['oldPassword'] = 'required';
            $validateList['password'] = 'min:8|confirmed';
        };

        //dd($validateList);

        $request->validate(
            $validateList,
            [
                'required' => ':attribute Không được để trống',
                'min' => ':attribute phải trên :min ký tự',
                'confirmed' => 'Mật khẩu nhập lại không khớp',
            ],
            [
                'name' => 'Tên',
                'phone_number' => 'Số điện thoại',
                'oldPassword' => 'Mật khẩu cũ',
                'password' => 'Mật khẩu mới',
            ]
        );

        /* End validate */

        $customer = DB::table('customers')->where('id', Auth::user()->id)->first(['password']);
        $oldPassword = $request->input('oldPassword');
        $newPassword = $request->input('password');

        $updateList = [
            'name' => $request->input('name'),
            'phone_number' => $request->input('phone_number'),
        ];

        if ($request->input('showChangePasswordForm') != null) {
            if (!Hash::check($oldPassword, $customer->password)) {
                $request->session()->flash('fail_message', 'Mật khẩu cũ sai!');
                return redirect()->route('customers.accounts.index');
            }
            $updateList['password'] = Hash::make($newPassword);
        }

        DB::table('customers')->where('id', Auth::user()->id)->update($updateList);

        $request->session()->flash('success_message', 'Cập nhật tài khoản thành công!');
        return redirect()->route('customers.accounts.index');
    }

    public function haveOrderInProcessing()
    {
        return DB::table('order_statuses')
            ->join('orders', 'order_statuses.id_order', '=', 'orders.id')
            ->where('orders.id_customer', Auth::user()->id)
            ->where('is_current', 1)
            ->whereIn('id_status', [Status::OrderChecking, Status::OrderReceived, Status::OrderShip])
            ->exists();
    }
}
