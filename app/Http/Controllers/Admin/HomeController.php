<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth:admin', 'isSuperAdmin']);
    }

    public function index()
    {
        return view('admins/home')->with(['title' => 'Trang chủ']);
    }

    public function renderAdminManagementPage()
    {
        $admins = Admin::all();
        return view('admins.adminManagement.index')->with([
            'title' => 'Quản lý quản trị',
            'admins' => $admins
        ]);
    }

    public function renderAdminDetailPage($id)
    {
        $admin = Admin::where('id', $id)->first();

        return view('admins.adminManagement.detail')->with([
            'title' => 'Quản lý quản trị',
            'admin' => $admin
        ]);
    }
}
