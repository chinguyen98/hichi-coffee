<?php

namespace App\Http\Controllers;

use App\Brand;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        $brands = Brand::with('coffees')->get();

        return view('customers.index')->with([
            'title' => 'Hichi Coffee',
            'homeActive' => 'active',
            'brands' => $brands,
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
