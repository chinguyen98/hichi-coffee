@extends('layouts.adminManage')

@section('content')
<div class="product-status mg-b-30">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="product-status-wrap">
                    <h4>DANH SÁCH ĐƠN ĐẶT HÀNG</h4>
                    <h5 style="color:white">Mã đơn đặt hàng: {{$checkorder->id}}</h5>
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection