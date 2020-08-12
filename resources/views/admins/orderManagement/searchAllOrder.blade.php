@extends('layouts.adminManage')

@section('content')
@if ( Session::has('flash_message') )

@include('inc.admins.messageNotification')

@endif

<div class="product-status mg-b-30">
    <div class="container-fluid">
        <form action="{{route('admins.manage.order.search.detail')}}" method="POST">
            @csrf
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="product-status-wrap">
                        <h4 style="color: yellowgreen;">TÌM KIẾM ĐƠN ĐẶT HÀNG</h4>
                        <div style="display: flex; align-items: center;">
                            <h5 style="color: red; display: inline-block;">NHẬP MÃ ĐƠN ĐẶT HÀNG :</h5>
                            <i class="col-lg-3 col-md-12 col-sm-12 col-xs-12"><input name="item" type="text" class="form-control" placeholder="Ví Dụ: 1" /></i>
                            <input type="submit" class="btn btn-ctl-bt waves-effect waves-light m-r-10 mr-5 " style="background: green" value="TÌM">
                            </input>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="text-center custom-pro-edt-ds">

                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection