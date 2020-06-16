<?php

namespace App\Http\Controllers\Api;

use App\Coffee;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function getCart($listCoffeeId)
    {
        $cart = Coffee::whereIn('id', explode(',', $listCoffeeId))->get(['id', 'name', 'slug', 'image', 'price']);
        foreach ($cart as $item) {
            $item['valuation'] = DB::table('valuations')
                ->where('id_coffee', $item->id)
                ->where('expired', '>=', Carbon::now()->toDateString())
                ->get(['id', 'quantity', 'price']);
        }
        return response()->json($cart);
    }
}
