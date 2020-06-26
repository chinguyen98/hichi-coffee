<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index()
    {
        return view('customers.search')->with([
            'title' => 'Tìm kiếm',
            'searchActive' => 'active',
        ]);
    }
}
