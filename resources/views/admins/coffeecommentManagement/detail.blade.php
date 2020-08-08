@extends('layouts.adminManage')

@section('content')
<div class="product-status mg-b-30">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <form action="{{route('admins.manage.coffeecomment.browser', ['id'=>$comment->id_coffee . 'a' . $comment->id_customer])}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="product-status-wrap">
                        <h4 style="color: mediumspringgreen;">CHI TIẾT BÌNH LUẬN</h4>
                        <h5 style="color: wheat;">TÊN KHÁCH HÀNG:<i style="margin-left: 20px;">{{$comment->customer->name}}</i></h5>

                        <h5 style="color: wheat;">TÊN SẢN PHẨM:<i style="margin-left: 20px;">{{$comment->coffee->name}}</i></h5>
                        <h5 style="color: wheat;">TRẠNG THÁI:<i style="margin-left: 20px;">{{$comment->status}}</i></h5>
                        <h5 style="color: wheat;">NGÀY BÌNH LUẬN:<i style="margin-left: 20px;">{{date("d/m/Y", strtotime($comment->created_at))}}</i></h5>



                        <div style="margin-top: 2rem;" class="product-status-wrap">
                            <table>
                                <tr>
                                    <th style="color: mediumspringgreen;">TÊN SẢN PHẨM</th>
                                    <th style="color: mediumspringgreen;">TIÊU ĐỀ</th>
                                    <th style="color: mediumspringgreen;">NỘI DUNG</th>
                                    <th style="color: mediumspringgreen;">BÌNH CHỌN</th>

                                </tr>

                                <tr>
                                    <td>{{$comment->coffee->name}}</td>
                                    <td>{{$comment->title}}</td>
                                    <td>{{$comment->content}}</td>
                                    <td>{{$comment->rating}}</td>

                                </tr>

                            </table>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="text-center custom-pro-edt-ds">
                                <input type="submit" class="btn btn-success" value="DUYỆT BÌNH LUẬN">
                                </input>
                            </div>
                        </div>

                </form>
                <form action="{{route('admins.manage.coffeecomment.delete', ['id'=>$comment->id_coffee . 'a' . $comment->id_customer])}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="text-center custom-pro-edt-ds">
                            <input type="submit" class="btn btn-danger" value="XÓA BÌNH LUẬN">
                            </input>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection