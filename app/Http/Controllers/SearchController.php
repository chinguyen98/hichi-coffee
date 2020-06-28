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
        $coffeeName = $request->query('ca-phe');
        $from = $request->query('from') == null ? 0 : implode(explode(',', $request->query('from')));
        $to =  $request->query('to') == null ? 0 : implode(explode(',', $request->query('to')));

        $dataToView = [
            'title' => 'Tìm kiếm',
            'searchActive' => 'active',
            'coffeeName' => $coffeeName,
        ];

        $query = null;

        if ($coffeeName != null) {
            $fulltextsearch = new FulltextSearch();
            $str = $fulltextsearch->fullTextWildcards($coffeeName);
            $query = Coffee::whereRaw('MATCH (name) AGAINST (?)', array($str));
        } else {
            $query = DB::table('coffees');
        }

        if ($from != 0 || $to != 0) {
            $query = $query->whereBetween('price', [$from, $to]);
        }

        $searchResult = $query->get(['name', 'price', 'image', 'slug']);
        $dataToView['searchResult'] = $searchResult;

        return view('customers.search')->with($dataToView);
    }
}
