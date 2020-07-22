@extends('layouts/app')

@section('content')

<section class="home-slider owl-carousel">
    <div class="slider-item" style="background-image: url(customers/images/bg_3.jpg);" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row slider-text justify-content-center align-items-center">
                <div class="col-md-7 col-sm-12 text-center ftco-animate">
                    <h1 class="mb-3 mt-5 bread">Sản phẩm yêu thích</h1>
                    <p class="breadcrumbs"><span class="mr-2"><a href="/">Trang chủ</a></span> <span>Sản phẩm yêu thích</span></p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="ftco-menu mb-5">
    <div class="container">
        <h3>Danh sách yêu thích ({{count($favorites)}})</h3>
        <div class="dmsp-main-container favoriteListArea">
            @foreach($favorites as $favorite)
            <div class="pt-3 row dmsp-main-container__list d-lg-flex flex-wrap my-4">
                <div class="col col-md-2">
                    <a href="{{route('customer.coffees.show', ['slug'=>$favorite->coffee->slug])}}">
                        <img style="width: 100%; height: auto;" src="/apps/images/coffees/{{$favorite->coffee->image}}" alt="{{$favorite->coffee->image}}">
                    </a>
                </div>
                <div class="col col-md-8">
                    <a href="{{route('customer.coffees.show', ['slug'=>$favorite->coffee->slug])}}">
                        <p>{{$favorite->coffee->name}}</p>
                    </a>
                    <span>{{$favorite->coffee->brand->name}}</span><br>

                    <div data-star="{{$favorite->coffee->avgRating()}}" data-id="{{$favorite->coffee->id}}" class="customRating customerRate">
                        <label class="full" for="sstar5"></label>

                        <label class="half" for="sstar4half"></label>

                        <label class="full" for="sstar4"></label>

                        <label class="half" for="sstar3half"></label>

                        <label class="full" for="sstar3"></label>

                        <label class="half" for="sstar2half"></label>

                        <label class="full" for="star2"></label>

                        <label class="half" for="star1half"></label>

                        <label class="full" for="sstar1"></label>

                        <label class="half" for="sstarhalf"></label>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection