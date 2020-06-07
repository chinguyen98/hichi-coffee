<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class AdminCoffeeManagementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        return view('admins/coffeeManagement/index')->with(['title' => 'Sản phẩm']);;
    }

    public function create()
    {
        $brands = DB::table('brands')->get(['id', 'name']);
        $coffee_types = DB::table('coffee_types')->get(['id', 'name']);
        return view('admins/coffeeManagement/create')->with(['title' => 'Thêm sản phẩm', 'brands' => $brands, 'coffee_types' => $coffee_types]);;
    }

    public function store(Request $request)
    {
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
                'status' => 1,
                'id_brand' => $coffee_update["id_brand"],
                'id_coffee_type' => $coffee_update["id_coffee_type"],
                'created_at' => now(),
                'updated_at' => now()
            ]);
            $file->move(public_path() . '/apps/images/coffees', $file->getClientOriginalName());
        }

        //$request->session()->flash('flash_message', 'Thêm sản phẩm thành công!');
        return redirect()->route('admins.manage.coffee.create');
    }
}
