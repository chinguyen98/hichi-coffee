<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PromotionManagementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        return view('admins.promotionManagement.index')->with([
            'title' => 'Quản lý khuyến mãi',
        ]);
    }

    public function create()
    {
        return view('admins.promotionManagement.create')->with([
            'title' => 'Tạo mới khuyến mãi',
        ]);
    }
}
