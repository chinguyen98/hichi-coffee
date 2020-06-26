<?php

namespace App\Http\Controllers;

use App\Coffee;
use App\Helpers\FulltextSearch;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $coffeeName = $request->query('ca-phe');
        $dataToView = [
            'title' => 'Tìm kiếm',
            'searchActive' => 'active',
            'coffeeName' => $coffeeName,
        ];

        if ($coffeeName != null) {
            $fulltextsearch = new FulltextSearch();
            $str = $fulltextsearch->fullTextWildcards($coffeeName);
            $searchResult = Coffee::whereRaw('MATCH (name) AGAINST (?)', array($str))->get(['slug', 'name', 'price', 'image']);
            $dataToView['searchResult'] = $searchResult;
        }

        return view('customers.search')->with($dataToView);
    }
}
