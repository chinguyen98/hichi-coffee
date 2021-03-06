<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\ValuationInfoMail;
use App\Valuation;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class PromotionManagementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $valuations = Valuation::all();
        return view('admins.promotionManagement.index')->with([
            'title' => 'QUẢN LÝ KHUYẾN MÃI',
            'valuation' => $valuations
        ]);
    }

    public function create()
    {
        return view('admins.promotionManagement.create')->with([
            'title' => 'TẠO MỚI',
        ]);
    }
    public function store(Request $req)
    {
        $req->validate([
            'price' => 'required|integer',
            'quantity' => 'required|integer',
            'discount' => 'required|integer',
            'id_coffee' => 'required|integer',
        ], [
            'required' => ':attribute Không được để trống',
            'integer' => ':attribute Chỉ được nhập số',
        ], [
            'price' => 'Giá',
            'quantity' => 'Số lượng',
            'discount' => 'Giá khuyến mãi',
            'id_coffee' => 'Sản phẩm',
        ]);

        $km = DB::table('valuations')->where('id_coffee', $req->input('id_coffee'))->where('expired', '>=', Carbon::now()->toDateString())->where('quantity', $req->input('quantity'))->get();
        if (count($km) == 0) {
            DB::table('valuations')->insert([
                'price' => $req->input('price'),
                'quantity' => $req->input('quantity'),
                'discount' => $req->input('discount'),
                'expired' => $req->input('expired'),
                'id_coffee' => $req->input('id_coffee'),
                'created_at' => now(),
                'updated_at' => now()
            ]);
            $req->session()->flash('flash_message', 'Thêm khuyến mãi thành công!');
            return redirect()->route('admins.manage.promotion.index');
        } else {
            $req->session()->flash('flash_message', 'Không thể thêm khuyến mãi!');
            return redirect()->route('admins.manage.promotion.create');
        }
    }
    public function detail($id)
    {
        $valuations = Valuation::where('id', $id)->first();

        return view('admins.promotionManagement.detail')->with([
            'title' => 'CHI TIẾT KHUYẾN MÃI',
            'valuation' => $valuations
        ]);
    }

    public function create_bonus_content()
    {
        return view('admins.promotionManagement.create_bonus')->with([
            'title' => 'Tạo Khuyến Mãi Tặng Kèm',
        ]);
    }

    public function store_bonus_content(Request $request)
    {
        $id_coffee = $request->input('id_coffee');
        $expired = $request->input('expired');
        $bonus_content = $request->input('bonus_content');

        list($y, $m, $d) = explode('-', $expired);

        //dd($expired);

        $km = DB::table('valuations')->where('bonus_content', '!=', 'null')->where('id_coffee', $id_coffee)->whereRaw("DAYOFMONTH(expired)=? AND MONTH(expired)=? AND YEAR(expired)=?", [$d, $m, $y])->exists();

        if ($km == true) {
            $request->session()->flash('flash_message', 'Không thể thêm khuyến mãi!');
            return redirect()->route('admins.manage.bonus_content.create');
        } else {
            DB::table('valuations')->insert([
                'bonus_content' => $bonus_content,
                'expired' => $expired,
                'id_coffee' => $id_coffee,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $request->session()->flash('flash_message', 'Thêm khuyến mãi thành công!');
            return redirect()->route('admins.manage.promotion.index');
        }
    }

    public function sendInfo(Request $request, $id)
    {
        $listCustomer = DB::table('customers')
            ->join('coffee_favorites', 'coffee_favorites.id_customer', '=', 'customers.id')
            ->join('coffees', 'coffees.id', '=', 'coffee_favorites.id_coffee')
            ->join('valuations', 'valuations.id_coffee', '=', 'coffees.id')
            ->where('valuations.id', $id)
            ->get([
                'customers.email as customerEmail',
                'customers.name as customerName',
                'coffees.name as coffeeName',
                'coffees.price as coffeePrice',
                'coffees.slug as coffeeSlug',
                'valuations.price as valuationPrice',
                'valuations.discount as valuationDiscount',
                'valuations.quantity as valuationQuantity',
                'valuations.bonus_content as valuationBonusContent'
            ]);

        $details = [
            'coffeeName' => $listCustomer[0]->coffeeName,
            'coffeePrice' => $listCustomer[0]->coffeePrice,
            'coffeeSlug' => $listCustomer[0]->coffeeSlug,
            'valuationQuantity' => $listCustomer[0]->valuationQuantity,
            'valuationPrice' => $listCustomer[0]->valuationPrice,
            'valuationDiscount' => $listCustomer[0]->valuationDiscount,
            'valuationBonusContent' => $listCustomer[0]->valuationBonusContent,
        ];

        $listSendMail = array_map(function ($value) {
            return $value->customerEmail;
        }, $listCustomer->toArray());

        Mail::to($listSendMail)->send(new ValuationInfoMail($details));

        $request->session()->flash('flash_message', 'Gửi mail khuyến mãi thành công!');
        return redirect()->route('admins.manage.promotion.index');
    }
}
