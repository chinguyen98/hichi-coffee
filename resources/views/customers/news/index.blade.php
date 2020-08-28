@extends('layouts/app')

@section('content')

<!-- <section class="home-slider owl-carousel">
    <div class="slider-item" style="background-image: url(customers/images/bg_1.jpg);" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row slider-text justify-content-center align-items-center">
                <div class="col-md-7 col-sm-12 text-center ftco-animate">
                    <h1 class="mb-3 mt-5 bread">Tin tức</h1>
                    <p class="breadcrumbs"><span class="mr-2"><a href="/">Trang chủ</a></span>&nbsp; / &nbsp; <span>Tin tức</span></p>
                </div>
            </div>
        </div>
    </div>
</section> -->

<section class="bannerCoffee mt-5">
    <div class="container">
        <div class="row slider-text justify-content-center align-items-center">
            <div class="col-md-7 mt-5 col-sm-12 text-center ftco-animate">
                <h1 class="mb-3 mt-5 bread">TIN TỨC</h1>
                <p class="breadcrumbs"><span class="mr-2"><a href="/" style="font-size: 20px;"><b><u>Trang Chủ</u></b></a></span> / <span class="text-white" style="font-size: 20px;"><b><u>Tin Tức</u></b></span></p>
            </div>
        </div>
    </div>
</section>
</br>

<section class="ftco-about d-md-flex my-5">
    <div class="container">
        @foreach($listOfNews as $new)

        <div class="d-flex flex-row">
            <div class="col col-md-3 "><a href="{{route('customers.news.show', ['slug'=>$new->slug])}}"><img class="newsimage" src="/apps/images/news/{{$new->image}}" alt="" srcset=""></div></a>
            <div class="col col-md-8">
                <div class="title-news">
                    <a href="{{route('customers.news.show', ['slug'=>$new->slug])}}">
                        <h3 style="color: peru; text-transform: uppercase;">{{$new->title}}</h3>
                    </a>
                </div>
                <div class="review-news">
                    <p>{{$new->description}}</p>
                </div>
            </div>
        </div>

        @endforeach
    </div>
</section>

@endsection