<?php

namespace App\Http\Controllers;

use App\Helpers\RenderAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AddressController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $customer_addresses = DB::table('customer_addresses')->where('id_customer', Auth::user()->id)->get(['id', 'full_address', 'is_current']);
        return view('customers.addresses.index')->with([
            'title' => 'Địa chỉ của tôi',
            'customer_addresses' => $customer_addresses,
        ]);
    }

    public function create()
    {
        return view('customers.addresses.create')->with([
            'title' => 'Tạo địa chỉ mới',
        ]);
    }

    public function show($id)
    {
        $customer_address = DB::table('customer_addresses')->where('id', $id)->first();
        return view('customers.addresses.show')->with([
            'title' => 'Địa chỉ của tôi',
            'customer_address' => $customer_address,
        ]);
    }

    public function store(Request $request)
    {
        $id_district = $request->input('id_district');
        $id_ward = $request->input('id_ward');
        $address = $request->input('address');

        $renderAddressHelper = new RenderAddress();
        $city = $renderAddressHelper->getCityDetailFromApi(4)['Title'];
        $district = $renderAddressHelper->getDistrictDetailFromApi($id_district)['Title'];
        $ward = $renderAddressHelper->getWardDetailFromApi($id_ward)['Title'];

        $fullAddress = $address . ', ' . $ward . ', ' . $district . ', ' . $city;

        DB::table('customer_addresses')->where('id_customer', Auth::user()->id)->update([
            'is_current' => 0
        ]);

        DB::table('customer_addresses')->insert([
            'id_city' => 4,
            'id_ward' => $id_ward,
            'id_district' => $id_district,
            'address' => $address,
            'city' => $city,
            'district' => $district,
            'ward' => $ward,
            'full_address' => $fullAddress,
            'is_current' => 1,
            'id_customer' => Auth::user()->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $request->session()->flash('success_message', 'Tạo địa chỉ giao hàng thành công!');
        return redirect(url()->previous());
    }

    public function update(Request $request, $id)
    {
        $id_district = $request->input('id_district');
        $id_ward = $request->input('id_ward');
        $address = $request->input('address');

        $renderAddressHelper = new RenderAddress();
        $city = $renderAddressHelper->getCityDetailFromApi(4)['Title'];
        $district = $renderAddressHelper->getDistrictDetailFromApi($id_district)['Title'];
        $ward = $renderAddressHelper->getWardDetailFromApi($id_ward)['Title'];

        $fullAddress = $address . ', ' . $ward . ', ' . $district . ', ' . $city;

        if ($request->input('is_current') == 'on') {
            DB::table('customer_addresses')->where('id_customer', Auth::user()->id)->update([
                'is_current' => 0
            ]);
        }

        DB::table('customer_addresses')->where('id', $id)->update([
            'id_city' => 4,
            'id_ward' => $id_ward,
            'id_district' => $id_district,
            'address' => $address,
            'city' => $city,
            'district' => $district,
            'ward' => $ward,
            'full_address' => $fullAddress,
            'is_current' => 1,
            'id_customer' => Auth::user()->id,
            'updated_at' => now(),
        ]);

        $request->session()->flash('success_message', 'Cập nhật địa chỉ giao hàng thành công!');
        return redirect(url()->previous());
    }

    public function changeDefaultAddress(Request $request)
    {
        $customerIdAddress = $request->input('addressOfChanging');
        DB::table('customer_addresses')->where('id_customer', Auth::user()->id)->update([
            'is_current' => 0
        ]);
        DB::table('customer_addresses')->where('id', $customerIdAddress)->update([
            'is_current' => 1
        ]);

        $request->session()->flash('success_message', 'Thay đổi địa chỉ giao hàng thành công!');
        return redirect(url()->previous());
    }
}
