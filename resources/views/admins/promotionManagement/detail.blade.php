@extends('layouts.adminManage')

@section('content')
<div class="product-status mg-b-30">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="product-status-wrap">
                    <h4 style="color: mediumspringgreen;">CHI TIẾT KHUYẾN MÃI</h4>

                    <h5 style="color: wheat;">MÃ KHUYẾN MÃI:<i style="margin-left: 20px;">#{{$valuation->id}}</i></h5>
                    <h5 style="color: wheat;">GIÁ GỐC: <i style="margin-left: 5em;">{{$valuation->coffee->price}}</i> </h5>
                    <h5 style="color: wheat;">NGÀY TẠO: <i style="margin-left: 4em;">{{date("d/m/Y", strtotime($valuation->created_at))}}</i></h5>
                </div>



                <div style="margin-top: 2rem;" class="product-status-wrap">
                    <table>
                        <tr>
                            <th style="color: mediumspringgreen;">MÃ SẢN PHẨM</th>
                            <th style="color: mediumspringgreen;">TÊN SẢN PHẨM</th>
                            <th style="color: mediumspringgreen;">SỐ LƯỢNG ĐƯỢC KHUYẾN MÃI</th>
                            <th style="color: mediumspringgreen;">GIÁ KHUYẾN MÃI</th>
                            <th style="color: mediumspringgreen;">NGÀY HẾT HẠN</th>
                        </tr>
                        <tr>
                            <td>{{$valuation->coffee->id}}</td>
                            <td>{{$valuation->coffee->name}}</td>
                            <td>{{$valuation->quantity}}</td>
                            <td>{{$valuation->price}}</td>
                            <td>{{date("d/m/Y", strtotime($valuation->expired))}}</td>
                        </tr>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection