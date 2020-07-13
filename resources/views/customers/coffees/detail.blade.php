@extends('layouts/app')

@section('content')

<section class="home-slider owl-carousel">
    <div class="slider-item" style="background-image: url(/customers/images/bg_1.jpg);" data-stellar-background-ratio="0.5">
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

<div class="container my-5">
    <div class="row">
        <div class="col col-md-4">
            <img src="/apps/images/coffees/{{$coffee->image}}" class="img-fluid" alt="Responsive image">
        </div>
        <div class="col col-md-8">
            <div>
                <h2>{{$coffee->name}}</h2>
            </div>
            <div>
                @if(count($coffee->valuations)==0)

                <h4 class="text-danger">{{number_format($coffee->price)}} VNĐ</h4>

                @else

                <h4 class="text-danger">{{number_format($coffee->price)}} VNĐ</h4>

                <h3>Khuyến mãi đặc biệt: </h3>

                @foreach($coffee->valuations as $valuation)

                <h4> * Giá chỉ còn <span class="text-danger">{{number_format($valuation->price)}} VNĐ</span> khi mua trên {{$valuation->quantity}} sản phẩm</h4>
                <input name="hidValuation" type="hidden" value="{{$valuation}}">

                @endforeach

                @endif
            </div>

            <div class="my-5">
                <h4>Giá hiện tại: <span class="text-danger oldPrice ml-4">{{number_format($coffee->price)}} </span> <span class="newPrice"></span> <span class="text-danger">VNĐ</span></h4>

                <div class="d-flex flex-row align-items-center">
                    <h5 class="pr-3 pt-2">Số lượng đặt mua: </h5>
                    <span id="btn-quantity-desc" class="quantity-updown text-center">-</span>
                    <input style="width: 4rem;" type="text" name="quantity" class="quantity" value="1" min="1" />
                    <span id="btn-quantity-insc" class="quantity-updown text-center">+</span>
                </div>
                <p><a id="btnAddToCart" class="btn btn-lg btn-primary btn-outline-primary mt-4">THÊM VÀO GIỎ</a></p>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <h1>Có thể bạn đang tìm kiếm?</h1>
        <div class="owl-carousel">
            @foreach($relatedCoffees as $relatedCoffee)

            <div class="dmsp-main-container__item col-sm-12 col col-md-7 pt-3 text-center  d-sm-flex d-lg-flex flex-column justify-content-center align-items-center">
                <a href="{{route('customer.coffees.show', ['slug'=>$relatedCoffee->slug])}}"><img src="/apps/images/coffees/{{$relatedCoffee->image}}" alt=""></a>
                <a href="{{route('customer.coffees.show', ['slug'=>$relatedCoffee->slug])}}">
                    <div class="row">
                        <div title="{{$relatedCoffee->name}}" class="coffeeName mt-3 col-md-12 text-center text-truncate">
                            {{$relatedCoffee->name}}
                        </div>
                    </div>
                </a>
                <span>{{number_format($relatedCoffee->price)}} VND</span>
                <p><a href="{{route('customer.coffees.show', ['slug'=>$relatedCoffee->slug])}}" class="btn btn-primary btn-outline-primary">XEM SẢN PHẨM</a></p>
            </div>

            @endforeach
        </div>
    </div>
    <div class="row mt-5">
        <h1>Thông tin sản phẩm:</h1>
        <div class="text-justify">
            {!!$coffee->info!!}
        </div>
        <input type="hidden" name="hidId" value="{{$coffee->id}}">
    </div>

    <div class="mt-5">
        <h1>Khách hàng nhận xét: </h1>
        <div class="row">
            <div class="col col-md-4">
                <p>Đánh giả trung bình</p>
            </div>
            <div class="col col-md-4">

            </div>
            <div class="col col-md-4 text-center">
                <p>Chia sẻ nhận xét về sản phẩm</p>
                <button class="btn btn-primary writeCommentBtn">Viết nhận xét của bạn</button>
            </div>
        </div>
    </div>

    <div class="mt-5 writeCommentArea">
        <h3 class="text-primary">Gửi nhận xét của bạn:</h3>
        <div class="row">
            <div class="col col-md-6">
                <div class="row">
                    <div class="col col-md-12 d-flex flex-row align-items-center">
                        <div>1. Đánh giá sản phẩm này:</div>
                        <div class="ml-4">
                            <div id="rating">
                                <input type="radio" id="star5" name="rating" value="5" />
                                <label class="full" for="star5" title="Tuyệt vời - 5 sao"></label>

                                <input type="radio" id="star4" name="rating" value="4" />
                                <label class="full" for="star4" title="Tốt - 4 sao"></label>

                                <input type="radio" id="star3" name="rating" value="3" />
                                <label class="full" for="star3" title="Tạm tạm - 3 sao"></label>

                                <input type="radio" id="star2" name="rating" value="2" />
                                <label class="full" for="star2" title="Tệ - 2 sao"></label>

                                <input type="radio" id="star1" name="rating" value="1" />
                                <label class="full" for="star1" title="Không còn gì để nói - 1 sao"></label>
                            </div>
                        </div>
                    </div>
                    <div><p class="text-danger ml-3 rating-err"></p></div>
                    <div class="col col-md-12 my-4">
                        <div>2. Tiêu đề của nhận xét:</div>
                        <input style="width: 100%;" class="mt-3" type="text" name="commentTitle" placeholder="Nhập tiêu đề nhận xét (Không bắt buộc)">
                    </div>
                    <div class="col col-md-12 my-4">
                        <div>3. Viết nhận xét của bạn vào bên dưới:</div>
                        <textarea class="mt-3" name="commentContent" style="width: 100%;" rows="5" placeholder="Nhận xét của bạn về sản phẩm này"></textarea>
                        <div><p class="text-danger commentContent-err"></p></div>
                    </div>
                    <div class="col col-md-12 commentImageArea">
                        <div>4. Thêm hình sản phẩm nếu có (Tối đa 5 hình)</div>
                        <input type="file" name="commentImage" id="commentImage" multiple class="commentImage">
                        <label for="commentImage">Chọn hình</label>
                    </div>
                    <div class="col col-md-12 previewImageArea">
                        
                    </div>
                    <div class="col col-md-12 commentImageArea mt-5">
                        <button style="font-size: 1.2rem;" class="addCommentBtn btn btn-primary">Gửi nhận xét</button>
                    </div>
                </div>
            </div>
            <div class="col col-md-6">
                <div class="row">
                    <div class="col col-md-4">
                        <img width="100%" src="/apps/images/coffees/{{$coffee->image}}" alt="">
                    </div>
                    <div class="col col-md-8">
                        <h4 class="text-primary">{{$coffee->name}}</h4>
                        <h5>Nhãn hiệu: {{$coffee->brand->name}}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection