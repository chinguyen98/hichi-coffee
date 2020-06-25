@extends('layouts/app')

@section('content')

<section class="home-slider owl-carousel">
    <div class="slider-item" style="background-image: url(/customers/images/bg_1.jpg);" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row slider-text justify-content-center align-items-center">
                <div class="col-md-7 col-sm-12 text-center ftco-animate">
                    <h1 class="mb-3 mt-5 bread">Đơn hàng của tôi</h1>
                    <p class="breadcrumbs"><span class="mr-2"><a href="/">Trang chủ</a></span>&nbsp; / &nbsp; <span>Đơn hàng của tôi</span></p>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="container my-5">
    <div class="row">
        <div class="table-responsive">
            <table class="orderDetail_table">
                <tr>
                    <th>Mã đơn hàng</th>
                    <th>Ngày mua</th>
                    <th>Sản phẩm</th>
                    <th>Tổng tiền</th>
                    <th>Trạng thái đơn hàng</th>
                    <th>Tùy chọn</th>
                </tr>

                @foreach($orders as $order)

                <tr>
                    <td class="text-center"><b>{{$order->id}}</b></td>
                    <td class="text-center p-3"><b>{{$order->created_at}}</b></td>
                    <td>
                        @foreach($order->order_details as $order_detail)

                        <div class="d-flex p-1 justify-content-between align-items-center">
                            <a class="my-2" href="{{route('customer.coffees.show', ['slug'=> $order_detail->coffee->slug])}}">
                                <span class="text-primary">{{$order_detail->coffee->name}}</span>
                            </a>
                            <span class="ml-5 text-success">x{{$order_detail->quantity}}</span>
                        </div>

                        @endforeach
                    </td>
                    <td class="text-center p-3"><b>{{number_format($order->total_price)}} đ</b></td>
                    <td class="text-center p-3"><b>{{$order->current_status->name}}</b></td>
                    <td class="p-2"><a class="btn btn-primary" href="{{route('customers.orders.show', ['id'=>$order->id])}}">Xem đơn hàng #{{$order->id}}</a></td>
                </tr>

                @endforeach

            </table>
        </div>
    </div>
</div>

@endsection