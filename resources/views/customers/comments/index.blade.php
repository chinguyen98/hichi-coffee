@extends('layouts/app')

@section('content')

<!-- <section class="home-slider owl-carousel">
    <div class="slider-item" style="background-image: url(customers/images/bg_3.jpg);" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row slider-text justify-content-center align-items-center">
                <div class="col-md-7 col-sm-12 text-center ftco-animate">
                    <h1 class="mb-3 mt-5 bread">Đánh giá của tôi</h1>
                    <p class="breadcrumbs"><span class="mr-2"><a href="/">Trang chủ</a></span> <span>Đánh giá của tôi</span></p>
                </div>
            </div>
        </div>
    </div>
</section> -->

<section class="bannerCoffee mt-5">
    <div class="container">
        <div class="row slider-text justify-content-center align-items-center">
            <div class="col-md-7 mt-5 col-sm-12 text-center ftco-animate">
                <h1 class="mb-3 mt-5 bread">ĐÁNH GIÁ CỦA TÔI</h1>
                <p class="breadcrumbs"><span class="mr-2" style="color: peru; font-size: 20px;"><a href="/"><u>Trang Chủ</u></a></span>/<span  style="color: white; font-size: 20px;"><u>Đánh Giá Của Tôi</u></span></p>
            </div>
        </div>
    </div>
</section>
</br>

<section class="ftco-menu mb-5">
    <div class="container">
        <h3 style="color: peru;">ĐÁNH GIÁ CỦA TÔI  <span class="text-danger">(<span class="commentCount text-danger">{{count($comments)}}</span>)</span></h3>
        @foreach($comments as $comment)

        <div style="background-color: rgba(255, 255, 255, 0.05);" class="p-3 row dmsp-main-container__list d-lg-flex flex-wrap my-4 favoContainer-{{$comment->coffee->id}}">
            <div class="col col-md-2">
                <a href="/coffees/{{$comment->coffee->slug}}">
                    <img style="width: 100%; height: auto;" src="/apps/images/coffees/{{$comment->coffee->image}}" alt="{{$comment->coffee->image}}">
                </a>
            </div>
            <div class="col col-md-9">
                <a href="/coffees/{{$comment->coffee->slug}}">
                    <p style="text-transform: uppercase;"><b style="font-size: 20px;">{{$comment->coffee->name}}</b></p>
                </a>
                <span class="text-white">{{$comment->coffee->brand->name}}</span><br>

                <div class="d-flex flex-row align-items-center">
                    <div data-star="{{$comment->rating}}" data-id="{{$comment->coffee->id}}" class="customRating customerRate mr-3">
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
                <p class="text-white">Tiêu Đề: {{$comment->title}}</p>
                <p class="text-white">Nội Dung: {{$comment->content}}</p>
                <p class="text-white">Trạng Thái:
                    @if($comment->status==1)

                    <span class="text-success"><b>Đã Duyệt</b></span>

                    @else

                    <span class="text-danger"><b>Đang Duyệt</b></span>

                    @endif
                </p>
            </div>
            <div class="col col-md-1">
                <button class='btn btn-danger' onclick="deleteComment({{$comment->id_coffee}})">XOÁ</button>
            </div>
        </div>

        @endforeach
    </div>
</section>

@endsection