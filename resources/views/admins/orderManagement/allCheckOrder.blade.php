@extends('layouts.adminManage')

@section('content')
@if ( Session::has('flash_message') )

@include('inc.admins.messageNotification')

@endif

<div class="product-status mg-b-30">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="product-status-wrap">
                    <h4 style="color: yellowgreen;">KIỂM TRA ĐƠN ĐẶT HÀNG</h4>
                    <table>
                        <tr>
                            <th>MÃ ĐƠN HÀNG</th>
                            <th>TÊN KHÁCH HÀNG</th>
                            <th>ĐỊA CHỈ</th>
                            <th>SỐ ĐIỆN THOẠI</th>
                            <th>NGÀY TẠO ĐƠN</th>
                        </tr>
                        @foreach($orderStatuses as $orderStatus)

                        <tr>
                            <td>{{$orderStatus->order->id}}</td>
                            <td><a href="">{{$orderStatus->order->customer->name}}</a></td>
                            <td>{{$orderStatus->order->customer_address}}</td>
                            <td>{{$orderStatus->order->customer->phone_number}}</td>
                            <td>{{date("d/m/Y h:m:s", strtotime($orderStatus->order->created_at))}}</td>
                            <td><a href="{{route('admins.manage.order.check.show', ['id'=>$orderStatus->order->id])}}" data-toggle="tooltip" title="Xem chi tiết" class="btn pd-setting-ed"><i class="fa fa-eye aria-hidden=" true"></i></a></td>
                        </tr>

                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection