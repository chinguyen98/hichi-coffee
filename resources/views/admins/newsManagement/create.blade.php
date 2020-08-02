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
                                <form action="{{route('admins.manage.news.store')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="review-content-section">
                                                <div class="input-group mg-b-pro-edt">
                                                    <span class="input-group-addon"><i class="icon nalika-edit" aria-hidden="true"></i></span>
                                                    <input name="title" type="text" class="form-control" placeholder="Nhập Tiêu Đề" value="{{ old('title') }}" />
                                                </div>
                                                @error('title')
                                                @include('inc.admins.errorNotification')
                                                @enderror

                                                <div class="input-group mg-b-pro-edt">
                                                    <span class="input-group-addon"><i class="fa fa-hourglass-end" aria-hidden="true"></i></span>
                                                    <input name="description" type="text" class="form-control" placeholder="Nhập Mô Tả" value="{{ old('description') }}">
                                                </div>
                                                @error('description')
                                                @include('inc.admins.errorNotification')
                                                @enderror

                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="review-content-section">
                                                <textarea class="ckeditor" name="content">
                                                {{ old('name') }}
                                                </textarea>
                                            </div>
                                            @error('info')
                                            @include('inc.admins.errorNotification')
                                            @enderror
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="review-content-section text-center">
                                                <img id="previewImg" src="admins/img/temp-new.jpg" alt="Chưa tải hình lên">
                                                @error('image')
                                                @include('inc.admins.errorNotification')
                                                @enderror
                                                <input name="image" type="file" class="custom-file-input" id="inputGroupFile01" accept=".gif,.jpg,.jpeg,.png">
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="text-center custom-pro-edt-ds">
                                                <input type="submit" class="btn btn-ctl-bt waves-effect waves-light m-r-10 mr-5 " style="background: green" value="THÊM TIN MỚI">
                                                </input>
                                                <input type="reset" class="btn btn-ctl-bt waves-effect waves-light" style="background: blue" value="ĐẶT LẠI">
                                                </input>
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

<script>
    CKEDITOR.replace('info');
</script>
<script src="admins/js/changePreviewImage.js"></script>

@endsection
