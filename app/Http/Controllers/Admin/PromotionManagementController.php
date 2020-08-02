<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Valuation;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

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
            'valuation'=>$valuations
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
        $valuations = Valuation::where('id',$id)->first();
        
        return view('admins.promotionManagement.detail')->with([
            'title' =>'CHI TIẾT KHUYẾN MÃI',
            'valuation' => $valuations
        ]);
    }
}
