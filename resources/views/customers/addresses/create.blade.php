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
                <h1 class="mb-3 mt-5 bread">TẠO ĐỊA CHỈ MỚI</h1>
                <p class="breadcrumbs"><span class="mr-2"><a href="/" style="color: peru; font-size: 20px;"><u>Trang Chủ</u></a></span>&nbsp; / &nbsp;<span class="mr-2"><a href="{{route('customers.addresses.index')}}" style="color: white; font-size: 20px;"><u>Địa Chỉ Của Tôi</u></a></span>&nbsp; / &nbsp; <span style="color: white; font-size: 20px;"><u>Tạo Địa Chỉ Mới</u></span></p>
            </div>
        </div>
    </div>
</section>
</br>

<section class="container my-5">
    <h3 class="text-center mb-4" style="color: peru;">VUI LÒNG NHẬT ĐẦY ĐỦ THÔNG TIN</h3>
    <div class="row d-flex justify-content-center">
        <form class="col col-md-6 cartSelect" action="{{route('customers.addresses.store')}}" method="post">
            @csrf
            <span style="color: peru;">Quận / Huyện:</span> <select class="form-control col-md-12" name="id_district" required></select>
            <span style="color: peru;">Phường / Xã:</span> <select class="form-control col-md-12" name="id_ward" required></select>
            <span style="color: peru;">Địa Chỉ</span> <input class="form-control col-md-12" type="text" name="address" required />
            <span style="color: peru;">Tên Người Nhận:</span> <input class="form-control col-md-12" type="text" name="name" required />
            <span style="color: peru;">Số Điện Thoại:</span> <input class="form-control col-md-12" type="text" name="phone_number" required />
            @error('phone_number')
            <div>
                <span class="text-danger">{{$message}}</span>
            </div>
            @enderror
            <input class="my-3 btn btn-primary" style="font-size: 18px;" type="submit" value="TẠO ĐỊA CHỈ MỚI">
        </form>
    </div>
</section>

@endsection