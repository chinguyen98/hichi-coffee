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
        $m = date('m');
        //$totalPrice = Order::whereRaw("MONTH(created_at)=?", [$m])->sum('total_price');

        $coffees = DB::table('coffees')
            ->select(DB::raw('COUNT(coffees.id) as totalCoffee'))
            ->first();

        $coffee_comment = DB::table('coffee_comments')
            ->select(DB::raw('COUNT(*) as totalComment'))
            ->first();

        $order = DB::table('orders')
            ->select(DB::raw('SUM(orders.total_price) as totalPrice'), DB::raw('COUNT(*) as sum'))
            ->join('order_statuses', 'orders.id', '=', 'order_statuses.id_order')
            ->whereRaw("MONTH(orders.created_at)=?", [$m])
            ->where('order_statuses.is_current', 1)
            ->where('order_statuses.id_status', Status::OrderFinish)
            ->first();
        $news = DB::table('news')
            ->select(DB::raw('COUNT(*) as totalNew'))
            ->first();
        $customers = DB::table('customers')
            ->select(DB::raw('COUNT(*) as totalCustomer'))
            ->first();

        $bestCoffeeSellers = DB::select('SELECT coffees.id as coffeeId, coffees.name, coffees.price, coffees.image, coffees.slug,
            IF(EXISTS(SELECT * FROM coffees JOIN valuations on coffees.id=valuations.id_coffee WHERE valuations.id_coffee=coffeeId),1,0) as haveValuation,
            COUNT(coffees.name) as qty from order_details
            JOIN coffees ON order_details.id_coffee=coffees.id where coffees.status=1 GROUP by coffees.id, coffees.name, coffees.price, coffees.image, coffees.slug ORDER by COUNT(coffees.name) DESC LIMIT 4');

        $count = DB::table('order_statuses')->where('id_status', 1)->where('is_current', 1)->count();
        $comment_count = DB::table('coffee_comments')->where('status', 0)->count();
        $comment_rep_count = DB::table('coffee_comment_replies')->where('status', 0)->count();
        return view('admins/home')->with([
            'title' => 'TRANG CHỦ',
            'order_count' => $count,
            'comment_count' => $comment_count,
            'comment_rep_count' => $comment_rep_count,
            'order' => $order,
            'coffees' => $coffees,
            'coffee_comment' => $coffee_comment,
            'bestCoffeeSellers' => $bestCoffeeSellers,
            'new' => $news,
            'customers' => $customers,
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

        $coffees = DB::table('coffees')
            ->select(DB::raw('COUNT(coffees.id) as totalCoffee'))
            ->first();

        $coffee_comment = DB::table('coffee_comments')
            ->select(DB::raw('COUNT(*) as totalComment'))
            ->first();

        $order = DB::table('orders')
            ->select(DB::raw('SUM(orders.total_price) as totalPrice'), DB::raw('COUNT(*) as sum'))
            ->join('order_statuses', 'orders.id', '=', 'order_statuses.id_order')
            ->whereRaw("MONTH(orders.created_at)=?", [$m])
            ->where('order_statuses.is_current', 1)
            ->where('order_statuses.id_status', Status::OrderFinish)
            ->first();
        $news = DB::table('news')
            ->select(DB::raw('COUNT(*) as totalNew'))
            ->first();
        $customers = DB::table('customers')
            ->select(DB::raw('COUNT(*) as totalCustomer'))
            ->first();

        $bestCoffeeSellers = DB::select('SELECT coffees.id as coffeeId, coffees.name, coffees.price, coffees.image, coffees.slug,
            IF(EXISTS(SELECT * FROM coffees JOIN valuations on coffees.id=valuations.id_coffee WHERE valuations.id_coffee=coffeeId),1,0) as haveValuation,
            COUNT(coffees.name) as qty from order_details
            JOIN coffees ON order_details.id_coffee=coffees.id where coffees.status=1 GROUP by coffees.id, coffees.name, coffees.price, coffees.image, coffees.slug ORDER by COUNT(coffees.name) DESC LIMIT 4');

        return view('admins.analytic')->with([
            'title' => 'Thống kê',
            'order' => $order,
            'coffees' => $coffees,
            'coffee_comment' => $coffee_comment,
            'bestCoffeeSellers' => $bestCoffeeSellers,
            'new' => $news,
            'customers' => $customers,
        ]);
    }
}
