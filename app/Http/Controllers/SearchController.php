<?php

namespace App\Http\Controllers;

use App\Coffee;
use App\Helpers\FulltextSearch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $brands = DB::table('brands')->get(['name']);
        $coffeeTypes = DB::table('coffee_types')->get(['name']);

        $dataToView = [
            'title' => 'Tìm kiếm',
            'searchActive' => 'active',
            'brands' => $brands,
            'coffee_types' => $coffeeTypes,
        ];

        if (count($request->all()) == 0) {
            return view('customers.search')->with($dataToView);
        }

        $coffeeName = $request->query('ca-phe');
        $brandName = $request->query('thuong-hieu');
        $coffeeTypeName = $request->query('loai-ca-phe');
        $from = $request->query('from') == null ? 0 : implode(explode(',', $request->query('from')));
        $to =  $request->query('to') == null ? 0 : implode(explode(',', $request->query('to')));
        $sortTitle = $request->query('sortTitle');
        $sortValue = $request->query('sortValue');

        $query = DB::table('coffees')
            ->selectRaw('coffees.id as coffeeId, coffees.name, coffees.price, coffees.image, coffees.slug, IF(EXISTS(SELECT * FROM coffees JOIN valuations on coffees.id=valuations.id_coffee WHERE valuations.id_coffee=coffeeId),1,0) as haveValuation')
            ->join('brands', 'brands.id', '=', 'coffees.id_brand')
            ->join('coffee_types', 'coffee_types.id', '=', 'coffees.id_coffee_type');

        if ($from != 0 || $to != 0) {
            $query = $query->whereBetween('price', [$from, $to]);
        }

        if ($brandName != null) {
            $query = $query->where('brands.name', 'like', $brandName);
        }

        if ($coffeeTypeName != null) {
            $query = $query->where('coffee_types.name', 'like', $coffeeTypeName);
        }

        if ($coffeeName != null) {
            $fulltextsearch = new FulltextSearch();
            $str = $fulltextsearch->fullTextWildcards($coffeeName);
            $query = $query
                ->whereRaw('MATCH (coffees.name) AGAINST (?)', array($str));
        }

        try {
            if ($sortValue != null && $sortTitle != null) {
                $query = $query->orderBy($sortTitle, $sortValue);
            }
        } catch (\Exception $e) {
            $query = $query->orderBy('price', 'asc');
        }

        $query=$query->where('coffees.status', 1);

        $searchResult = $query->get();

        //dd($searchResult);

        $dataToView['searchResult'] = $searchResult;

        return view('customers.search')->with($dataToView);
    }
}
