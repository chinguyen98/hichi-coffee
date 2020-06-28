@extends('layouts.adminManage')

@section('content')
<div class="product-status mg-b-30">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="product-status-wrap">
                    <h4>DANH SÁCH ĐƠN HÀNG</h4>
                    <table>
                        <tr>
                            <th>MÃ</th>
                            <th>TÊN KHÁCH HÀNG</th>
                            <th>TỔNG TIỀN</th>
                            <th>NGÀY TẠO</th>

                        </tr>
                        @foreach($orders as $order)

                        <tr>
                            <td>{{$order->id}}</td>
                            <td>{{$order->customer->name}}</td>
                            <td><span class="text-danger"><b>{{number_format($order->total_price)}}</b></span></td>
                            <td>{{date("d/m/Y", strtotime($order->created_at))}}</td>
                            <td><a href="{{route('admins.manage.order.detail', ['id'=>$order->id])}}" data-toggle="tooltip" title="Xem chi tiết" 
                            class="btn pd-setting-ed"><i class="fa fa-eye aria-hidden="true"></i></a></td>
                        </tr>

                        @endforeach
                    </table>
                    <div class="custom-pagination">
                        <ul class="pagination">
                            <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">Next</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection