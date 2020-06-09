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
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="input-group mg-b-pro-edt">
                                            <span class="input-group-addon"><i class="icon nalika-edit" aria-hidden="true"></i></span>
                                            <input name="searchCoffee" type="text" class="form-control" placeholder="Nhập tên sản phẩm cần để nhập kho">
                                            <select name="id_coffee" class="form-control pro-edt-select form-control-primary">

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="input-group mg-b-pro-edt">
                                            <span class="input-group-addon">Ngày hết hạn</span>
                                            <input name="expired" type="date" class="form-control" value="{{date('Y-m-d')}}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="input-group mg-b-pro-edt">
                                            <span class="input-group-addon">Giá gốc</span>
                                            <input style="background-color: #152036;" name="oldPrice" type="text" class="form-control" disabled>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="input-group mg-b-pro-edt">
                                            <span class="input-group-addon">Khuyến mãi (%)</span>
                                            <input style="background-color: #152036;" name="discount" type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="input-group mg-b-pro-edt">
                                            <span class="input-group-addon">Giá khuyến mãi</span>
                                            <input style="background-color: #152036;" name="price" type="text" class="form-control" disabled>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="input-group mg-b-pro-edt">
                                            <span class="input-group-addon">Mức khuyến mãi</span>
                                            <span class="input-group-addon">Từ</span><input type="number" class="form-control" name="min" id="min" min="1" max="">
                                            <span class="input-group-addon">đến</span><input type="number" class="form-control" name="max" id="max" min="1" max="">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="input-group mg-b-pro-edt">
                                            <button class="checkMinMaxBtn text-danger form-control btn btn-danger">Kiểm tra</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="/admins/js/handlingCoffeesInPromotion.js"></script>

@endsection