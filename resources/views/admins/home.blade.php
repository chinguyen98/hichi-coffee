@extends('layouts.adminManage')

@section('content')

@if ( Session::has('flash_message') )

@include('inc.admins.messageNotification')

@endif

<div class="product-status mg-b-30">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="product-status-wrap">
                    <div style="margin-left: 9em;">
                        <!--<div class="has-arrow">
                            <img src="/apps/images/icons/order.png" alt="">
                        </div> !-->

                        <h4 style="color: darkturquoise; ">DANH SÁCH <i style="color: mediumspringgreen; margin-left: 5px; margin-right: 5px;">ĐƠN HÀNG</i> CẦN DUYỆT</h4>
                        @if($order_count >0)
                        <div style="display: flex;">
                            <div>
                                <h5 style="color: ghostwhite; display: inline;">HIỆN TẠI ĐANG CÓ: <span style="color: red; margin-left: 5px; margin-right: 5px;"><i style="font-size: 18px;">{{$order_count}}</i></span> ĐƠN HÀNG MỚI</h5>

                            </div>
                            <div style="margin-left: 7.4em;">
                                <a href="{{route('admins.manage.order.check.index')}}"><b style="color: mediumspringgreen;"><i><u>Xem Ngay</u></i></b></a>
                            </div>
                        </div>

                        @endif
                    </div>
                    <br>
                    <hr>
                    <div style="margin-left: 9em;">
                        <h4 style="color: darkturquoise;">DANH SÁCH <i style="color: mediumspringgreen;margin-left: 5px; margin-right: 5px;">BÌNH LUẬN</i> CẦN DUYỆT</h4>
                        @if($comment_count >0)
                        <div style="display: flex;">
                            <div>
                                <h5 style="color: ghostwhite; display: inline;">HIỆN TẠI ĐANG CÓ: <span style="color: red; margin-left: 5px; margin-right: 5px;"><i style="font-size: 18px;">{{$comment_count}}</i></span> BÌNH LUẬN MỚI</h5>

                            </div>
                            <div style="margin-left: 7.4em;">
                                <a href="{{route('admins.manage.coffeecomment.index')}}"><b style="color: mediumspringgreen;"><i><u>Xem Ngay</u></i></b></a>
                            </div>
                        </div>

                        @endif
                    </div>
                    <br>
                    <hr>
                    <div style="margin-left: 9em;">
                        <h4 style="color: darkturquoise;">DANH SÁCH <i style="color: mediumspringgreen; margin-left: 5px; margin-right: 5px;">TRẢ LỜI BÌNH LUẬN</i> CẦN DUYỆT</h4>
                        @if($comment_rep_count >0)
                        <div style="display: flex;">
                            <div>
                                <h5 style="color: ghostwhite; display: inline;">HIỆN TẠI ĐANG CÓ: <span style="color: red; margin-left: 5px; margin-right: 5px;"><i style="font-size: 18px;">{{$comment_rep_count}}</i></span>TRẢ LỜI BÌNH LUẬN MỚI</h5>

                            </div>
                            <div style="margin-left: 50px;">
                                <a href="{{route('admins.manage.coffeecomment.index')}}"><b style="color: mediumspringgreen;"><i><u>Xem Ngay</u></i></b></a>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <div style="margin-top: 2em;" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="income-order-visit-user-area">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <div class="income-dashone-total reso-mg-b-30">
                                    <div class="income-dashone-pro">
                                        <div class="income-rate-total">
                                            <div class="price-nalika-rate">
                                                <h3><span class="counter text-danger">{{number_format($order->totalPrice)}}</span><span style="margin-left: 0.5rem;" class="text-danger">đ</span></h3>
                                            </div>

                                        </div>
                                        <div class="income-range">
                                            <h4 style="color: floralwhite; margin-top: 1em;">Tổng Doanh Thu Tháng {{date('m')}}</h4>
                                            <br>
                                            <p class="progress-bar wow fadeInLeft" data-progress="100%" style="width: 100%;" data-wow-duration="1.5s" data-wow-delay="1.2s"> <span>{{number_format($order->totalPrice)}}</span></p>
                                        </div>

                                        <div class="clear"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <div class="income-dashone-total reso-mg-b-30">
                                    <div class="income-dashone-pro">
                                        <div class="income-rate-total">
                                            <div class="price-nalika-rate">
                                                <h3><span class="counter text-danger">{{$order->sum}} </span></h3>
                                            </div>
                                        </div>
                                        <div class="income-range order-cl">
                                            <h4 style="color: floralwhite; margin-top: 1em;">Tổng Đơn Hàng Tháng {{date('m')}}</4>

                                        </div>
                                        <div class="clear"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <div class="income-dashone-total reso-mg-b-30 res-mg-t-30">
                                    <div class="income-dashone-pro">
                                        <div class="income-rate-total">
                                            <div class="price-nalika-rate">
                                                <h3><span class="counter text-danger">{{$coffees->totalCoffee}}</span></h3>
                                            </div>

                                        </div>
                                        <div class="income-range visitor-cl">
                                            <h4 style="color: floralwhite; margin-top: 1em;">Tổng Sản Phẩm</h4>
                                        </div>
                                        <div class="clear"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <div class="income-dashone-total res-mg-t-30">
                                    <div class="income-dashone-pro">
                                        <div class="income-rate-total">
                                            <div class="price-nalika-rate">
                                                <h3><span class="counter text-danger">{{$coffee_comment->totalComment}}</span></h3>
                                            </div>
                                        </div>
                                        <div class="income-range low-value-cl">
                                            <h4 style="color: floralwhite; margin-top: 1em;">Tổng Đánh Giá Phản Hồi</h4>
                                        </div>
                                        <div class="clear"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- income order visit user End -->
                <div class="dashtwo-order-area mg-tb-30">
                    <div class="container-fluid">
                        <div class="row">

                        </div>
                    </div>
                </div>
                <div class="analytics-sparkle-area">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <div class="analytics-sparkle-line reso-mg-b-30">
                                    <div class="analytics-rounded-content">
                                        <h2 style="color: darkorange">SẢN PHẨM BÁN CHẠY</h2>
                                        @foreach($bestCoffeeSellers as $item)

                                        <h5 style="color: floralwhite;">{{$item->name}}</h5>

                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <div class="analytics-sparkle-line reso-mg-b-30">
                                    <div class="analytics-content">
                                        <h1 class="text-danger">{{$customers->totalCustomer}}</h1>
                                        <h2 class="counter">Khách Hàng</h2>
                                        <div id="sparkline22"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <div class="analytics-sparkle-line reso-mg-b-30 res-mg-t-30">
                                    <div class="analytics-content">
                                        <h1 class="text-danger">{{$new->totalNew}}</h1>
                                        <h2 class="counter">Tin Tức</h2>
                                        <div id="sparkline22"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection