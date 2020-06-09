<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $url = 'https://thongtindoanhnghiep.co/api/city';
        $client = new Client();

        $response = $client->request('GET', $url);
        $content = json_decode($response->getBody(), true);
        $cities = $content["LtsItem"];

        return response()->json($cities);
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
        $url = 'https://thongtindoanhnghiep.co/api/city/' . $id;
        $client = new Client();

        $response = $client->request('GET', $url);
        $city = json_decode($response->getBody(), true);

        return response()->json($city);
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

    public function getDistrictsByCityId($id){
        $url = 'https://thongtindoanhnghiep.co/api/city/' . $id . '/district';
        $client = new Client();

        $response = $client->request('GET', $url);
        $districts = json_decode($response->getBody(), true);

        return response()->json($districts);
    }
}
