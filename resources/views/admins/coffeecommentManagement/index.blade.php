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
                    <h4 style="color: darkturquoise;">DANH SÁCH ĐÁNH GIÁ</h4>
                    <table>
                        <tr >
                            <th style="color: darksalmon;">CHẤT LƯỢNG</th>
                            <th style="color: darksalmon;">Mã KHÁCH HÀNG</th>
                            <th style="color: darksalmon;">Tiêu Đề</th>
                        </tr>
                        @foreach($comment as $item)

                        <tr>
                            <td>{{$item->rating}}</td>
                            <td>{{$item->id_customer}}</a></td>
                            <td>{{$item->title}}</td>
                            <td><a href="{{route('admins.manage.coffeecomment.detail', ['id'=>$item->id_coffee . 'a' . $item->id_customer])}}" data-toggle="tooltip" title="Xem chi tiết" class="btn pd-setting-ed"><i class="fa fa-eye aria-hidden=" true"></i></a></td>
                        </tr>
                        @endforeach
                    </table>
                    <hr>
                    <br>
                    <h4 style="color: darkturquoise;">DANH SÁCH PHẢN HỒI ĐÁNH GIÁ</h4>
                    <table>
                        <tr>
                            <th style="color: darksalmon;">MÃ ĐÁNH GIÁ</th>
                            <th style="color: darksalmon;">Mã KHÁCH HÀNG TRẢ LỜI</th>
                            <th style="color: darksalmon;">NỘI DUNG TRẢ LỜI</th>
                        </tr>
                        @foreach($rep_comment as $rep)

                        <tr>
                            <td>{{$rep->id}}</td>
                            <td>{{$rep->id_customer}}</td>
                            <td>{{$rep->content}}</td>
                            <td><a href="{{route('admins.manage.coffeecomment.replyDetail', ['id'=>$rep->id])}}" data-toggle="tooltip" title="Xem chi tiết" class="btn pd-setting-ed"><i class="fa fa-eye aria-hidden=" true"></i></a></td>

                        </tr>
                        @endforeach
                    </table>
                    <div class="custom-pagination">
                        <ul class="pagination">
                            <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">Next</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection