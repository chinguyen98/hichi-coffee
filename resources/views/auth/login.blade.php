@extends('layouts/app')

@section('content')

<!-- <section class="home-slider owl-carousel">
    <div class="slider-item" style="background-image: url(customers/images/bg_3.jpg);" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row slider-text justify-content-center align-items-center">
                <div class="col-md-8 col-sm-12 text-center ftco-animate">
                    <h1 class="mb-3 mt-5 bread">Đăng nhập</h1>
                    <p class="breadcrumbs">
                        <span class="mr-2"><a href="/">Trang chủ</a> /
                            <span>Đăng nhập</span>
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
                <h1 class="mb-3 mt-5 bread">Đăng nhập</h1>
                <p class="breadcrumbs">
                    <span class="mr-2"><a href="/">Trang chủ</a> /
                        <span>Đăng nhập</span>
                </p>
            </div>
        </div>
    </div>
</section>
</br>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card customerForm">
                <div class="card-header text-center text-uppercase">Đăng nhập</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right"> Địa chỉ email </label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Mật khẩu</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        Nhớ tài khoản
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" onclick="return setPreviousUrl()" class="btn btn-primary">
                                    Đăng nhập
                                </button>

                                @if (Route::has('password.request'))

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    Quên mật khẩu?
                                </a>

                                @endif
                            </div>
                        </div>

                        <input type="hidden" name="previousUrl" value="">

                        <div class="form-group row mb-0 mt-3">
                            <div class="col-md-12 text-center">
                                <a class="btn btn-link text-success" href="{{route('register')}}">
                                    Chưa có tài khoản? Đăng ký ngay!
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function setPreviousUrl() {
        const url = localStorage.getItem('previousUrl');
        console.log(url)
        document.querySelector('input[name="previousUrl"]').value = url;
        return true;
    }
</script>

<br>
@endsection