<?php

namespace App\Http\Controllers;

use App\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        $brands = Brand::with('coffees')->get();

        $recentBlogs = DB::table('news')->orderByDesc('created_at')->limit('3')->get();

        return view('customers.index')->with([
            'title' => 'Hichi Coffee',
            'homeActive' => 'active',
            'brands' => $brands,
            'recentBlogs' => $recentBlogs
        ]);
    }

    public function renderIntroPage()
    {
        return view('customers.intro')->with([
            'title' => 'Giới thiệu',
            'introActive' => 'active'
        ]);
    }
}
