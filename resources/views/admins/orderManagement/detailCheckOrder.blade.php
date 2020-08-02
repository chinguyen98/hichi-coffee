@extends('layouts.adminManage')

@section('content')

<div class="product-status mg-b-30">
    <div class="container-fluid">
        <div class="row">

            @include('inc.admins.orderStatusDetail')

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="product-status-wrap">
                
                    <form action="{{route('admins.manage.order.receive.update',['id'=>$orderStatus->order->id])}}" method="post">
                        @csrf
                        <label for="note" style="color: red; margin-right: 5px;"><i><u>Ghi Chú:</u></i></label><input style="margin-right: 5px;" type="text" name="note" id="note">
                        <input type="submit" class="btn btn-success text-right" value="HOÀN TẤT KIỂM TRA" />
                    </form>
                    <div style="margin-left: 66rem;">
                        <form action="{{route('admins.manage.order.check.cancer',['id'=>$orderStatus->order->id])}}" method="post">
                            @csrf
                            @method('POST')
                            <input type="submit" class="btn btn-danger text-right" value="HỦY ĐƠN HÀNG" />
                        </form>
                    </div>

                </div>

            </div>

        </div>
    </div>
</div>

@endsection