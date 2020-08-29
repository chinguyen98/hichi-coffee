@extends('layouts/app')

@section('content')

<!-- <section class="home-slider owl-carousel">
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
</section> -->

<section class="bannerCoffee mt-5">
    <div class="container">
        <div class="row slider-text justify-content-center align-items-center">
            <div class="col-md-7 mt-5 col-sm-12 text-center ftco-animate">
                <h1 class="mb-3 mt-5 bread">SẢN PHẨM YÊU THÍCH</h1>
                <p class="breadcrumbs"><span class="mr-2"><a href="/" style="color: peru; font-size: 20px;"><u>Trang Chủ</u></a></span>/<span><u style="color: white; font-size: 20px;">Sản Phẩm Yêu Thích</u></span></p>
            </div>
        </div>
    </div>
</section>
</br>

<section class="ftco-menu mb-5">
    <div class="container">
        <h3 style="color: peru;">DANH SÁCH SẢN PHẨM YÊU THÍCH <span class="text-danger">(<span class="favoriteCount text-danger"></span>)</span></h3>
        <div class="dmsp-main-container favoriteListArea">
            <!-- From Api -->
        </div>
    </div>
</section>

@endsection