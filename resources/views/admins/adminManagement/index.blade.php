@extends('layouts.adminManage')

@section('content')

<div class="product-status mg-b-30">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="product-status-wrap">
                    <h4>Danh sách phiếu nhập</h4>
                    <div class="add-product">
                        <a href="{{route('admins.register.show')}}">Đăng kí</a>
                    </div>
                    <table>
                        <tr>
                            <th>Mã</th>
                            <th>Tên quản trị</th>
                            <th>Chức vụ</th>
                            <th>Ngày tham gia</th>
                        </tr>
                        @foreach($admins as $admin)

                        <tr>
                            <td>{{$admin->id}}</td>
                            <td>{{$admin->name}}</td>
                            <td>{{$admin->admin_role->name}}</td>
                            <td>{{$admin->created_at}}</td>
                            <td><a href="{{route('admins.renderAdminDetailPage', ['id'=>$admin->id])}}" data-toggle="tooltip" title="Xem chi tiết" class="btn pd-setting-ed"><i class="fa fa-eye aria-hidden=" true"></i></a></td>
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