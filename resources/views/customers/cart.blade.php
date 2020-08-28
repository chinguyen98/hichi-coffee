@extends('layouts/app')

@section('content')

<!-- <section class="home-slider owl-carousel">
    <div class="slider-item" style="background-image: url(customers/images/bg_1.jpg);" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row slider-text justify-content-center align-items-center">
                <div class="col-md-7 col-sm-12 text-center ftco-animate">
                    <h1 class="mb-3 mt-5 bread">Giỏ hàng</h1>
                    <p class="breadcrumbs"><span class="mr-2"><a href="/">Trang chủ</a></span>&nbsp; / &nbsp; <span>Giỏ hàng</span></p>
                </div>
            </div>
        </div>
    </div>
</section> -->

<section class="bannerCoffee mt-5">
    <div class="container">
        <div class="row slider-text justify-content-center align-items-center">
            <div class="col-md-7 mt-5 col-sm-12 text-center ftco-animate">
                <h1 class="mb-3 mt-5 bread">GIỎ HÀNG</h1>
                <p class="breadcrumbs"><span class="mr-2"><a href="/" style="font-size: 20px;"><u>TRANG CHỦ</u></a></span>&nbsp; / &nbsp; <span style="font-size: 20px; color: white;" ><u>GIỎ HÀNG</u></span></p>
            </div>
        </div>
    </div>
</section>
</br>


<div class="showNoCart mt-5 text-center">
    
</div>

<div class="ml-5 my-2 d-flex flex-sm-column flex-md-row justify-content-center">
    <div class="row">
        <div class=" cart-container col col-md-8">
            <div id="cart-component" class="col col-md-10 d-flex flex-column border">

            </div>
            <div class="hidValuationArea"></div>
        </div>
        <div class=" total-sum-container col col-md-4 text-center d-flex flex-column justify-content-center align-items-center">
            <h2>Thành Tiền: </h2>
            <h1 class="total-price text-danger border p-3">0 đ</h1>
            <a class="btn btn-danger mt-5" href="{{route('customers.checkout.show')}}"><span class="btnDatHang">TIẾN HÀNH ĐẶT HÀNG</span></a>
        </div>
    </div>
</div>

@endsection