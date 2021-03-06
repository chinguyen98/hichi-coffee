<?php

namespace App\Http\Controllers\Admin\AuthForAdmin;

use App\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/admins/home';

    public function __construct()
    {
        $this->middleware('isSuperAdmin');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:admins'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'id_city' => ['required'],
            'id_district' => ['required'],
            'id_ward' => ['required'],
            'address' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'max:255']
        ]);
    }

    protected function create(array $data)
    {
        return Admin::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'id_city' => $data['id_city'],
            'id_district' => $data['id_district'],
            'id_ward' => $data['id_ward'],
            'address' => $data['address'],
            'phone_number' => $data['phone_number'],
            'id_role' => 2
        ]);
    }

    /*Show Register Form*/
    public function showRegisterForm()
    {
        return view('admins/authForAdmin/register');
    }
}
