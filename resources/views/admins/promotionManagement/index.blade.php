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
                    <h4 style="color: mediumspringgreen;">DANH SÁCH KHUYẾN MÃI</h4>
                    <div class="add-product">
                        <a href="{{route('admins.manage.promotion.create')}}"><b style="color: mediumspringgreen;">THÊM MỚI</b></a>
                    </div>
                    <table>
                        <tr>
                            <th>MÃ KHUYẾN MÃI</th>
                            <th>SẢN PHẨM</th>
                            @if(Auth::user()->isSuperAdmin())
                            <th style="padding-left: 2em;">MAIL</th>
                            @endif
                            <th>TRẠNG THÁI</th>
                        </tr>
                        @foreach($valuation as $val)

                        <tr>
                            <td>{{$val->id}}</td>
                            <td><a href="{{route('admins.manage.promotion.detail', ['id'=>$val->id])}}">{{$val->coffee->name}}</a></td>

                            @if(Auth::user()->isSuperAdmin())

                            <td>
                                <form action="{{route('admins.manage.promotion.sendInfo',['id'=>$val->id])}}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-success">GỬI MAIL</button>
                                </form>
                            </td>

                            @endif

                            <td>
                                @if($val->expired < now()) <b>Hết hạn</b>
                                    @endif
                            </td>

                            <td>{{$val->status}}</td>
                            <td><a href="{{route('admins.manage.promotion.detail', ['id'=>$val->id])}}" data-toggle="tooltip" title="Xem chi tiết" class="btn pd-setting-ed"><i class="fa fa-eye aria-hidden=" true"></i></a></td>
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