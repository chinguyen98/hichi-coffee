@extends('layouts.adminManage')

@section('content')

@if ( Session::has('flash_message') )

@include('inc.admins.messageNotification')

@endif

<div class="single-product-tab-area mg-b-30">
    <div class="single-pro-review-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="review-tab-pro-inner">
                        <div id="myTabContent" class="tab-content custom-product-edit">
                            <div class="product-tab-list tab-pane fade active in" id="description">
                                <form action="{{route('admins.changePassword', ['id'=>$id_admin])}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('POST')
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="review-content-section">
                                                <div class="input-group mg-b-pro-edt">
                                                    <span class="input-group-addon"><i class="icon nalika-edit" aria-hidden="true"></i></span>
                                                    <input name="password_old" type="password" class="form-control" placeholder="Nhập mật khẩu cũ" />
                                                </div>
                                                @error('password_old')
                                                @include('inc.admins.errorNotification')
                                                @enderror
                                                <div class="input-group mg-b-pro-edt">
                                                    <span class="input-group-addon"><i class="icon nalika-edit" aria-hidden="true"></i></span>
                                                    <input name="password" type="password" class="form-control" placeholder="Nhập mật khẩu mới" />
                                                </div>
                                                @error('password')
                                                @include('inc.admins.errorNotification')
                                                @enderror

                                                <div class="input-group mg-b-pro-edt">
                                                    <span class="input-group-addon"><i class="fa fa-hourglass-end" aria-hidden="true"></i></span>
                                                    <input name="password_confirmation" type="password" class="form-control" placeholder="Nhập lại mật khẩu">
                                                </div>

                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="text-center custom-pro-edt-ds">
                                                    <input type="submit" class="btn btn-ctl-bt waves-effect waves-light m-r-10 mr-5 " style="background: green" value="ĐỔI MẬT KHẨU">
                                                    </input>

                                                </div>
                                            </div>
                                        </div>
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

@endsection