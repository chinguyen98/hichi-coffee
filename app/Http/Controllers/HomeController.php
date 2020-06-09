<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        return view('customers.home')->with([
            'title' => 'Hichi Coffee',
            'homeActive' => 'active'
        ]);
    }

    public function renderIntroPage(){
        return view('customers.intro')->with([
            'title'=>'Giới thiệu',
            'introActive'=>'active'
        ]);
    }
}
