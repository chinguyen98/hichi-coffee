@extends('layouts.adminManage')

@section('content')

<div class="product-status mg-b-30">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="product-status-wrap">
                    <h4>Danh sách sản phẩm</h4>
                    <div class="add-product">
                        <a href="{{route('admins.manage.coffee.create')}}">Thêm sản phẩm</a>
                    </div>
                    <table>
                        <tr>
                            <th>Hình ảnh</th>
                            <th>Tên sản phẩm</th>
                            <th>Trạng thái</th>
                            <th>Giá</th>
                            <th>Số lượng</th>
                            <th>Nhãn hiệu</th>
                            <th>Loại</th>
                            <th>Tùy chọn</th>
                        </tr>
                        @foreach($coffees as $coffee)

                        <tr>
                            <td><img src="/apps/images/coffees/{{$coffee->image}}" alt="" /></td>
                            <td>{{$coffee->name}}</td>
                            <td>
                                @if($coffee->status==1)
                                <button class="ps-setting">Hiển thị</button>
                                @else
                                <button class="ds-setting">Ẩn</button>
                                @endif
                            </td>
                            <td>{{$coffee->price}} VNĐ</td>
                            <td>{{$coffee->quantity}}</td>
                            <td>{{$coffee->brand->name}}</td>
                            <td>{{$coffee->coffee_type->name}}</td>
                            <td>
                                <a href="{{route('admins.manage.coffee.renderUpdatePage', ['id'=>$coffee->id])}}" data-toggle="tooltip" title="Sửa" class="btn pd-setting-ed"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                <a data-toggle="tooltip" title="Xóa" class="btn pd-setting-ed"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
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