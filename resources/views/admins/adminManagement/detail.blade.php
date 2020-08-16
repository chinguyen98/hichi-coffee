@extends('layouts.adminManage')

@section('content')

<div class="product-status mg-b-30">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="product-status-wrap">
                    <div class="add-product">
                        <a href="{{route('admins.reset', ['id'=>$admin->id])}}"><b style="color: darkturquoise;">CẤP LẠI MẬT KHẨU</b></a>

                    </div>
                    <h3 style="color:turquoise; margin-left: 1em;">THÔNG TIN CHI TIẾT QUẢN TRỊ</h3>
                    <br>
                    <h4 style="margin-left: 2em;">THÔNG TIN CÁ NHÂN</h4>
                    <h5 style="margin-left: 3.5em ;color: brown;">HỌ VÀ TÊN: <span style="color: chartreuse; margin-left: 3em;"><i><b>{{$admin->name}}</b></i></span></h5>
                    <h5 style="margin-left: 3.5em ;color: brown;">ĐỊA CHỈ: <span style="color: chartreuse; margin-left: 4.3em;"><i><b>{{$admin->full_address}}</b></i></span></h5>
                    <h5 style="margin-left: 3.5em ;color: brown;">EMAIL: <span style="color: chartreuse; margin-left: 4.8em;"><i><b>{{$admin->email}}</b></i></span></h5>
                    <h5 style="margin-left: 3.5em ;color: brown;">SỐ ĐIỆN THOẠI: <span style="color: chartreuse; margin-left: 10px;"><i><b>{{$admin->phone_number}}</b></i></span></h5>
                    <br>
                    <h4 style="margin-left: 2em;">LIÊN HỆ WEBSITE</h4>
                    <h5 style="margin-left: 3.5em ;color: brown;">CHỨC VỤ: <span style="color: chartreuse; margin-left: 3.5em;"><i><b>{{$admin->id_role}}</b></i></span></h5>
                    <h5 style="margin-left: 3.5em ;color: brown;">NGÀY THAM GIA: <span style="color: chartreuse;"><i><b>{{$admin->created_at}}</b></i></span></h5>
                </div>
            </div>

        </div>
    </div>
</div>
<script src="/apps/js/loadAddressInfo.js"></script>

@endsection