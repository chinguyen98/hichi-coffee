<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Customer;
use App\CustomerAddress;
use App\Helpers\RenderAddress;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/accounts';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:customers'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'address' => ['required', 'string'],
            'id_city' => ['gt:0'],
            'id_district' => ['gt:0'],
            'id_ward' => ['gt:0'],
            'phone_number' => ['required', 'string'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $renderAddressHelper = new RenderAddress();
        $city = $renderAddressHelper->getCityDetailFromApi($data['id_city'])['Title'];
        $district = $renderAddressHelper->getDistrictDetailFromApi($data['id_district'])['Title'];
        $ward = $renderAddressHelper->getWardDetailFromApi($data['id_ward'])['Title'];
        $address = $data['address'];

        $fullAddress = $address . ', ' . $ward . ', ' . $district . ', ' . $city;

        $customer = Customer::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'phone_number' => $data['phone_number'],
            'status' => 1
        ]);

        $id_customer = DB::table('customers')->where('email', $data['email'])->first(['id'])->id;
        $customer_address = CustomerAddress::create([
            'id_city' => $data['id_city'],
            'id_district' => $data['id_district'],
            'id_ward' => $data['id_ward'],
            'address' => $address,
            'city' => $city,
            'district' => $district,
            'ward' => $ward,
            'full_address' => $fullAddress,
            'name' => $data['name'],
            'phone_number' => $data['phone_number'],
            'is_current' => 1,
            'id_customer' => $id_customer,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return $customer;
    }
}
