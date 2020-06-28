@extends('layouts.adminManage')

@section('content')

<div class="product-status mg-b-30">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="product-status-wrap">
                    <h4 style="color: teal;">CHI TIẾT PHIẾU NHẬP <span class="text-danger">#{{$input->id}}</span></h4>
                    <h5 style="color: white;">NHÀ CUNG CẤP: <span style="color: tomato; margin-left: 17px;"><i>{{$input->supplier->name}}</i></span></h5>
                    <h5 style="color: white;">QUẢN TRỊ DUYỆT: <span style="color: tomato; margin-left: 10px"><i>{{$input->admin->name}}</i></span></h5>
                    <h5 style="color: white;">NGÀY LẬP PHIẾU: <span style="color: tomato; margin-left: 13px"><i>{{date("d/m/Y", strtotime($input->created_at))}}</i></span></h5>
                    <br>
                    <table>
                        <tr>
                            <th style="color: teal">MÃ SẢN PHẨM</th>
                            <th style="color: teal">TÊN SẢN PHẨM</th>
                            <th style="color: teal">LOẠI CÀ PHÊ</th>
                            <th style="color: teal">SỐ LƯỢNG</th>
                            
                        </tr>
                        @foreach($input->input_details as $ip)
                        <tr>
                            <td>{{$ip->coffee->id}}</td>
                            <td>{{$ip->coffee->name}}</td>
                            <td>{{$ip->coffee->coffee_type->name}}</td>
                            <td>{{$ip->input_count}}</td>
                            
                        </tr>
                        @endforeach
                    
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection