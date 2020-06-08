<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WareHouseManagementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        return view('admins.warehouseManagement.index')->with([
            'title' => 'Quản lý kho'
        ]);
    }

    public function create()
    {
        $suppliers = DB::table('suppliers')->get(['id', 'name']);

        return view('admins.warehouseManagement.create')->with([
            'title' => 'Nhập kho',
            'suppliers' => $suppliers,
        ]);
    }

    public function store(Request $request)
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
        return redirect()->route('admins.manage.warehouse.create');
    }
}
