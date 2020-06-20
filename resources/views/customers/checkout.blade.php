@extends('layouts/app')

@section('content')

<section class="home-slider owl-carousel">
    <div class="slider-item" style="background-image: url(customers/images/bg_1.jpg);" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row slider-text justify-content-center align-items-center">
                <div class="col-md-7 col-sm-12 text-center ftco-animate">
                    <h1 class="mb-3 mt-5 bread">Thanh toán</h1>
                    <p class="breadcrumbs"><span class="mr-2"><a href="/">Trang chủ</a></span>&nbsp; / &nbsp; <span>Thanh toán</span></p>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="container my-5 text-center">
    <div class="editForm">
        <div class="row justify-content-center">
            <div class="card-body">
                <h1>Kiểm tra đơn hàng của bạn</h1>
                <div class="d-flex flex-row">
                    <div class="col col-md-6 ml-3">
                        <h3>Giỏ hàng của bạn: </h3>
                        <div class="checkout-cart border">

                        </div>
                        <a class="btn btn-primary mt-2" href="/coffees">
                            <h2 class="d-inline">Tiếp tục mua sản phẩm</h2>
                        </a>
                        <a class="btn btn-info mt-2" href="/carts">
                            <h2 class="d-inline">Xem lại chi tiết giỏ hàng</h2>
                        </a>
                    </div>
                    <div class="col col-md-6 ml-3">
                        <h3>Thông tin hoá đơn của bạn: </h3>
                        <div class="checkout-info border">
                            <h3 class="checkout-info__name text-info">{{Auth::user()->name}}</h3>
                            <h5 class="checkout-info__phone text-left ml-2 ">Số điện thoại: {{Auth::user()->phone_number}}</h5>
                            <h5 class="checkout-info__address text-left ml-2 combinedAddress"></h5>
                            <h5 class="checkout-info__address-notify text-danger"></h5>
                            <h5 class="checkout-info__email text-left ml-2 ">Địa chỉ email: {{Auth::user()->email}}</h5>
                        </div>

                        <!-- <button class="btn btn-secondary mt-3 showEditForm">
                            <h3 class="d-inline">Sửa thông tin</h3>
                        </button> -->

                        <div class="border text-left mt-3 ">
                            <h4 class="ml-2">Tạo địa chỉ mới:</h4>
                            <form class="cartSelect ml-5" action="{{route('customers.addresses.store')}}" method="post">
                                @csrf
                                Quận: <select class="form-control col-md-8" name="id_district" required></select>
                                Huyện: <select class="form-control col-md-8" name="id_ward" required></select>
                                Địa chỉ: <input class="form-control col-md-8" type="text" name="address" required />
                                <input class="my-3 btn btn-primary" type="submit" value="Tạo địa chỉ mới">
                            </form>
                        </div>

                        <div class="border text-left mt-3">
                            <h4 class="ml-2">Hình thức thanh toán:</h4>
                            <div>
                                <div class="form-check ml-5">
                                    <input class="form-check-input" type="radio" id="exampleRadios1" value="option1" checked>
                                    <label class="form-check-label" for="exampleRadios1">
                                        <h5>Thanh toán khi nhận hàng</h5>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="border text-left mt-3">
                            <h4 class="ml-2">Hình thức vận chuyển:</h4>
                            <div>

                                @foreach($shipping_infos as $item)

                                @if($loop->index==0)
                                <div class="form-check ml-5">
                                    <input class="form-check-input" type="radio" name="shipping_infos" id="{{$item->id}}" value="{{$item->price}}" checked>
                                    <label class="form-check-label d-flex flex-row justify-content-between" for="exampleRadios1">
                                        <h5>{{$item->name}}</h5>
                                        <p class="text-secondary mr-2">{{number_format($item->price)}} VND</p>
                                    </label>
                                </div>

                                @else

                                <div class="form-check ml-5">
                                    <input class="form-check-input" type="radio" name="shipping_infos" id="{{$item->id}}" value="{{$item->price}}">
                                    <label class="form-check-label d-flex flex-row justify-content-between" for="exampleRadios1">
                                        <h5>{{$item->name}}</h5>
                                        <p class="text-secondary mr-2">{{number_format($item->price)}} VND</p>
                                    </label>
                                </div>

                                @endif

                                @endforeach

                            </div>
                        </div>
                        <div class="border text-left mt-3 p-2">
                            <div class="d-flex flex-row justify-content-between">
                                <p>Tạm tính:</p>
                                <p data-price="0" class="checkout-price"></p>
                            </div>
                            <div class="d-flex flex-row justify-content-between">
                                <p>Phí vận chuyển:</p>
                                <p data-price="0" class="checkout-shipping"></p>
                            </div>
                            <div class="d-flex flex-row justify-content-between">
                                @if($shipping_address != '')

                                <p>Phí vận chuyển đến <span class="checkout-district-label"></span>:</p>
                                <p data-price="{{$shipping_address->price}}" class="checkout-district">{{number_format($shipping_address->price) }} VNĐ</p>

                                @else

                                @endif
                            </div>
                            <div class="border"></div>
                            <div class="d-flex flex-row justify-content-between mt-3">
                                <h3>Thành tiền: </h3>
                                <h2 class="checkout-total-price text-danger"></h2>
                            </div>
                            <h4 class="text-right"><del class="oldPrice"></del> VNĐ</h4>
                        </div>
                    </div>
                    <div>
                        <input type="hidden" name="id_city" value="{{$customer_addresses->id_city}}">
                        <input type="hidden" name="id_district" value="{{$customer_addresses->id_district}}">
                        <input type="hidden" name="id_ward" value="{{$customer_addresses->id_ward}}">
                        <input type="hidden" name="address" value="{{$customer_addresses->address}}">


                        @if($shipping_address!='')

                        <input type="hidden" name="id_shipping_address" value="{{$shipping_address->id_address}}">p>


                        @else

                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection