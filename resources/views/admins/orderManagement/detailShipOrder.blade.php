@extends('layouts.adminManage')

@section('content')

<div class="product-status mg-b-30">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="product-status-wrap">
                    <form action="{{route('admins.manage.order.finish.update',['id'=>$orderStatus->order->id])}}" method="post">
                        @csrf
                        <div>
                            <label for="note">Ghi chú</label><input type="text" name="note" id="note">
                        </div>
                        <div class="text-center">
                            <input type="submit" class="btn btn-success text-right" value="Giao hàng thành công" />
                        </div>
                    </form>
                </div>
            </div>

            @include('inc.admins.orderStatusDetail')
        </div>
    </div>
</div>

@endsection