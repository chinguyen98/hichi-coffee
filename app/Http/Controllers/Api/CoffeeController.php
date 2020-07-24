<?php

namespace App\Http\Controllers\Api;

use App\Coffee;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CoffeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $searchingName = $request->query('searchingName');
        if ($searchingName != null) {
            $coffees = DB::table('coffees')->where('name', 'LIKE', '%' . $searchingName . '%')->get();
            return response()->json($coffees);
        }
        if ($searchingName == null) {
            $coffees = DB::table('coffees')->get();
            return response()->json($coffees);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $coffees = Coffee::find($id)->append('avgRating')->toArray();

        return response()->json($coffees);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
