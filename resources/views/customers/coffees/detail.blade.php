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
                <div class="d-flex flex-row align-items-center ">
                    <p><a id="btnAddToCart" class="btn btn-lg btn-primary btn-outline-primary mt-4">THÊM VÀO GIỎ</a></p>
                    @guest
                    @else

                    <button class="favorite"><span class="{{$coffee->haveFavorite(Auth::user()->id) ? 'text-danger' : ''}} ml-3" style="font-size: 3rem;">&hearts;</span></button>

                    @endguest
                </div>
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
        <div id="flag" class="mb-5"></div>
    </div>

    <div class="mt-5">
        <h1>Khách hàng nhận xét: </h1>
        <div class="row">
            <div class="col col-md-4 text-center d-flex flex-column justify-content-center align-items-center">
                <h3>Đánh giá trung bình</h3>
                <h1 class="text-danger">{{explode('.', $coffee->avgRating())[1]=='0' ? number_format($coffee->avgRating()) : $coffee->avgRating()}}/5</h1>
                <div class="customRating loadAvg">
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
                <input type="hidden" name="avgRating" value="{{$coffee->avgRating()}}">
                <p>({{$coffee->countRating()}} nhận xét)</p>
            </div>
            <div class="col col-md-4">
                <div class="d-flex flex-column row">
                    <div class="d-flex flex-row align-items-center">
                        <span>5</span>
                        <div class="customRating mr-2">
                            <label class="customRating-checked"></label>
                        </div>
                        <div class="progress" style="width: 100%; background-color: rgba(255, 255, 255, 0.05);">
                            <div class="progress-bar bg-success" role="progressbar" style="width: {{$coffee->starPercent(5)}}%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="ml-2">
                            {{$coffee->starPercent(5)==''?'0':$coffee->starPercent(5)}}%
                        </div>
                    </div>
                    <div class="d-flex flex-row align-items-center">
                        <span>4</span>
                        <div class="customRating mr-2">
                            <label class="customRating-checked"></label>
                        </div>
                        <div class="progress" style="width: 100%; background-color: rgba(255, 255, 255, 0.05);">
                            <div class="progress-bar bg-info " role="progressbar" style="width: {{$coffee->starPercent(4)}}%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="ml-2">
                            {{$coffee->starPercent(4)==''?'0':$coffee->starPercent(4)}}%
                        </div>
                    </div>
                    <div class="d-flex flex-row align-items-center justify-content-around">
                        <span>3</span>
                        <div class="customRating mr-2">
                            <label class="customRating-checked"></label>
                        </div>
                        <div class="progress" style="width: 100%; background-color: rgba(255, 255, 255, 0.05);">
                            <div class="progress-bar " role="progressbar" style="width: {{$coffee->starPercent(3)}}%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="ml-2">
                            {{$coffee->starPercent(3)==''?'0':$coffee->starPercent(3)}}%
                        </div>
                    </div>
                    <div class="d-flex flex-row align-items-center">
                        <span>2</span>
                        <div class="customRating mr-2">
                            <label class="customRating-checked"></label>
                        </div>
                        <div class="progress" style="width: 100%; background-color: rgba(255, 255, 255, 0.05);">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: {{$coffee->starPercent(2)}}%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="ml-2">
                            {{$coffee->starPercent(2)==''?'0':$coffee->starPercent(2)}}%
                        </div>
                    </div>
                    <div class="d-flex flex-row align-items-center">
                        <span>1</span>
                        <div class="customRating mr-2">
                            <label class="customRating-checked"></label>
                        </div>
                        <div class="progress" style="width: 100%; background-color: rgba(255, 255, 255, 0.05);">
                            <div class="progress-bar bg-danger " role="progressbar" style="width: {{$coffee->starPercent(1)}}%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="ml-2">
                            {{$coffee->starPercent(1)==''?'0':$coffee->starPercent(1)}}%
                        </div>
                    </div>
                </div>
            </div>
            <div class="col col-md-4 text-center">
                @guest

                <h3 class="text-danger">Bạn cần đăng nhập để đánh giá sản phẩm này</h3>
                <a href="{{route('login')}}" onclick="return setPreviousUrl()" class="btn btn-primary mt-2">Đăng nhập ngay!</a>

                @else

                @if(!$coffee->haveComment(Auth::user()->id))

                <div class="writeYourComment">
                    <p>Chia sẻ nhận xét về sản phẩm</p>

                    <button class="btn btn-primary writeCommentBtn">Viết nhận xét của bạn</button>
                </div>

                @else
                <div class="writeYourComment">
                    <h1 class="text-danger">Bạn đã đánh giá sản phẩm này</h1>
                    <button class="btn btn-primary writeCommentBtn">Đánh giá lại</button>
                </div>

                @endif

                @endguest
            </div>
        </div>
    </div>

    @guest

    @else

    <div class="mt-5 writeCommentArea d-none">
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
                    <div>
                        <p class="text-danger ml-3 rating-err"></p>
                    </div>
                    <div class="col col-md-12 mb-4">
                        <div>2. Tiêu đề của nhận xét:</div>
                        <input style="width: 100%;" class="mt-3" type="text" name="commentTitle" placeholder="Nhập tiêu đề nhận xét (Không bắt buộc)">
                    </div>
                    <div class="col col-md-12 mb-4">
                        <div>3. Viết nhận xét của bạn vào bên dưới:</div>
                        <textarea class="mt-3" name="commentContent" style="width: 100%;" rows="5" placeholder="Nhận xét của bạn về sản phẩm này"></textarea>
                        <div>
                            <p class="text-danger commentContent-err"></p>
                        </div>
                    </div>
                    <div class="col col-md-12 commentImageArea">
                        <div>4. Thêm hình sản phẩm nếu có (Tối đa 5 hình)</div>
                        <input type="file" name="commentImage" id="commentImage" multiple class="commentImage">
                        <label for="commentImage">Chọn hình</label>
                        <div>
                            <p class="text-danger mt-2 commentImage-err"></p>
                        </div>
                    </div>
                    <div class="col col-md-12 previewImageArea">

                    </div>
                    <div class="col col-md-12 commentImageArea mt-3">
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
            <div>
                <input type="hidden" name="commentCoffeeId" value="{{$coffee->id}}">
            </div>
        </div>
    </div>

    @endguest

    <div class="mt-5">
        @if(count($coffee->coffee_comments)>0)

        @foreach($coffee->coffee_comments as $coffee_comment)

        <div class="mb-5 px-4" style="border-left: 2px solid #c49b63;">
            <h4 class="mt-5">{{$coffee_comment->customer->name}}</h4>
            <h5 class="text-info">{{$coffee_comment->updated_at}}</h5>
            <div class="d-flex align-items-center">
                <div data-id="{{$coffee_comment->id}}" data-star="{{$coffee_comment->rating}}" class="customRating customerRate">
                    <label class="full" for="ssstar5"></label>

                    <label class="half" for="ssstar4half"></label>

                    <label class="full" for="ssstar4"></label>

                    <label class="half" for="ssstar3half"></label>

                    <label class="full" for="ssstar3"></label>

                    <label class="half" for="ssstar2half"></label>

                    <label class="full" for="sstar2"></label>

                    <label class="half" for="sstar1half"></label>

                    <label class="full" for="ssstar1"></label>

                    <label class="half" for="ssstarhalf"></label>
                </div>
                <div class="ml-3">
                    <h5 class="mt-1 text-secondary">{{$coffee_comment->title}}</h5>
                </div>
            </div>
            <p class="text-justify">{{$coffee_comment->content}}</p>
            <div>
                @if(count($coffee_comment->images)>0)

                @foreach($coffee_comment->images as $image)

                <img class="mr-3" src="/apps/images/comments/{{$image->name}}" alt="">

                @endforeach

                @endif
            </div>
            <div class="mt-3">
                <span>
                    <a style="cursor: pointer; display: inline; user-select: none;" class="replyBtn">
                        <h5 style="display: inline;" class="text-info" data-id="{{$coffee_comment->id}}">Trả lời</h5>
                    </a>
                </span>

                <span class="thankArea-{{$coffee_comment->id}}">
                    @guest

                    @else

                    @if($coffee_comment->isLike(Auth::user()->id))

                    <span class="pl-4 pr-1 text-success">Bạn và {{$coffee_comment->coffee_comment_likes_count($coffee_comment->id)}} người khác đã cảm ơn nhận xét này</span>

                    @else

                    <span onclick="addThankForComment(`{{$coffee_comment->id}}`)">
                        <span class="pl-4 pr-1">Nhận xét này hữu ích với bạn?</span>
                        <span>
                            <button class="btn btn-primary">Cảm ơn</button>
                        </span>
                    </span>

                    @endif

                    @endguest
                </span>
            </div>

            <div class="replyArea-{{$coffee_comment->id}} d-none">
                @guest

                <span class="text-danger">Bạn cần đăng nhập để bình luận</span>
                <a href="{{route('login')}}" onclick="return setPreviousUrl()" class="btn btn-primary ml-3 mt-2">Đăng nhập ngay!</a>

                @else

                <textarea name="replyContent" style="width: 100%;" rows="4" placeholder="Nhập nội dung trả lời tại đây. Tối đa 1500 từ" class="replyContent-{{$coffee_comment->id}}"></textarea>
                <span class="ml-3 replyContent-err-{{$coffee_comment->id}}"></span>
                <div class="d-flex">
                    <button class="btn btn-primary px-3 py-2 sendReplyBtn" data-id="{{$coffee_comment->id}}">Gửi</button>
                    <button class="btn btn-secondary px-3 py-2 ml-2 replyCloseBtn" data-id="{{$coffee_comment->id}}">Hủy bỏ</button>
                </div>

                @endguest
            </div>

            <div class="allReplyCommentArea-{{$coffee_comment->id}} pl-5 mt-3">
                @foreach($coffee_comment->coffee_comment_replys as $index=>$coffee_comment_reply)

                @if($index == 2)
                <button onclick="viewMoreReplyComment(`{{$coffee_comment->id}}`)" class="btn btn-success viewMoreReplyCommentBtn-{{$coffee_comment->id}}">Xem thêm</button>
                @break

                @else

                <div class="mb-3 text-justify">
                    <h4>{{$coffee_comment_reply->customer->name}}</h4>
                    <p>{{$coffee_comment_reply->content}}</p>
                </div>

                @endif

                @endforeach
            </div>
        </div>

        @endforeach

        @endif
    </div>
</div>

@endsection