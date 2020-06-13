@extends('layouts/app')

@section('content')

<section class="home-slider owl-carousel">
    <div class="slider-item" style="background-image: url(customers/images/bg_1.jpg);" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row slider-text justify-content-center align-items-center">
                <div class="col-md-8 col-sm-12 text-center ftco-animate">
                    <h1 class="mb-3 mt-5 bread">{{$coffee->name}}</h1>
                    <p class="breadcrumbs">
                        <span class="mr-2"><a href="/">Trang chủ</a> </span>/
                        <span class="mr-2"><a href="/coffees">Sản phẩm</a></span>/
                        <br><br>
                        <span>{{$coffee->name}}</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection