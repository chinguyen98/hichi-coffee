<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

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
        return view('admins/coffeeManagement/create')->with(['title' => 'Thêm sản phẩm']);;
    }
}
