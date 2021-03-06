@extends('layouts/app')

@section('content')

<!-- <section class="home-slider owl-carousel">
    <div class="slider-item" style="background-image: url(customers/images/bg_3.jpg);" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row slider-text justify-content-center align-items-center">
                <div class="col-md-7 col-sm-12 text-center ftco-animate">
                    <h1 class="mb-3 mt-5 bread">Nhận xét sản phẩm đã mua</h1>
                    <p class="breadcrumbs"><span class="mr-2"><a href="/">Trang chủ</a></span> <span>Nhận xét sản phẩm đã mua</span></p>
                </div>
            </div>
        </div>
    </div>
</section> -->

<br>

<section class="bannerCoffee mt-5">
    <div class="container">
        <div class="row slider-text justify-content-center align-items-center">
            <div class="col-md-7 col-sm-12 text-center ftco-animate">
                <h1 class="mb-3 mt-5 bread">NHẬN XÉT SẢN PHẨM ĐÃ MUA</h1>
                <p class="breadcrumbs"><span class="mr-2"><a href="/" style="color: peru; font-size: 20px;"><u>Trang Chủ</u></a></span>/<span style="color: white; font-size: 20px;"><u>Nhận Xét Sản Phẩm Đã Mua</u></span></p>
            </div>
        </div>
    </div>
</section>
</br>

<section class="ftco-menu">
    <div class="container">
        <h3 style="color: peru;">NHẬN XÉT SẢN PHẨM ĐÃ MUA</h3>
        <div class="dmsp-main-container">
            <div class="pt-3 row dmsp-main-container__list d-lg-flex flex-wrap">
                @foreach($coffees as $coffee)

                <div class="dmsp-main-container__item col-sm-12 col col-md-3 pt-3 text-center  d-sm-flex d-lg-flex flex-column justify-content-center align-items-center">
                    <a href="{{route('customer.coffees.show', ['slug'=>$coffee->slug]) . '#flag'}}"><img src="apps/images/coffees/{{$coffee->image}}" alt=""></a>
                    <a href="{{route('customer.coffees.show', ['slug'=>$coffee->slug]) . '#flag'}}">
                        <div class="row">
                            <div title="{{$coffee->name}}" class="coffeeName mt-3 col-md-12 text-center text-truncate">
                                {{$coffee->name}}
                            </div>
                        </div>
                    </a>

                    <p><a style="font-size: 18px;" href="{{route('customer.coffees.show', ['slug'=>$coffee->slug]) . '#flag'}}" class="btn btn-primary btn-outline-primary">XEM SẢN PHẨM</a></p>
                </div>

                @endforeach
            </div>
        </div>
    </div>
</section>

@endsection