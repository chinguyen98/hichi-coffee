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
                                <form action="{{route('admins.manage.coffee.update', ['id'=>$coffee->id])}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <div class="review-content-section">
                                                <div class="input-group mg-b-pro-edt">
                                                    <span class="input-group-addon"><i class="icon nalika-edit" aria-hidden="true"></i></span>
                                                    <input name="name" type="text" class="form-control" placeholder="Tên sản phẩm" value="{{$coffee->name}}">
                                                </div>
                                                @error('name')
                                                @include('inc.admins.errorNotification')
                                                @enderror

                                                <div class="input-group mg-b-pro-edt">
                                                    <span class="input-group-addon"><i class="fa fa-hourglass-end" aria-hidden="true"></i></span>
                                                    <input name="expired" type="text" class="form-control" placeholder="Hạn dùng" value="{{ $coffee->expired }}">
                                                </div>
                                                @error('expired')
                                                @include('inc.admins.errorNotification')
                                                @enderror

                                                <div class="input-group mg-b-pro-edt">
                                                    <span class="input-group-addon"><i class="fa fa-coffee" aria-hidden="true"></i></span>
                                                    <select name="id_brand" class="form-control pro-edt-select form-control-primary">
                                                        @foreach($brands as $brand)

                                                        @if($brand->id==$coffee->id_brand)

                                                        <option value="{{$brand->id}}" selected>{{$brand->name}}</option>

                                                        @else

                                                        <option value="{{$brand->id}}">{{$brand->name}}</option>

                                                        @endif

                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <div class="review-content-section">
                                                <div class="input-group mg-b-pro-edt">
                                                    <span class="input-group-addon"><i class="fa fa-usd" aria-hidden="true"></i></span>
                                                    <input name="price" type="text" class="form-control" placeholder="Giá" value="{{ $coffee->price}}">
                                                </div>
                                                @error('price')
                                                @include('inc.admins.errorNotification')
                                                @enderror

                                                <div class="input-group mg-b-pro-edt">
                                                    <span class="input-group-addon"><i class="fa fa-eye" aria-hidden="true"></i></span>
                                                    <select name="status" class="form-control pro-edt-select form-control-primary">
                                                        @if($coffee->status==1)

                                                        <option value="1" selected>Cho phép hiển thị</option>
                                                        <option value="0">Không cho phép hiển thị</option>

                                                        @else

                                                        <option value="1">Cho phép hiển thị</option>
                                                        <option value="0" selected>Không cho phép hiển thị</option>

                                                        @endif
                                                    </select>
                                                </div>
                                                <div class="input-group mg-b-pro-edt">
                                                    <span class="input-group-addon"><i class="fa fa-file" aria-hidden="true"></i></span>
                                                    <select name="id_coffee_type" class="form-control pro-edt-select form-control-primary">
                                                        @foreach($coffee_types as $type)

                                                        @if($type->id==$coffee->id_coffee_type)

                                                        <option value="{{$type->id}}" selected>{{$type->name}}</option>

                                                        @else

                                                        <option value="{{$type->id}}">{{$type->name}}</option>

                                                        @endif

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
                                                {{ $coffee->info }}
                                                </textarea>
                                            </div>
                                            @error('info')
                                            @include('inc.admins.errorNotification')
                                            @enderror
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="review-content-section text-center">
                                                <img id="previewImg" src="apps/images/coffees/{{$coffee->image}}" alt="Chưa tải hình lên">
                                                @error('image')
                                                @include('inc.admins.errorNotification')
                                                @enderror
                                                <input name="image" type="file" class="custom-file-input" id="inputGroupFile01" accept=".gif,.jpg,.jpeg,.png">
                                                <input name="oldImage" type="hidden" value="{{$coffee->image}}">
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="text-center custom-pro-edt-ds">
                                                <input type="submit" class="btn btn-ctl-bt waves-effect waves-light m-r-10 mr-5" value="Chỉnh sửa sản phẩm">
                                                </input>
                                                <input type="reset" class="btn btn-ctl-bt waves-effect waves-light" value="Reset">
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