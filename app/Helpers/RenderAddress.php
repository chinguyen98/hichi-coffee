<?php

namespace App\Helpers;

use GuzzleHttp\Client;

class RenderAddress
{
    public function getCityDetailFromApi($id){
        $url = 'https://thongtindoanhnghiep.co/api/city/' . $id;
        $client = new Client();

        $response = $client->request('GET', $url);
        $city = json_decode($response->getBody(), true);

        return $city;
    }

    public function getDistrictDetailFromApi($id){
        $url = 'https://thongtindoanhnghiep.co/api/district/' . $id;
        $client = new Client();

        $response = $client->request('GET', $url);
        $district = json_decode($response->getBody(), true);

        return $district;
    }

    public function getWardDetailFromApi($id){
        $url = 'https://thongtindoanhnghiep.co/api/ward/' . $id;
        $client = new Client();

        $response = $client->request('GET', $url);
        $ward = json_decode($response->getBody(), true);

        return $ward;
    }

    public function getDistrictsFromApi($id_city){
        $url = 'https://thongtindoanhnghiep.co/api/city/' . $id_city . '/district';
        $client = new Client();

        $response = $client->request('GET', $url);
        $city = json_decode($response->getBody(), true);

        return $city;
    }
}
