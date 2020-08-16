<?php

namespace App\Http\Controllers;

use App\CoffeeFavorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CoffeeFavoriteController extends Controller
{
    public function index()
    {
        //$favorites = CoffeeFavorite::where('id_customer', Auth::user()->id)->get();

        //dd($favorites);

        return view('customers.favorites.index')->with([
            'title' => 'Sản phẩm yêu thích',
        ]);
    }
}
