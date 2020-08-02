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
                            <label style="color: red;" for="note"><i><u>Ghi Chú</u></i></label><input style="margin-left: 5px; margin-right: 5px;" type="text" name="note" id="note"><input type="submit" class="btn btn-success" value="GIAO HÀNG THÀNH CÔNG" />
                        </div>
                        <div class="text-center">
                            
                        </div>
                    </form>
                </div>
            </div>

            @include('inc.admins.orderStatusDetail')
        </div>
    </div>
</div>

@endsection