@extends('layouts/app')

@section('content')

<section class="home-slider owl-carousel">
    <div class="slider-item" style="background-image: url(/customers/images/bg_1.jpg);" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row slider-text justify-content-center align-items-center">
                <div class="col-md-7 col-sm-12 text-center ftco-animate">
                    <h1 class="mb-3 mt-5 bread">Chi tiết đơn hàng</h1>
                    <p class="breadcrumbs"><span class="mr-2"><a href="/">Trang chủ</a></span>&nbsp; / &nbsp; <span>Chi tiết đơn hàng</span></p>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="container my-5">
    <div class="row">
        <div class="col col-md-12">
            <h1>Chi tiết đơn hàng #{{$order->id}} - <b>{{$order->current_status->status->name}}</b></h1>
            <h5 class="text-right">Ngày đặt hàng: {{$order->created_at}}</h5>

            <div class="border px-3 pt-2 my-3">
                <h3>Thông báo</h3>

                @foreach($order->statuses as $status)

                <div class="d-flex justify-content-between {{$status->is_current==1 ? 'text-success':''}}">
                    <p>{{$status->created_at}}</p>
                    <p>{{$status->note}}</p>
                </div>

                @endforeach

            </div>

            <div class="row my-5">
                <div class="col col-md-4 d-flex flex-column">
                    <h5>Địa chỉ người nhận: </h5>
                    <div class="orderDetail_subItem px-2 pt-3">
                        <h4><b>{{Auth::user()->name}}</b></h4>
                        <p>Địa chỉ: {{$order->customer_address}}</p>
                        <p>Điện thoại: {{Auth::user()->phone_number}}</p>
                    </div>
                </div>
                <div class="col col-md-4 d-flex flex-column">
                    <h5>Hình thức giao hàng: </h5>
                    <div class="orderDetail_subItem px-2 pt-3">
                        <p>{{$order->shipping_type->name}}</p>
                        <p>Giá: {{$order->shipping_type->price}}</p>
                    </div>
                </div>
                <div class="col col-md-4 d-flex flex-column">
                    <h5>Phí vận chuyển hàng: </h5>
                    <div class="orderDetail_subItem px-2 pt-3">
                        <p>Đến {{$order->shipping_address->address}}</p>
                        <p>Giá: {{$order->shipping_address->price}}</p>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="orderDetail_table col col-md-12">
                    <tr class="thead-dark">
                        <th>Sản phẩm</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Giảm giá</th>
                        <th>Tạm tính</th>
                    </tr>

                    @foreach($order->order_details as $order_detail)

                    <tr>
                        <td>
                            <div class="p-3 d-flex flex-row">
                                <img class="orderDetail_img" src="/apps/images/coffees/{{$order_detail->coffee->image}}" alt="">
                                <div class="ml-4">
                                    <a class="my-2" href="{{route('customer.coffees.show', ['slug'=> $order_detail->coffee->slug])}}">
                                        <p class="text-primary">{{$order_detail->coffee->name}}</p>
                                    </a>
                                    <p><b>Hãng:</b> {{$order_detail->coffee->brand->name}}</p>
                                    <p><b>Loại:</b> {{$order_detail->coffee->coffee_type->name}}</p>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex justify-content-center align-items-center">
                                <p>{{number_format($order_detail->coffee->price)}} đ</p>
                            </div>
                        </td>
                        <td class="p-3 text-center">
                            <p>{{$order_detail->quantity}}</p>
                        </td>
                        <td class="p-2 text-center">
                            @if($order_detail->valuation_detail($order_detail->id_order, $order_detail->id_coffee))

                            <p>{{number_format($order_detail->valuation_detail($order_detail->id_order, $order_detail->id_coffee)->valuation->price)}} đ</p>

                            @else

                            <p>0 đ</p>

                            @endif
                        </td>
                        <td>
                            <div class="d-flex justify-content-center align-items-center">
                                @if($order_detail->valuation)

                                <p>{{number_format($order_detail->valuation->price)}} đ</p>

                                @else

                                <p>{{number_format($order_detail->coffee->price)}} đ</p>

                                @endif
                            </div>
                        </td>
                    </tr>

                    @endforeach

                </table>
            </div>

            <div class="mt-5 text-right">
                <h4><b>Tạm tính: </b><span class="ml-2">{{number_format($order->total_price - ($order->shipping_type->price + $order->shipping_address->price))}} đ</span></h4>
                <h4><b>Tổng phí vận chuyển: </b><span class="ml-2">{{number_format($order->shipping_type->price + $order->shipping_address->price)}} đ</span></h4>
                <h2 class="mt-4"><b>Tổng tiền: </b><span class="ml-2 text-danger">{{number_format($order->total_price)}} đ</span></h2>
            </div>
        </div>
    </div>
</div>

@endsection