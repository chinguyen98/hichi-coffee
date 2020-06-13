<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Coffee;
use App\CoffeeType;
use Illuminate\Support\Facades\DB;

class CoffeeController extends Controller
{
    public function index()
    {
        $brands = Brand::all();
        $menu_types = CoffeeType::with('coffees')->get();
        $coffee_types = array();

        foreach ($brands as $brand) {
            $type = DB::select('select distinct coffee_types.name, coffee_types.id from coffee_types join coffees on coffee_types.id=coffees.id_coffee_type join brands on brands.id=coffees.id_brand where coffees.id_brand= ?', [$brand->id]);
            $coffee_types[$brand->id] = $type;
        }

        return view('customers.coffees.index')->with([
            'title' => 'Sản phẩm',
            'coffeeActive' => 'active',
            'brands' => $brands,
            'menu_types' => $menu_types,
            'coffee_types' => $coffee_types
        ]);
    }

    public function show($slug)
    {
        $coffee = Coffee::where('slug', $slug)->first();

        return view('customers.coffees.detail')->with([
            'title' => $coffee->name,
            'coffeeActive' => 'active',
            'coffee' => $coffee,
        ]);
    }
}
