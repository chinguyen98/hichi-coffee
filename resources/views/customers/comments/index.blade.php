@extends('layouts/app')

@section('content')

<section class="home-slider owl-carousel">
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
</section>

<section class="ftco-menu mb-5">
    <div class="container">
        <h3>Đánh giá của tôi (<span class="commentCount">{{count($comments)}}</span>)</h3>
            @foreach($comments as $comment)

            <div style="background-color: rgba(255, 255, 255, 0.05);" class="p-3 row dmsp-main-container__list d-lg-flex flex-wrap my-4 favoContainer-{{$comment->coffee->id}}">
                <div class="col col-md-2">
                    <a href="/coffees/{{$comment->coffee->slug}}">
                        <img style="width: 100%; height: auto;" src="/apps/images/coffees/{{$comment->coffee->image}}" alt="{{$comment->coffee->image}}">
                    </a>
                </div>
                <div class="col col-md-9">
                    <a href="/coffees/{{$comment->coffee->slug}}">
                        <p>{{$comment->coffee->name}}</p>
                    </a>
                    <span>{{$comment->coffee->brand->name}}</span><br>

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
                    <p>Tiêu đề: {{$comment->title}}</p>
                    <p>Nội dung: {{$comment->content}}</p>
                    <p>Trạng thái: 
                        @if($comment->status==1)

                        <span class="text-success">Đã duyệt</span>

                        @else

                        <span class="text-danger">Đang duyệt</span>

                        @endif
                    </p>
                </div>
                <div class="col col-md-1">
                    <button class='btn btn-danger' onclick="deleteComment({{$comment->id_coffee}})">Xóa</button>
                </div>
            </div>

            @endforeach
    </div>
</section>

@endsection