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
                    <h4 style="color: yellowgreen;">DANH SÁCH SẢN PHẨM</h4>
                    <div class="add-product" >
                        <a href="{{route('admins.manage.coffee.create')}}"><b style="color: yellowgreen;">THÊM SẢN PHẨM</b></a>
                    </div>
                    <table>
                        <tr>
                            <th>ẢNH</th>
                            <th>TÊN SẢN PHẨM</th>
                            <th>TRẠNG THÁI</th>
                            <th>GIÁ</th>
                            <th>SỐ LƯỢNG</th>
                            <th>NHÃN HIỆU</th>
                            <th>LOẠI</th>
                            <th>TÙY CHỌN</th>
                        </tr>
                        @foreach($coffees as $coffee)

                        <tr>
                            <td><img src="/apps/images/coffees/{{$coffee->image}}" alt="" /></td>
                            <td>{{$coffee->name}}</td>
                            <td>
                                @if($coffee->status==1)
                                <button class="ps-setting"><b>Hiển Thị</b></button>
                                @else
                                <button class="ds-setting"><b>Ẩn</b></button>
                                @endif
                            </td>
                            <td>{{$coffee->price}} VNĐ</td>
                            <td>{{$coffee->quantity}}</td>
                            <td>{{$coffee->brand->name}}</td>
                            <td>{{$coffee->coffee_type->name}}</td>
                            <td>
                                <a href="{{route('admins.manage.coffee.renderUpdateCoffeePage', ['id'=>$coffee->id])}}" data-toggle="tooltip" title="Cập Nhật" class="btn pd-setting-ed"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                
                            </td>
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