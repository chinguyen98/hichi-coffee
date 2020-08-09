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

        $bestCoffeeSellers = DB::select('SELECT coffees.name, coffees.price, coffees.image, coffees.slug, COUNT(coffees.name) as qty from order_details
            JOIN coffees ON order_details.id_coffee=coffees.id GROUP by coffees.name, coffees.price, coffees.image, coffees.slug ORDER by COUNT(coffees.name) DESC LIMIT 4');

        $recentBlogs = DB::table('news')->orderByDesc('created_at')->limit('3')->get();

        return view('customers.index')->with([
            'title' => 'Hichi Coffee',
            'homeActive' => 'active',
            'brands' => $brands,
            'bestCoffeeSellers' => $bestCoffeeSellers,
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
