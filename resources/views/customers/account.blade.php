@extends('layouts.app')

@section('content')

<!-- <section class="home-slider owl-carousel">
    <div class="slider-item" style="background-image: url(/customers/images/bg_1.jpg);" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row slider-text justify-content-center align-items-center">
                <div class="col-md-7 col-sm-12 text-center ftco-animate">
                    <h1 class="mb-3 mt-5 bread">Tài khoản của tôi</h1>
                    <p class="breadcrumbs"><span class="mr-2"><a href="/">Trang chủ</a></span>&nbsp; / &nbsp; <span>Tài khoản của tôi</span></p>
                </div>
            </div>
        </div>
    </div>
</section> -->

<section class="bannerCoffee mt-5">
    <div class="container">
        <div class="row slider-text justify-content-center align-items-center">
            <div class="col-md-7 mt-5 col-sm-12 text-center ftco-animate">
                <h1 class="mb-3 mt-5 bread">TÀI KHOẢN CỦA TÔI</h1>
                <p class="breadcrumbs"><span class="mr-2" style="color: peru; font-size: 20px;"><a href="/"><u>Trang Chủ</u></a></span>&nbsp; / &nbsp; <span style="font-size: 20px; color: white;"><u>Tài Khoản Của Tôi</u></span></p>
            </div>
        </div>
    </div>
</section>
</br>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card customerForm">
                <div class="card-header text-center text-uppercase " style="color: peru;"><b>Thông tin tài khoản</b></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('customers.accounts.update') }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right text-white"> Tên Khách Hàng </label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{Auth::user()->name}}" required autocomplete="name">
                            </div>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right text-white"> Địa Chỉ Email </label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control @error('name') is-invalid @enderror" value="{{Auth::user()->email}}" disabled>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone_number" class="col-md-4 col-form-label text-md-right text-white"> Số Điện Thoại</label>

                            <div class="col-md-6">
                                <input id="phone_number" type="text" class="form-control @error('name') is-invalid @enderror" name="phone_number" value="{{Auth::user()->phone_number}}" {{$haveOrderInProcessing ?  'readonly':''}}>
                            </div>
                            @error('phone_number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="showChangePasswordForm" id="showChangePasswordForm">

                                    <label class="form-check-label" for="showChangePasswordForm" style="color:peru">
                                        Thay Đổi Mật Khẩu
                                    </label>
                                    <div>
                                        @error('oldPassword')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div>
                                        @error('password')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="changePasswordForm d-none">
                            <div class="form-group row">
                                <label for="oldPassword" class="col-md-4 col-form-label text-md-right text-white"> Mật Khẩu Cũ </label>

                                <div class="col-md-6">
                                    <input id="oldPassword" type="password" class="form-control @error('oldPassword') is-invalid @enderror" name="oldPassword">

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right text-white"> Mật Khẩu Mới</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password_confirmation" class="col-md-4 col-form-label text-md-right text-white"> Nhập Lại Mật Khẩu</label>

                                <div class="col-md-6">
                                    <input id="password_confirmation" type="password" class="form-control @error('confirmPassword') is-invalid @enderror" name="password_confirmation">
                                    @error('password_confirmation')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary" style="font-size: 20px;">
                                    CẬP NHẬT
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<br>

@endsection