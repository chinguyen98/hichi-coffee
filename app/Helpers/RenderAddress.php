<?php

namespace App\Helpers;

use GuzzleHttp\Client;

class RenderAddress
{
    public function getCityDetailFromApi($id)
    {
        $url = 'https://thongtindoanhnghiep.co/api/city/' . $id;
        $response = file_get_contents($url);
        $city = json_decode($response, true);

        return $city;
    }

    public function getDistrictDetailFromApi($id)
    {
        $url = 'https://thongtindoanhnghiep.co/api/district/' . $id;
        $response = file_get_contents($url);
        $district = json_decode($response, true);

        return $district;
    }

    public function getWardDetailFromApi($id)
    {
        $url = 'https://thongtindoanhnghiep.co/api/ward/' . $id;
        $response = file_get_contents($url);
        $ward = json_decode($response, true);

        return $ward;
    }

    public function getCitiesFromApi()
    {
        $url = 'https://thongtindoanhnghiep.co/api/city';

        $response = file_get_contents($url);
        $content = json_decode($response, true);

        return $content['LtsItem'];
    }

    public function getDistrictsFromApi($id_city)
    {
        $url = 'https://thongtindoanhnghiep.co/api/city/' . $id_city . '/district';
        $response = file_get_contents($url);

        $districts = json_decode($response, true);

        return $districts;
    }

    public function getWardsFromApi($id_district)
    {
        $url = 'https://thongtindoanhnghiep.co/api/district/' . $id_district . '/ward';
        $response = file_get_contents($url);

        $city = json_decode($response, true);

        return $city;
    }
}
