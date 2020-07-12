<?php

namespace App\Http\Controllers\Admin;

use App\Coffee;
use App\Helpers\Slug;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class CoffeeManagementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $coffees = Coffee::all();
        return view('admins/coffeeManagement/index')->with(['title' => 'QUẢN LÝ SẢN PHẨM', 'coffees' => $coffees]);;
    }

    public function create()
    {
        
        $brands = DB::table('brands')->get(['id', 'name']);
        $coffee_types = DB::table('coffee_types')->get(['id', 'name']);
        $units = DB::table('units')->get(['id', 'name', 'dram']);
        
        return view('admins/coffeeManagement/create')->with([
            'title' => 'THÊM SẢN PHẨM',
            'brands' => $brands,
            'coffee_types' => $coffee_types,
            'units' => $units
        ]);;
    }

    public function store(Request $request)
    {
        $coffeeSlug = new Slug();

        $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|integer',
            'info' => 'required|max:3000',
            'expired' => 'required|integer',
            'image' => 'required',
        ], [
            'required' => ':attribute Không được để trống',
            'max' => ':attribute Không được lớn hơn :max',
            'integer' => ':attribute Chỉ được nhập số',
        ], [
            'name' => 'Tên cà phê',
            'price' => 'Giá cà phê',
            'info' => 'Thông tin cà phê',
            'expired' => 'Hạn sử dụng',
            'image' => 'Hình ảnh',
        ]);

        $coffee_update = $request->all();

        if ($request->hasFile("image")) {
            $file = $request->image;
            DB::table('coffees')->insert([
                'name' => $coffee_update["name"],
                'price' => $coffee_update["price"],
                'info' => $coffee_update["info"],
                'expired' => $coffee_update["expired"],
                'quantity' => 0,
                'image' => $file->getClientOriginalName(),
                'status' => $coffee_update["status"],
                'slug' => $coffeeSlug->createSlug($coffee_update["name"]),
                'id_brand' => $coffee_update["id_brand"],
                'id_coffee_type' => $coffee_update["id_coffee_type"],
                'id_unit' => $coffee_update["id_unit"],
                'created_at' => now(),
                'updated_at' => now()
            ]);
            $file->move(public_path() . '/apps/images/coffees', $file->getClientOriginalName());
        }


        $request->session()->flash('flash_message', 'Thêm sản phẩm thành công!');
        return redirect()->route('admins.manage.coffee.create');
    }

    public function renderUpdateCoffeePage($id)
    {
        $coffee = DB::table('coffees')->where('id', $id)->first();
        $brands = DB::table('brands')->get(['id', 'name']);
        $coffee_types = DB::table('coffee_types')->get(['id', 'name']);
        $units = DB::table('units')->get(['id', 'name', 'dram']);

        return view('admins/coffeeManagement/update')->with([
            'title' => 'CẬP NHẬT SẢN PHẨM',
            'coffee' => $coffee,
            'brands' => $brands,
            'coffee_types' => $coffee_types,
            'units' => $units
        ]);;
    }

    public function update(Request $request, $id)
    {
        $coffeeSlug = new Slug();

        $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|integer',
            'info' => 'required|max:3000',
            'expired' => 'required|integer',
        ], [
            'required' => ':attribute Không được để trống',
            'max' => ':attribute Không được lớn hơn :max',
            'integer' => ':attribute Chỉ được nhập số',
        ], [
            'name' => 'Tên cà phê',
            'price' => 'Giá cà phê',
            'info' => 'Thông tin cà phê',
            'expired' => 'Hạn sử dụng',
        ]);

        $coffee_update = $request->all();
        DB::table('coffees')->where('id', $id)->update([
            'name' => $coffee_update["name"],
            'price' => $coffee_update["price"],
            'info' => $coffee_update["info"],
            'expired' => $coffee_update["expired"],
            'status' => $coffee_update["status"],
            'id_brand' => $coffee_update["id_brand"],
            'id_coffee_type' => $coffee_update["id_coffee_type"],
            'id_unit' => $coffee_update["id_unit"],
            'slug' => $coffeeSlug->createSlug($coffee_update["name"]),
            'updated_at' => now()
        ]);

        if ($request->hasFile("image")) {
            $file = $request->image;
            $oldFilePath = public_path() . '/apps/images/coffees/' . $coffee_update["oldImage"];
            File::delete($oldFilePath);
            DB::table('coffees')->where('id', $id)->update([
                'image' => $file->getClientOriginalName()
            ]);
            $file->move(public_path() . '/apps/images/coffees', $file->getClientOriginalName());
        }

        $request->session()->flash('flash_message', 'Cập Nhật Sản Phẩm Thành Công!');

        return redirect()->route('admins.manage.coffee.index', ['id' => $id]);
    }
}
