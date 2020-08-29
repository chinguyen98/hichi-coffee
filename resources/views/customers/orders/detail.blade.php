@extends('layouts/app')

@section('content')

<!-- <section class="home-slider owl-carousel">
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
</section> -->

<section class="bannerCoffee mt-5">
    <div class="container">
        <div class="row slider-text justify-content-center align-items-center">
            <div class="col-md-7 mt-5 col-sm-12 text-center ftco-animate">
                <h1 class="mb-3 mt-5 bread" style="text-transform: uppercase;">Chi tiết đơn hàng</h1>
                <p class="breadcrumbs"><span class="mr-2"><a href="/" style="color: peru; font-size: 20px;"><u>Trang Chủ</u></a></span>&nbsp; / &nbsp; <span style="color: white; font-size: 20px;"><u>Chi Tiết Đơn Hàng</u></span></p>
            </div>
        </div>
    </div>
</section>
</br>

<div class="container my-5">
    <div class="row">
        <div class="col col-md-12">
            <div class="d-flex justify-content-around align-items-start">
                <h2><span style="text-transform: uppercase; color: peru;">Chi tiết đơn hàng <span class="text-danger">#{{$order->id}}</span></span> - <b style="text-transform: uppercase;">{{$order->current_status->status->name}}</b></h2>
                @if($order->current_status->status->id==1)

                <form action="{{route('customers.orders.delete', ['id'=>$order->id])}}" method="post">
                    @csrf
                    @method('DELETE')
                    <input style="font-size: 18px;" class="btn btn-danger md-3" type="submit" value="Huỷ Đơn Hàng #{{$order->id}}">
                </form>

                @endif
            </div>
            <h5 class="text-right" style="font-size: 25px;">Ngày đặt hàng: {{$order->created_at}}</h5>

            <div class="border px-3 pt-2 my-3">
                <h3 class="text-danger">Thông Báo</h3>

                @foreach($order->statuses as $status)

                <div class="d-flex justify-content-between {{$status->is_current==1 ? 'text-success':''}}">
                    <p style="font-size: 18px;">{{$status->created_at}}</p>
                    <p style="font-size: 18px;"><i>{{$status->note}}</i></p>
                </div>

                @endforeach

            </div>

            <div class="row my-5">
                <div class="col col-md-4 d-flex flex-column">
                    <h5>Địa Chỉ Người Nhận: </h5>
                    <div class="orderDetail_subItem px-2 pt-3">
                        <h4><b style="color: peru; text-transform: capitalize;">{{Auth::user()->name}}</b></h4>
                        <p class="text-white">Địa Chỉ: {{$order->customer_address}}</p>
                        <p class="text-white">Điện Thoại: {{Auth::user()->phone_number}}</p>
                    </div>
                </div>
                <div class="col col-md-4 d-flex flex-column">
                    <h5>Hình Thức Giao Hàng: </h5>
                    <div class="orderDetail_subItem px-2 pt-3">
                        <p class="text-success" style="text-transform: capitalize; font-size: 18px;"><b>{{$order->shipping_type->name}}</b></p>
                        <p style="color: red;font-size: 18px;">Giá: <b>{{number_format($order->shipping_type->price)}} đ</b></p>
                    </div>
                </div>
                <div class="col col-md-4 d-flex flex-column">
                    <h5>Phí vận chuyển hàng: </h5>
                    <div class="orderDetail_subItem px-2 pt-3">
                        <p class="text-success" style="text-transform: capitalize; font-size: 18px;">Đến {{$order->shipping_address->address}}</p>
                        <p  style="color: red;font-size: 18px;">Giá: <b>{{number_format($order->shipping_address->price)}} đ</b></p>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="orderDetail_table col col-md-12">
                    <tr class="thead-dark text-white text-center">
                        <th class="pl-3">Sản phẩm</th>
                        <th class="text-center">Giá gốc</th>
                        <th class="text-center">Số lượng</th>
                        <th class="text-center">Tổng giảm giá</th>
                        <th class="text-center">Tạm tính</th>
                    </tr>

                    @foreach($order->order_details as $order_detail)

                    <tr>
                        <td>
                            <div class="p-3 d-flex flex-row">
                                <img class="orderDetail_img" src="/apps/images/coffees/{{$order_detail->coffee->image}}" alt="">
                                <div class="ml-4">
                                    <a class="my-2" href="{{route('customer.coffees.show', ['slug'=> $order_detail->coffee->slug])}}">
                                        <p class="text-primary" style="text-transform: capitalize; font-size: 20px;"><b>{{$order_detail->coffee->name}}</b></p>
                                    </a>
                                    <p class="text-white"><b>Hãng:</b> {{$order_detail->coffee->brand->name}}</p>
                                    <p class="text-white"><b>Loại:</b> {{$order_detail->coffee->coffee_type->name}}</p>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex justify-content-center align-items-center">
                                <p class="text-white">{{number_format($order_detail->coffee->price)}} đ</p>
                            </div>
                        </td>
                        <td class="p-3 text-center">
                            <p class="text-white">{{$order_detail->quantity}}</p>
                        </td>
                        <td class="p-2 text-center">
                            @if($order_detail->valuation_detail($order_detail->id_order, $order_detail->id_coffee))

                            <p class="text-white">{{number_format($order_detail->valuation_detail($order_detail->id_order, $order_detail->id_coffee)->valuation->discount * $order_detail->quantity)}} đ</p>

                            @else

                            <p class="text-white">0 đ</p>

                            @endif
                        </td>
                        <td>
                            <div class="d-flex justify-content-center align-items-center">
                                @if($order_detail->valuation_detail($order->id, $order_detail->id_coffee) != null && $order_detail->valuation_detail($order->id, $order_detail->id_coffee)->valuation->bonus_content==null)

                                <p class="text-danger"><b>{{number_format($order_detail->valuation_detail($order->id, $order_detail->id_coffee)->valuation->price * $order_detail->quantity)}} đ</b></p>

                                @else

                                <p class="text-danger"><b>{{number_format($order_detail->coffee->price * $order_detail->quantity)}} đ</b></p>

                                @endif
                            </div>
                        </td>
                    </tr>

                    @endforeach

                </table>
            </div>

            <div class="mt-5 text-right">
                <h4><b>Tạm Tính: </b><span class="ml-2">{{number_format($order->total_price - ($order->shipping_type->price + $order->shipping_address->price))}} đ</span></h4>
                <h4><b>Tổng Phí Vận Chuyển: </b><span class="ml-2">{{number_format($order->shipping_type->price + $order->shipping_address->price)}} đ</span></h4>
                <h2 class="mt-4"><b><U style="color: peru;">TỔNG TIỀN:</U> </b><span class="ml-2 text-danger" style="font-size: 50px;">{{number_format($order->total_price)}} đ</span></h2>
            </div>
        </div>
    </div>
</div>

@endsection