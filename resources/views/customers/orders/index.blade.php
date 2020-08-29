@extends('layouts/app')

@section('content')

<!-- <section class="home-slider owl-carousel">
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
</section> -->

<section class="bannerCoffee mt-5">
    <div class="container">
        <div class="row slider-text justify-content-center align-items-center">
            <div class="col-md-7 mt-5 col-sm-12 text-center ftco-animate">
                <h1 class="mb-3 mt-5 bread">ĐƠN HÀNG CỦA TÔI</h1>
                <p class="breadcrumbs"><span class="mr-2"><a href="/" style="font-size: 20px;"><u>Trang Chủ</u></a></span>&nbsp; / &nbsp; <span style="font-size: 20px; color: white;"><u>Đơn Hàng Của Tôi</u></span></p>
            </div>
        </div>
    </div>
</section>
</br>

<div class="container my-5">
    <div class="row">

        <h2 style="color: peru;">ĐƠN HÀNG CỦA BẠN</h2>

        @if(count($orders)== 0)

        <div class="col col-md-12 text-center">
            <h1>Bạn chưa có đơn hàng nào!</h1>
            <a class="btn btn-primary" href="{{route('customers.coffees.index')}}">Xem hàng ngay</a>
        </div>

        @else

        <div class="table-responsive">
            <div class="d-flex flex-row justify-content-center align-items-center mb-2">
                <span style="font-size: 1.5rem;" class="text-white mr-2">Tìm kiếm đơn hàng: </span>
                <input form="findOrderForm" type="text" name="id_order" placeholder="Nhập mã đơn hàng">
                <button type="submit" form="findOrderForm" class="btn btn-primary ml-2">Tìm</button>
                <form id="findOrderForm" action="{{route('customers.order.find')}}" method="post">
                    @csrf
                </form>
            </div>
            <table class="orderDetail_table col col-md-12">
                <tr class="text-center" style="color: white;">
                    <th>MÃ ĐƠN HÀNG</th>
                    <th>NGÀY MUA</th>
                    <th>SẢN PHẨM</th>
                    <th class="px-5">TỔNG TIỀN</th>
                    <th class="px-5">TRẠNG THÁI ĐƠN HÀNG</th>
                    <th>TUỲ CHỌN</th>
                </tr>

                @foreach($orders as $order)

                <tr>
                    <td class="text-center" style="color: white;"><b>{{$order->id}}</b></td>
                    <td class="text-center p-3 text-white"><b>{{$order->created_at}}</b></td>
                    <td>
                        @foreach($order->order_details as $order_detail)

                        <div class="d-flex p-1 justify-content-between align-items-center">
                            <a class="my-2" href="{{route('customer.coffees.show', ['slug'=> $order_detail->coffee->slug])}}">
                                <span class="text-primary" style="font-size: 18px;"><b>{{$order_detail->coffee->name}}</b></span>
                            </a>
                            <span class="ml-3 text-success"><b>x{{$order_detail->quantity}}</b></span>
                        </div>

                        @endforeach
                    </td>
                    <td class="text-center text-danger" style="font-size: 18px;"><b>{{number_format($order->total_price)}} đ</b></td>
                    <td class="text-center p-3 text-success" style="font-size: 18px;"><b>{{$order->current_status->status->name}}</b></td>
                    <td class="p-2 text-center">
                        <a class="btn btn-primary" href="{{route('customers.orders.show', ['id'=>$order->id])}}">Xem Đơn Hàng #{{$order->id}}</a>
                        @if($order->current_status->status->id==1)

                        <form action="{{route('customers.orders.delete', ['id'=>$order->id])}}" method="post">
                            @csrf
                            @method('DELETE')
                            <input class="btn btn-danger mt-3" type="submit" value="Huỷ Đơn Hàng #{{$order->id}}">
                        </form>

                        @endif
                    </td>
                </tr>

                @endforeach

            </table>
        </div>

        @endif
    </div>
</div>

@endsection