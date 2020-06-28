@extends('layouts.adminManage')

@section('content')

<div class="product-status mg-b-30">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="product-status-wrap">
                    <h4 style="color: darkturquoise;">DANH SÁCH PHIẾU NHẬP</h4>
                    <div class="add-product">
                        <a href="{{route('admins.manage.warehouse.create')}}"><b style="color: darkturquoise;">NHẬP KHO</b></a>
                    </div>
                    <table>
                        <tr>
                            <th style="color: lightsalmon;">MÃ HÓA ĐƠN</th>
                            <th style="color: lightsalmon;">NHÀ CUNG CẤP</th>
                            <th style="color: lightsalmon;">QUẢN TRỊ DUYỆT</th>
                            <th style="color: lightsalmon;">NGÀY NHẬP KHO</th>
                        </tr>
                        @foreach($inputs as $input)

                        <tr>
                            <td>{{$input->id}}</td>
                            <td><a href="{{route('admins.manage.warehouse.renderInputDetailPage', ['id'=>$input->id])}}" title="Xem Chi Tiết">{{$input->supplier->name}}</td></a>
                            <td>{{$input->admin->name}}</td>
                            <td>{{date("d/m/Y", strtotime($input->created_at))}}</td>
                            <td><a href="{{route('admins.manage.warehouse.renderInputDetailPage', ['id'=>$input->id])}}" data-toggle="tooltip" title="Xem Chi Tiết" class="btn pd-setting-ed"><i class="fa fa-eye aria-hidden="true"></i></a></td>
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