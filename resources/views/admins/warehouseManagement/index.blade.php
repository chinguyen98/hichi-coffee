@extends('layouts.adminManage')

@section('content')

<div class="product-status mg-b-30">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="product-status-wrap">
                    <h4>Danh sách phiếu nhập</h4>
                    <div class="add-product">
                        <a href="{{route('admins.manage.warehouse.create')}}">Nhập kho</a>
                    </div>
                    <table>
                        <tr>
                            <th>Mã hóa đơn</th>
                            <th>Nhà cung cấp</th>
                            <th>Nguời duyệt</th>
                            <th>Ngày nhập kho</th>
                        </tr>
                        @foreach($inputs as $input)

                        <tr>
                            <td>{{$input->id}}</td>
                            <td>{{$input->supplier->name}}</td>
                            <td>{{$input->admin->name}}</td>
                            <td>{{$input->created_at}}</td>
                            <td><a href="{{route('admins.manage.warehouse.renderInputDetailPage', ['id'=>$input->id])}}" data-toggle="tooltip" title="Xem chi tiết" class="btn pd-setting-ed"><i class="fa fa-eye aria-hidden="true"></i></a></td>
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