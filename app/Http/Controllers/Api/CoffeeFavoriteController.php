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
        $status = $request->status;
        $now = now();

        if ($status == 1) {
            $favorite = CoffeeFavorite::where('id_coffee', $id_coffee)->where('id_customer', $id_customer)
                ->firstOrCreate([
                    'id_coffee' => $id_coffee,
                    'id_customer' => $id_customer,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
        } elseif ($status == 0) {
            $favoriteExists = CoffeeFavorite::where('id_coffee', $id_coffee)->where('id_customer', $id_customer);
            if ($favoriteExists->exists()) {
                $favoriteExists->first()->delete();
            }
        }

        return response()->json('OK');
    }
}
