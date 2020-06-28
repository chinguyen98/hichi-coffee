@extends('layouts.adminManage')

@section('content')

<div class="product-status mg-b-30">
    <div class="container-fluid">
        <div class="row">



            @include('inc.admins.orderStatusDetail')
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="product-status-wrap">
                    <a class="btn btn-primary" href="{{route('admins.manage.order.check.index')}}">Quay Lại</a>
                    <form action="{{route('admins.manage.order.receive.update',['id'=>$orderStatus->order->id])}}" method="post">
                        @csrf
                        <label for="note">Ghi chú</label><input type="text" name="note" id="note">
                        <input type="submit" class="btn btn-success text-right" value="Hoàn tất kiểm tra" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection