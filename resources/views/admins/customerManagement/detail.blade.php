@extends('layouts.adminManage')

@section('content')
<div class="product-status mg-b-30">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <form action="{{route('admins.manage.user.lock',['id'=>$customers->id] )}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="product-status-wrap">
                        <h4 style="color: mediumspringgreen;">CHI TIẾT KHÁCH HÀNG</h4>
                        <h5 style="color: wheat;">MÃ KHÁCH HÀNG:<i style="margin-left: 53px;">#{{$customers->id}}</i></h5>
                        <h5 style="color: wheat;">TÊN KHÁCH HÀNG:<i style="margin-left: 49px;">{{$customers->name}}</i></h5>
                        <h5 style="color: wheat;">ĐỊA CHỈ EMAIL:<i style="margin-left: 72px;">{{$customers->email}}</i></h5>
                        <h5 style="color: wheat;">SỐ ĐIỆN THOẠI:<i style="margin-left: 67px;">{{$customers->phone_number}}</i></h5>
                        <h5 style="color: wheat;">NGÀY TẠO TÀI KHOẢN:<i style="margin-left: 20px;">{{date("d/m/Y", strtotime($customers->created_at))}}</i></h5>
                        <hr style="width: 100%; text-align: right; margin-right: 0;">
                        <div style="margin-top: 0.5rem;" class="product-status-wrap">
                            <div style="display: flex; justify-content: center; align-items: center;">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="text-center custom-pro-edt-ds">
                                        <input style="margin-left: 60em;" type="submit" class="btn btn-primary" value="KHÓA">
                                        </input>
                                    </div>
                                </div>
                                <span style="color: orange; margin-left: 1.5em;"> || </span>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="text-center custom-pro-edt-ds">
                                        <input form="formUnLock" style=" margin-right: 6em;" type="submit" class="btn btn-success" value="MỞ KHÓA">
                                        </input>
                                    </div>
                                </div>
                            </div>

                        </div>
                </form>
                <form id="formUnLock" action="{{route('admins.manage.user.unlock', ['id'=>$customers->id])}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')

                </form>
            </div>
        </div>
    </div>
</div>
@endsection