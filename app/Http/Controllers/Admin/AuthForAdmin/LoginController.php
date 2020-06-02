<?php

namespace App\Http\Controllers\Admin\AuthForAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = 'admins/home';

    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    public function showLoginForm()
    {
        return view('admins/authForAdmin/login');
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }
}
