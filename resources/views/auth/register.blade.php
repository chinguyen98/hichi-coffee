@extends('layouts.app')

@section('content')

<!-- <section class="home-slider owl-carousel">
    <div class="slider-item" style="background-image: url(customers/images/bg_3.jpg);" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row slider-text justify-content-center align-items-center">
                <div class="col-md-8 col-sm-12 text-center ftco-animate">
                    <h1 class="mb-3 mt-5 bread">Đăng ký tài khoản</h1>
                    <p class="breadcrumbs">
                        <span class="mr-2"><a href="/">Trang chủ</a> /
                            <span>Đăng ký tài khoản</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section> -->

<section class="bannerCoffee mt-5">
    <div class="container">
        <div class="row slider-text justify-content-center align-items-center">
            <div class="col-md-7 mt-5 col-sm-12 text-center ftco-animate">
                <h1 class="mb-3 mt-5 bread">ĐĂNG KÝ TÀI KHOẢN</h1>
                <p class="breadcrumbs">
                    <span class="mr-2"><a href="/" style="font-size: 20px;"><u>Trang Chủ</u></a> /
                        <span style="font-size: 20px;"><u>Đăng Ký Tài Khoản</u></span>
                </p>
            </div>
        </div>
    </div>
</section>
</br>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="customerForm card">
                <div class="card-header text-center">
                    <h4 style="color: peru; text-transform: uppercase">Vui lòng điền đầy đủ thông tin bên dưới:</h4>
                    <div class="col-md-12 text-center">
                        <a class="btn btn-link text-success" href="{{route('login')}}" style="font-size: 18px;">
                           <u>Đăng nhập bằng tài khoản có sẳn</u>
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right" style="color: white;">Tên: </label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right" style="color: white;">Địa chỉ email:</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    Địa chỉ email này đã được dùng!
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right" style="color: white;">Mật khẩu:</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right" style="color: white;">Nhập lại mật khẩu:</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">

                            </div>
                        </div>

                        <div class="form-group row">
                            <select name="id_city" class="form-control col-md-8">
                                <!-- Cities -->
                            </select>
                            @error('id_city')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <br>
                            <select name="id_district" class="form-control col-md-8">
                                <option value="-1" selected>Chọn quận/huyện</option>
                                <!-- Districts -->
                            </select>
                            @error('id_district')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <br>
                            <select name="id_ward" class="form-control col-md-8">
                                <option value="-1" selected>Chọn phường/xã</option>
                                <!-- Districts -->
                            </select>
                            @error('id_ward')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right" style="color: white;">Địa chỉ: </label>

                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required autocomplete="address" autofocus>

                                @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone_number" class="col-md-4 col-form-label text-md-right" style="color: white;">Số điện thoại: </label>

                            <div class="col-md-6">
                                <input id="phone_number" type="text" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ old('phone_number') }}" required autocomplete="phone_number" autofocus>

                                @error('phone_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4 pl-5">
                                <button type="submit" class="btn btn-primary" style="font-size: 20px;">
                                    ĐĂNG KÝ
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

<script src="/apps/js/loadAddressInfo.js"></script>
@endsection