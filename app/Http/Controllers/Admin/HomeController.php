<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Enums\Status;
use App\Http\Controllers\Controller;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth:admin']);
    }

    public function index()
    {
        $count = DB::table('order_statuses')->where('id_status', 1)->where('is_current', 1)->count();
        $comment_count = DB::table('coffee_comments')->where('status', 0)->count();
        $comment_rep_count = DB::table('coffee_comment_replies')->where('status', 0)->count();
        return view('admins/home')->with([
            'title' => 'TRANG CHỦ',
            'order_count' => $count,
            'comment_count' => $comment_count,
            'comment_rep_count' => $comment_rep_count,
        ]);
    }

    public function renderAdminManagementPage()
    {
        $admins = Admin::all();
        return view('admins.adminManagement.index')->with([
            'title' => 'QUẢN LÝ QUẢN TRỊ',
            'admins' => $admins
        ]);
    }

    public function renderAdminDetailPage($id)
    {
        $admin = Admin::where('id', $id)->first();

        return view('admins.adminManagement.detail')->with([
            'title' => 'QUẢN LÝ QUẢN TRỊ',
            'admin' => $admin
        ]);
    }

    public function reset($id)
    {
        $admin = Admin::where('id', $id)->get();

        return view('admins.adminManagement.reset')->with([
            'title' => 'CẤP LẠI MẬT KHẨU',
            'admin' => $admin,
            'id_admin' => $id,
        ]);
    }

    public function resetPassword(Request $request, $id)
    {
        $request->validate(
            [
                'password' => 'required|confirmed'
            ],
            [
                'required' => ':attribute Không được để trống',
                'confirmed' => ':attribute không đúng',
            ],
            [
                'password' => 'Mật Khẩu'
            ]
        );

        DB::table('admins')->where('id', $id)->update([
            'password' => Hash::make($request->password),
            'updated_at' => now(),
        ]);
        $request->session()->flash('flash_message', 'Cập Nhật Mật Khẩu Thành Công');
        return redirect()->route('admins.renderAdminManagementPage');
    }
    public function renderInfoAdmin($id)
    {
        $admin = Admin::where('id', $id)->first();

        return view('admins.adminManagement.infoAdmin')->with([
            'title' => 'THÔNG TIN CÁ NHÂN',
            'admin' => $admin
        ]);
    }
    public function change($id)
    {
        $admin = Admin::where('id', $id)->get();

        return view('admins.adminManagement.changePassword')->with([
            'title' => 'THAY ĐỔI MẬT KHẨU',
            'admin' => $admin,
            'id_admin' => $id,
        ]);
    }
    public function changePassword(Request $request, $id)
    {
        $request->validate(
            [
                'password' => 'required|confirmed'
            ],
            [
                'required' => ':attribute Không được để trống',
                'confirmed' => ':attribute không đúng',
            ],
            [
                'password' => 'Mật Khẩu'
            ]
        );

        DB::table('admins')->where('id', $id)->update([
            'password' => Hash::make($request->password),
            'updated_at' => now(),
        ]);
        $request->session()->flash('flash_message', 'Thay Đổi Mật Khẩu Thành Công');
        return redirect()->route('admins.renderAdminManagementPage');
    }

    public function renderAnalyticPage()
    {
        $m = date('m');
        //$totalPrice = Order::whereRaw("MONTH(created_at)=?", [$m])->sum('total_price');
        $order = DB::table('orders')
            ->select(DB::raw('SUM(orders.total_price) as totalPrice'), DB::raw('COUNT(*) as sum'))
            ->join('order_statuses', 'orders.id', '=', 'order_statuses.id_order')
            ->whereRaw("MONTH(orders.created_at)=?", [$m])
            ->where('order_statuses.is_current', 1)
            ->where('order_statuses.id_status', Status::OrderFinish)
            ->first();
            
        return view('admins.analytic')->with([
            'title' => 'Thống kê',
            'order' => $order,
        ]);
    }
}
