@extends('layouts.adminManage')

@section('content')

<div class="product-status mg-b-30">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="product-status-wrap">
                    <h4>Chi tiết phiếu nhập mã: {{$input->id}}</h4>
                    <h4>Nhà cung cấp: {{$input->supplier->name}}</h4>
                    <h4>Người duyệt: {{$input->admin->name}}</h4>
                    <h4>Ngày lập phiếu: {{$input->created_at}}</h4>
                </div>
                <div style="margin-top: 2rem;" class="product-status-wrap">
                    <table>
                        <tr>
                            <th>Mã sản phẩm</th>
                            <th>Tên sản phẩm</th>
                            <th>Số lượng</th>
                        </tr>
                        @foreach($input->input_details as $item)

                        <tr>
                            <td>{{$item->id}}</td>
                            <td>{{$item->coffee->name}}</td>
                            <td>{{$item->input_count}}</td>
                        </tr>

                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection