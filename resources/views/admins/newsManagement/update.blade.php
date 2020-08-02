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
                                <form action="{{route('admins.manage.news.update', ['id'=>$new->id])}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="review-content-section">
                                                <div class="input-group mg-b-pro-edt">
                                                    <span class="input-group-addon"><i class="icon nalika-edit" aria-hidden="true"></i></span>
                                                    <input name="title" type="text" class="form-control" placeholder="Tiêu Đề" value="{{$new->title}}">
                                                </div>
                                                @error('title')
                                                @include('inc.admins.errorNotification')

                                                @enderror


                                                <div class="input-group mg-b-pro-edt">
                                                    <span class="input-group-addon"><i class="fa fa-hourglass-end" aria-hidden="true"></i></span>
                                                    <input name="description" type="text" class="form-control" placeholder="Miêu Tả" value="{{$new->description}}">
                                                </div>
                                                @error('descripton')
                                                @include('inc.admins.errorNotification')

                                                @enderror

                                                <div class="input-group mg-b-pro-edt">
                                                    <span class="input-group-addon"><i class="fa fa-eye" aria-hidden="true"></i></span>
                                                    <select name="status" class="form-control pro-edt-select form-control-primary">
                                                        @if($new->status==1)

                                                        <option value="1" selected>Cho Phép Hiển Thị</option>
                                                        <option value="0">Không Cho Phép Hiển Thị</option>

                                                        @else

                                                        <option value="1">Cho Phép Hiển Thị</option>
                                                        <option value="0" selected>Không Cho Phép Hiển Thị</option>

                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="review-content-section">
                                                <textarea class="ckeditor" name="content">
                                                {{ $new->content }}
                                                </textarea>
                                            </div>
                                            @error('content')
                                            @include('inc.admins.errorNotification')

                                            @enderror

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="review-content-section text-center">
                                                <img id="previewImg" src="apps/images/news/{{$new->image}}" alt="Chưa tải hình lên">
                                                @error('image')
                                                @include('inc.admins.errorNotification')

                                                @enderror
                                                <input name="image" type="file" class="custom-file-input" id="inputGroupFile01" accept=".gif,.jpg,.jpeg,.png">
                                                <input name="oldImage" type="hidden" value="{{$new->image}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="text-center custom-pro-edt-ds">
                                            <input type="submit" class="btn btn-success"  value="CẬP NHẬT TIN TỨC">
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