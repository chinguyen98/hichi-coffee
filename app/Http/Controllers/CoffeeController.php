<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Coffee;
use App\CoffeeType;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CoffeeController extends Controller
{
    public function index(Request $request)
    {
        $brand_slug = $request->query('brand');
        $type_slug = $request->query('type');

        if ($brand_slug && $type_slug) {
            return $this->getCoffeesByBrandAndType($brand_slug, $type_slug);
        }

        if ($type_slug && $brand_slug == null) {
            return $this->getCoffeesByType($type_slug);
        }

        $brands = Brand::all();
        $menu_types = CoffeeType::with('coffees')->get();
        $coffee_types = array();

        foreach ($brands as $brand) {
            $type = DB::select('select distinct coffee_types.name, coffee_types.id, coffee_types.slug from coffee_types join coffees on coffee_types.id=coffees.id_coffee_type join brands on brands.id=coffees.id_brand where coffees.id_brand= ?', [$brand->id]);
            $coffee_types[$brand->id] = $type;
        }

        $bestCoffeeSellers = DB::select('SELECT coffees.id as coffeeId, coffees.name, coffees.price, coffees.image, coffees.slug,
            IF(EXISTS(SELECT * FROM coffees JOIN valuations on coffees.id=valuations.id_coffee WHERE valuations.id_coffee=coffeeId),1,0) as haveValuation,
            COUNT(coffees.name) as qty from order_details
            JOIN coffees ON order_details.id_coffee=coffees.id where coffees.status=1 GROUP by coffees.id, coffees.name, coffees.price, coffees.image, coffees.slug ORDER by COUNT(coffees.name) DESC LIMIT 4');

        $promotionCoffees = DB::table('coffees')
            ->select(['coffees.name', 'coffees.slug', 'coffees.price', 'coffees.image'])
            ->join('valuations', 'coffees.id', '=', 'valuations.id_coffee')
            ->where('valuations.expired', '>=', Carbon::now()->toDateString())
            ->where('coffees.status', 1)
            ->groupBy('coffees.name', 'coffees.slug', 'coffees.price', 'coffees.image')
            ->get();

        //dd($promotionCoffees);
        return view('customers.coffees.index')->with([
            'title' => 'Sản phẩm',
            'coffeeActive' => 'active',
            'brands' => $brands,
            'menu_types' => $menu_types,
            'bestCoffeeSellers' => $bestCoffeeSellers,
            'promotionCoffees' => $promotionCoffees,
            'coffee_types' => $coffee_types
        ]);
    }

    public function show($slug)
    {
        $coffee = Coffee::where('slug', $slug)->first();
        $relatedCoffees = Coffee::where('id', '<>', $coffee->id)->where('id_coffee_type', $coffee->id_coffee_type)->get(['id', 'image', 'name', 'slug', 'price']);

        $dataToView = [
            'title' => $coffee->name,
            'coffeeActive' => 'active',
            'coffee' => $coffee,
            'relatedCoffees' => $relatedCoffees,
        ];

        if (Auth::check()) {
            $haveCoffeeInOrder = DB::table('coffees')
                ->join('order_details', 'coffees.id', '=', 'order_details.id_coffee')
                ->join('orders', 'orders.id', '=', 'order_details.id_order')
                ->where('orders.id_customer', Auth::user()->id)
                ->where('order_details.id_coffee', $coffee->id)
                ->count();

            $dataToView['haveCoffeeInOrder'] = $haveCoffeeInOrder;
        }

        return view('customers.coffees.detail')->with($dataToView);
    }

    public function getCoffeesByBrandAndType($brand_slug, $type_slug)
    {
        $brand = DB::table('brands')->where('slug', $brand_slug)->first();
        $coffee_type = DB::table('coffee_types')->where('slug', $type_slug)->first();

        $coffees = Coffee::where('id_brand', $brand->id)->where('id_coffee_type', $coffee_type->id)->get();

        return view('customers.coffees.coffeesByBrandAndType')->with([
            'title' => $coffee_type->name . ' ' . $brand->name,
            'coffeeActive' => 'active',
            'coffees' => $coffees,
            'coffee_type' => $coffee_type,
            'brand' => $brand,
        ]);
    }

    public function getCoffeesByType($type_slug)
    {
        $type = DB::table('coffee_types')->where('slug', $type_slug)->first();
        $coffees =  Coffee::where('id_coffee_type', $type->id)->get();

        return view('customers.coffees.coffeesByType')->with([
            'title' => $type->name,
            'coffeeActive' => 'active',
            'coffees' => $coffees,
            'type' => $type,
        ]);
    }
}
