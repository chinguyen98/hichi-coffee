@extends('layouts.app')

@section('content')

<!-- <section class="home-slider owl-carousel">
    <div class="slider-item" style="background-image: url(/customers/images/bg_1.jpg);" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row slider-text justify-content-center align-items-center">
                <div class="col-md-7 col-sm-12 text-center ftco-animate">
                    <h1 class="mb-3 mt-5 bread">Tạo địa chỉ mới</h1>
                    <p class="breadcrumbs"><span class="mr-2"><a href="/">Trang chủ</a></span>&nbsp; / &nbsp;<span class="mr-2"><a href="{{route('customers.addresses.index')}}">Địa chỉ của tôi</a></span>&nbsp; / &nbsp; <span>Tạo địa chỉ mới</span></p>
                </div>
            </div>
        </div>
    </div>
</section> -->

<section class="bannerCoffee mt-5">
    <div class="container">
        <div class="row slider-text justify-content-center align-items-center">
            <div class="col-md-7 mt-5 col-sm-12 text-center ftco-animate">
                <h1 class="mb-3 mt-5 bread">Tạo địa chỉ mới</h1>
                <p class="breadcrumbs"><span class="mr-2"><a href="/">Trang chủ</a></span>&nbsp; / &nbsp;<span class="mr-2"><a href="{{route('customers.addresses.index')}}">Địa chỉ của tôi</a></span>&nbsp; / &nbsp; <span>Tạo địa chỉ mới</span></p>
            </div>
        </div>
    </div>
</section>
</br>

<section class="container my-5">
    <h3 class="text-center mb-4">Vui lòng nhập đầy đủ thông tin</h3>
    <div class="row d-flex justify-content-center">
        <form class="col col-md-6 cartSelect" action="{{route('customers.addresses.store')}}" method="post">
            @csrf
            Quận / huyện: <select class="form-control col-md-12" name="id_district" required></select>
            Phường / xã: <select class="form-control col-md-12" name="id_ward" required></select>
            Địa chỉ: <input class="form-control col-md-12" type="text" name="address" required />
            Tên người nhận: <input class="form-control col-md-12" type="text" name="name" required />
            Số điện thoại: <input class="form-control col-md-12" type="text" name="phone_number" required />
            @error('phone_number')
            <div>
                <span class="text-danger">{{$message}}</span>
            </div>
            @enderror
            <input class="my-3 btn btn-primary" type="submit" value="Tạo địa chỉ mới">
        </form>
    </div>
</section>

@endsection