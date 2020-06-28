@extends('layouts.adminManage')

@section('content')



<div class="single-product-tab-area mg-b-30">
    <!-- Single pro tab review Start-->
    <div class="single-pro-review-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="review-tab-pro-inner">
                        <div id="myTabContent" class="tab-content custom-product-edit">
                            <div class="product-tab-list tab-pane fade active in" id="description">
                                <form action="/admins/manage/coffees" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <div class="review-content-section">
                                                <div class="input-group mg-b-pro-edt">
                                                    <span class="input-group-addon"><i class="icon nalika-edit" aria-hidden="true"></i></span>
                                                    <input name="name" type="text" class="form-control" placeholder="Tên Sản Phẩm" value="{{ old('name') }}">
                                                </div>
                                                @error('name')
                                                @include('inc.admins.errorNotification')
                                                @enderror

                                                <div class="input-group mg-b-pro-edt">
                                                    <span class="input-group-addon"><i class="fa fa-hourglass-end" aria-hidden="true"></i></span>
                                                    <input name="expired" type="text" class="form-control" placeholder="Hạn Sử Dụng" value="{{ old('expired') }}">
                                                </div>
                                                @error('expired')
                                                @include('inc.admins.errorNotification')
                                                @enderror

                                                <div class="input-group mg-b-pro-edt">
                                                    <span class="input-group-addon"><i class="fa fa-coffee" aria-hidden="true"></i></span>
                                                    <select name="id_brand" class="form-control pro-edt-select form-control-primary">
                                                        @foreach($brands as $brand)

                                                        <option value="{{$brand->id}}">{{$brand->name}}</option>

                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="input-group mg-b-pro-edt">
                                                    <span class="input-group-addon"><i class="fa fa-coffee" aria-hidden="true"></i></span>
                                                    <select name="id_unit" class="form-control pro-edt-select form-control-primary">
                                                        @foreach($units as $unit)

                                                        <option value="{{$unit->id}}">{{$unit->name}} ({{$unit->dram}})</option>

                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <div class="review-content-section">
                                                <div class="input-group mg-b-pro-edt">
                                                    <span class="input-group-addon"><i class="fa fa-usd" aria-hidden="true"></i></span>
                                                    <input name="price" type="text" class="form-control" placeholder="Giá" value="{{ old('price') }}">
                                                </div>
                                                @error('price')
                                                @include('inc.admins.errorNotification')
                                                @enderror

                                                <div class="input-group mg-b-pro-edt">
                                                    <span class="input-group-addon"><i class="fa fa-eye" aria-hidden="true"></i></span>
                                                    <select name="status" class="form-control pro-edt-select form-control-primary">
                                                        <option value="1">Hiện Sản Phẩm</option>
                                                        <option value="0">Ẩn Sản Phẩm</option>
                                                    </select>
                                                </div>
                                                <div class="input-group mg-b-pro-edt">
                                                    <span class="input-group-addon"><i class="fa fa-file" aria-hidden="true"></i></span>
                                                    <select name="id_coffee_type" class="form-control pro-edt-select form-control-primary">
                                                        @foreach($coffee_types as $type)

                                                        <option value="{{$type->id}}">{{$type->name}}</option>

                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="review-content-section">
                                                <textarea class="ckeditor" name="info">
                                                {{ old('name') }}
                                                </textarea>
                                            </div>
                                            @error('info')
                                            @include('inc.admins.errorNotification')
                                            @enderror
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="review-content-section text-center">
                                                <img id="previewImg" src="admins/img/temp.jpg" alt="Chưa tải hình lên">
                                                @error('image')
                                                @include('inc.admins.errorNotification')
                                                @enderror
                                                <input name="image" type="file" class="custom-file-input" id="inputGroupFile01" accept=".gif,.jpg,.jpeg,.png">
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="text-center custom-pro-edt-ds">
                                                <input type="submit" class="btn btn-ctl-bt waves-effect waves-light m-r-10 mr-5 " style="background: green" value="TẠO SẢN PHẨM">
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