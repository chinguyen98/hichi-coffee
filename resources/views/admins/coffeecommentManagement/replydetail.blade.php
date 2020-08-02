@extends('layouts.adminManage')

@section('content')
<div class="product-status mg-b-30">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="product-status-wrap">
                    <h4 style="color: mediumspringgreen;">CHI TIẾT TRẢ LỜI BÌNH LUẬN</h4>


                    <h5 style="color: wheat;">MÃ BÌNH LUẬN:<i style="margin-left: 20px;">#{{$repcomment->id}}</i></h5>

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="text-center custom-pro-edt-ds ">
                            <div>
                                <form action="{{route('admins.manage.coffeecomment.browserRep', ['id'=>$repcomment->id])}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('POST')
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="text-center custom-pro-edt-ds">
                                            <input type="submit" class="btn btn-success" value="DUYỆT BÌNH LUẬN">
                                            </input>
                                        </div>
                                </form>
                            </div>
                            <div>
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
    @endsection