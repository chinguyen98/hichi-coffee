<?php

namespace App\Http\Controllers\Api;

use App\CoffeeFavorite;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CoffeeFavoriteController extends Controller
{
    public function handlingFavorite(Request $request)
    {
        $id_coffee = $request->id_coffee;
        $id_customer = Auth::user()->id;
        $now = now();

        $favoriteExists = CoffeeFavorite::where('id_coffee', $id_coffee)->where('id_customer', $id_customer);

        if ($favoriteExists->exists()) {
            $favoriteExists->first()->delete();
        } else {
            $favorite = new CoffeeFavorite();
            $favorite->id_coffee = $id_coffee;
            $favorite->id_customer = $id_customer;
            $favorite->created_at = $now;
            $favorite->updated_at = $now;
            $favorite->save();
        }

        return response()->json($favoriteExists->exists());
    }
}
