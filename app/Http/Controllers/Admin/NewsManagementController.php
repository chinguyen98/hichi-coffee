<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NewsManagementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        return view('admins.newsManagement.index')->with([
            'title'=>'Danh sách tin',
        ]);
    }

    public function create(){
        return view('admins.newsManagement.create')->with([
            'title'=>'Thêm tin mới',
        ]);
    }
}
