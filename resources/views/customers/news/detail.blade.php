@extends('layouts/app')

@section('content')

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
    <div class="container text-justify">
        <h1 class="text-center mb-3 text-primary" >{{$news->title}}</h1>
        <h3 class="text-center mb-5" style="color: peru;">{{$news->description}}</h3>
        <span style="color: wheat; font-size: 18px;">{!!$news->content!!}</span>
    </div>
</section>

@endsection