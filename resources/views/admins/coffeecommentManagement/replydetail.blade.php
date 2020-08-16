@extends('layouts.adminManage')

@section('content')
<div class="product-status mg-b-30">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="product-status-wrap">
                    <h4 style="color: mediumspringgreen;">CHI TIẾT TRẢ LỜI BÌNH LUẬN</h4>


                    <h5 style="color: wheat;">TRẠNG THÁI:<i style="margin-left: 4.5em;">{{$repcomment->status}}</i></h5>
                    <h5 style="color: wheat;">TÊN KHÁCH HÀNG:<i style="margin-left: 22px;">{{$repcomment->customer->name}}</i></h5>
              
                    <h5 style="color: wheat;">NGÀY ĐÁNH GIÁ:<i style="margin-left: 2.5em;">{{$repcomment->created_at}}</i></h5>
                    <h5 style="color: wheat;">NỘI DUNG: <i style="margin-left: 5em;"><span style="color: red;">{{$repcomment->content}}</span></i></h5>
                    <hr style="border: 1px solid springgreen;">
                    <div style="display: flex; justify-content: start;">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <form style="margin-left: 70em;" action="{{route('admins.manage.coffeecomment.browserRep', ['id'=>$repcomment->id])}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('POST')
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="text-center custom-pro-edt-ds">
                                        <input type="submit" class="btn btn-success" value="DUYỆT BÌNH LUẬN">
                                        </input>
                                    </div>
                            </form>
                            <hr style="border: 2px solid brown;">
                            <form action="{{route('admins.manage.coffeecomment.deleteRep', ['id'=>$repcomment->id])}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('POST')
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                                    <div class="text-center custom-pro-edt-ds ">
                                        <input type="submit" class="btn btn-danger" value="XÓA BÌNH LUẬN">
                                        </input>
                                    </div>
                            </form>
                        </div>

                    </div>
                </div>

            </div>
        </div>



    </div>
</div>
</div>
</div>
@endsection