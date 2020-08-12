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
        </div>
    </div>
</div>

@endsection