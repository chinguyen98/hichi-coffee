@extends('layouts/app')

@section('content')

<section class="home-slider owl-carousel">
    <div class="slider-item" style="background-image: url(/customers/images/bg_1.jpg);" data-stellar-background-ratio="0.5">
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
</section>

<section class="ftco-about d-md-flex my-5">
    <div class="container text-justify">
        <h1 class="text-center mb-3 text-primary">{{$news->title}}</h1>
        <h3 class="text-center mb-5">{{$news->description}}</h3>
        {!!$news->content!!}
    </div>
</section>

@endsection