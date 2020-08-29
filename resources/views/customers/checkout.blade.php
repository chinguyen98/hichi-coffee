@extends('layouts/app')

@section('content')

<!-- <section class="home-slider owl-carousel">
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
</section> -->

<section class="bannerCoffee mt-5">
    <div class="container">
        <div class="row slider-text justify-content-center align-items-center">
            <div class="col-md-7 mt-5 col-sm-12 text-center ftco-animate">
                <h1 class="mb-3 mt-5 bread">THANH TOÁN</h1>
                <p class="breadcrumbs"><span class="mr-2"><a href="/" style="color: peru; font-size: 20px;"><u>Trang Chủ</u></a></span>&nbsp; / &nbsp; <span style="color: white; font-size: 20px;"><u>Thanh Toán</u></span></p>
            </div>
        </div>
    </div>
</section>
</br>

<div class="container my-5 text-center">
    <div class="editForm">
        <div class="row justify-content-center">
            <div class="card-body">
                <h2 style="color: peru; text-transform: uppercase;">Kiểm tra đơn hàng của bạn</h2>
                <div class="d-flex flex-row">
                    <div class="col col-md-6 ml-3">
                        <h3 style="text-transform: capitalize;">Giỏ hàng của bạn: </h3>
                        <div class="checkout-cart border">

                        </div>
                        <a class="btn btn-info mt-2" href="/coffees">
                            <h4 class="d-inline" style="text-transform: uppercase;">Tiếp tục mua sản phẩm</h4>
                        </a>
                        <a class="btn btn-primary mt-2" href="/carts">
                            <h4 class="d-inline" style="text-transform: uppercase;">Xem lại chi tiết giỏ hàng</h4>
                        </a>
                    </div>
                    <div class="col col-md-6 ml-3">
                        <h3 style="text-transform: capitalize;">Thông tin hoá đơn của bạn: </h3>
                        <div class="checkout-info border">
                            <h3 class="checkout-info__name text-info">{{Auth::user()->name}}</h3>
                            <h5 class="checkout-info__phone text-left ml-2 ">Số điện thoại: {{$customer_address->phone_number}}</h5>

                            @if($customer_address->id_city == 4)

                            <h5 class="checkout-info__address text-left ml-2 combinedAddress">Địa chỉ: {{$customer_address->full_address}}</h5>

                            @else

                            <h5 class="text-danger">Sản phẩm chi giao trong khu vực TPHCM! <br /> Vui lòng nhập địa chỉ khác.</h5>

                            @endif

                            <h5 class="checkout-info__address-notify text-danger"></h5>
                            <h5 class="checkout-info__email text-left ml-2 ">Tên người nhận: {{$customer_address->name}}</h5>
                            <!-- <h5 class="checkout-info__email text-left ml-2 ">Địa chỉ email: {{Auth::user()->email}}</h5> -->
                        </div>

                        @if($have_hcmc_address)

                        <button class="btn btn-primary mt-3 showChangeAddressForm">
                            <h5 class="d-inline " style="text-transform: uppercase;">Thay đổi địa chỉ giao hàng</h5>
                        </button>

                        @endif

                        <button class="btn btn-success mt-3 showCreateAddressFormBtn">
                            <h5 class="d-inline" style="text-transform: uppercase;">Tạo địa chỉ giao hàng mới</h5>
                        </button>

                        <div class="createAddressform border text-left mt-3">
                            <div class="d-flex flex-row justify-content-between align-items-center">
                                <h4 class="ml-2 text-center mt-2 my-4">Tạo địa chỉ giao hàng mới:</h4>
                                <button class="closeCreateAddressFormBtn mr-2">X</button>
                            </div>
                            <form class="cartSelect ml-5" action="{{route('customers.addresses.store')}}" method="post">
                                @csrf
                                Quận / huyện: <select class="form-control col-md-10" name="id_district" required></select>
                                Phường / xã: <select class="form-control col-md-10" name="id_ward" required></select>
                                Địa chỉ: <input class="form-control col-md-10" type="text" name="address" required />
                                Tên người nhận: <input class="form-control col-md-10" type="text" name="name" required />
                                Số điện thoại: <input class="form-control col-md-10" type="text" name="phone_number" required />
                                @error('phone_number')
                                <div>
                                    <span class="text-danger">{{$message}}</span>
                                </div>
                                @enderror
                                <input class="my-3 btn btn-primary" type="submit" value="Tạo địa chỉ mới">
                            </form>
                        </div>

                        @if($have_hcmc_address)

                        <div class="changeAddressForm border text-left mt-2 p-5">
                            <div class="d-flex flex-row justify-content-between align-items-center">
                                <h4 class="text-center my-4">Đổi địa chỉ giao hàng:</h4>
                                <button class="closeChangeAddressFormBtn mr-2">X</button>
                            </div>
                            <form id="submitChange" action="{{route('customers.addresses.changing')}}" method="post">
                                @csrf
                                @method('PUT')
                            </form>
                            <div id="changeAddressFormSubmmit">
                                @foreach($customer_addresses as $address)

                                <div class="changeAddressForm__item mb-2">
                                    <input type="radio" form="submitChange" name="addressOfChanging" value="{{$address->id}}" id="address-{{$address->id}}" {{$address->is_current == 1 ? 'checked' : ''}}>
                                    <label for="address-{{$address->id}}">{{$address->full_address}}</label><br>
                                    <label for="address-{{$address->id}}">{{$address->name}}</label>,
                                    <label for="address-{{$address->id}}">{{$address->phone_number}}</label>
                                </div>

                                <!-- <div data-address="{{$address->id}}" class="changeAddressFormDetail">
                                    <input type="hidden" name="id_city" value="{{$address->id_city}}">
                                    <input type="hidden" name="id_district" value="{{$address->id_district}}">
                                    <input type="hidden" name="id_ward" value="{{$address->id_ward}}">
                                    <input type="hidden" name="address" value="{{$address->address}}">
                                </div> -->

                                @endforeach
                            </div>
                            <input class="btn btn-primary mt-3" form="submitChange" type="submit" value="Thay đổi địa chỉ">
                        </div>

                        @endif

                        <div class="border text-left mt-3">
                            <h5 class="ml-2 mt-2" style="color: peru; text-transform: uppercase;">Hình thức thanh toán:</h5>
                            <div>
                                <div class="form-check ml-5">
                                    <input class="form-check-input" type="radio" id="exampleRadios1" value="option1" checked>
                                    <label class="form-check-label" for="exampleRadios1">
                                        <h5 class="text-success" >Thanh toán khi nhận hàng</h5>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="border text-left mt-3">
                            <h5 class="ml-2 mt-2" style="color: peru; text-transform: uppercase;">Hình thức vận chuyển:</h5>
                            <div>

                                @foreach($shipping_infos as $item)

                                @if($loop->index==0)
                                <div class="form-check ml-5">
                                    <input class="form-check-input" type="radio" name="shipping_infos" id="{{$item->id}}" value="{{$item->price}}" checked>
                                    <label class="form-check-label d-flex flex-row justify-content-between" for="exampleRadios1">
                                        <h5 class="text-success" >{{$item->name}}</h5>
                                        <p class="text-white mr-2">{{number_format($item->price)}} đ</p>
                                    </label>
                                </div>

                                @else

                                <div class="form-check ml-5">
                                    <input class="form-check-input" type="radio" name="shipping_infos" id="{{$item->id}}" value="{{$item->price}}">
                                    <label class="form-check-label d-flex flex-row justify-content-between" for="exampleRadios1">
                                        <h5 class="text-success" >{{$item->name}}</h5>
                                        <p class="text-white mr-2">{{number_format($item->price)}} đ</p>
                                    </label>
                                </div>

                                @endif

                                @endforeach

                            </div>
                        </div>
                        <div class="border text-left mt-3 p-2 text-white">
                            <div class="d-flex flex-row justify-content-between">
                                <p class="text-white"><b>Tạm Tính:</b></p>
                                <p data-price="0" class="checkout-price"></p>
                            </div>
                            <div class="d-flex flex-row justify-content-between">
                                <p class="text-white"><b>Phí vận chuyển:</b></p>
                                <p data-price="0" class="checkout-shipping"></p>
                            </div>
                            <div class="d-flex flex-row justify-content-between">
                                @if($shipping_address != '')

                                <p class="text-white"><b>Phí vận chuyển đến {{$shipping_address->address}}</b>:</p>
                                <p data-price="{{$shipping_address->price}}" class="checkout-district">{{number_format($shipping_address->price) }} đ</p>

                                <!-- <p>Phí vận chuyển đến <span class="checkout-district-label"></span>:</p>
                                <p data-price="{{$shipping_address->price}}" class="checkout-district">{{number_format($shipping_address->price) }} đ</p> -->

                                @else

                                @endif
                            </div>
                            <div class="border"></div>
                            <div class="d-flex flex-row justify-content-between mt-3">
                                <h3 style="color: peru;">THÀNH TIỀN: </h3>
                                <h2 data-totalprice="" class="checkout-total-price text-danger"></h2>
                            </div>
                            <h4 class="text-right"><del class="oldPrice"></del> đ</h4>
                        </div>

                    </div>
                    <div>
                        <input type="hidden" name="id_city" value="{{$customer_address->id_city}}">
                        <input type="hidden" name="id_district" value="{{$customer_address->id_district}}">
                        <input type="hidden" name="id_ward" value="{{$customer_address->id_ward}}">
                        <input type="hidden" name="address" value="{{$customer_address->address}}">
                        <input type="hidden" name="id" value="{{$customer_address->id}}">




                    </div>
                </div>
            </div>
            @if($have_hcmc_address)

            <form action="{{route('customers.orders.store')}}" onsubmit="return handingCheckout()" method="POST">
                @csrf
                <input type="hidden" name="cart" value="">
                <input type="hidden" name="totalPrice" value="">
                <input type="hidden" name="shippingType" value="">

                @if($shipping_address!='')

                <input type="hidden" name="id_shipping_address" value="{{$shipping_address->id_address}}" />

                @endif

                <input name="submitBtn" style="width:10em;height:2em;font-size:3em" class="btn btn-danger my-5" type="submit" value="MUA HÀNG NGAY">
            </form>

            @endif
        </div>
    </div>
</div>


@endsection