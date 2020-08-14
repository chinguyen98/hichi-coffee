@extends('layouts/app')

@section('content')

<!-- <section class="home-slider owl-carousel">
    <div class="slider-item" style="background-image: url(customers/images/bg_1.jpg);" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row slider-text justify-content-center align-items-center">
                <div class="col-md-7 col-sm-12 text-center ftco-animate">
                    <h1 class="mb-3 mt-5 bread">{{$type->name}}</h1>
                    <p class="breadcrumbs"><span class="mr-2"><a href="/">Trang chủ</a></span> <span class="mr-2">&nbsp; / &nbsp; <a href="/coffees">Sản phẩm</a></span>&nbsp; / &nbsp; <span>{{$type->name}}</span></p>
                </div>
            </div>
        </div>
    </div>
</section> -->

<section class="bannerCoffee mt-5">
    <div class="container">
        <div class="row slider-text justify-content-center align-items-center">
            <div class="col-md-7 mt-5 col-sm-12 text-center ftco-animate">
                <h1 class="mb-3 mt-5 bread">{{$type->name}}</h1>
                <p class="breadcrumbs"><span class="mr-2"><a href="/">Trang chủ</a></span> <span class="mr-2">&nbsp; / &nbsp; <a href="/coffees">Sản phẩm</a></span>&nbsp; / &nbsp; <span>{{$type->name}}</span></p>
            </div>
        </div>
    </div>
</section>
</br>

<div class="dmsp-main-container mt-3">
    <div class="pt-3 dmsp-main-container__list d-lg-flex flex-wrap">

        @foreach($coffees as $coffee)

        <div class="dmsp-main-container__item col-sm-12 col col-md-3 pt-3 text-center  d-sm-flex d-lg-flex flex-column justify-content-center align-items-center">
            @if(count($coffee->valuations)!=0)

            <span style="left: 2.5rem;" class="promotion">Khuyến mãi</span>

            @endif
            <a href="{{route('customer.coffees.show', ['slug'=>$coffee->slug])}}"><img src="apps/images/coffees/{{$coffee->image}}" alt=""></a>
            <a href="{{route('customer.coffees.show', ['slug'=>$coffee->slug])}}">
                <div class="row">
                    <div style="width: 25rem;" title="{{$coffee->name}}" class="coffeeName mt-3 col-md-12 text-center text-truncate">
                        {{$coffee->name}}
                    </div>
                </div>
            </a>
            <span>{{number_format($coffee->price)}} VND</span>
            <p><a href="{{route('customer.coffees.show', ['slug'=>$coffee->slug])}}" class="btn btn-primary btn-outline-primary">XEM SẢN PHẨM</a></p>
        </div>

        @endforeach
    </div>
</div>

@endsection