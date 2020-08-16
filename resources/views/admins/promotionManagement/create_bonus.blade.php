@extends('layouts.adminManage')

@section('content')

@if ( Session::has('flash_message') )

@include('inc.admins.messageNotification')

@endif

<div class="single-product-tab-area mg-b-30">
    <!-- Single pro tab review Start-->
    <div class="single-pro-review-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="review-tab-pro-inner">
                        <div id="myTabContent" class="tab-content custom-product-edit">
                            <div class="product-tab-list tab-pane fade active in" id="description">
                                <form action="{{route('admins.manage.bonus_content.store')}}" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="input-group mg-b-pro-edt">
                                                <span class="input-group-addon"><i class="icon nalika-edit" aria-hidden="true"></i></span>
                                                <input name="searchCoffee" type="text" class="form-control" placeholder="Nhập tên sản phẩm cần khuyến mãi">
                                                <select name="id_coffee" class="form-control pro-edt-select form-control-primary">

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                            <div class="input-group mg-b-pro-edt">
                                                <span class="input-group-addon"><b>Ngày Hết Hạn </b></span>
                                                <input name="expired" type="date" class="form-control" value="{{date('Y-m-d')}}">
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                            <div class="input-group mg-b-pro-edt">
                                                <span class="input-group-addon"><b>Tiêu đề</b></span>
                                                <input name="bonus_content" type="text" class="form-control" placeholder="Nhập tiêu đề tặng kèm" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="text-center custom-pro-edt-ds">
                                                <input type="submit" class="btn btn-ctl-bt waves-effect waves-light m-r-10 mr-5 " style="background: green" value="TẠO KHUYẾN MÃI">
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
<!--<input type="submit" value="TẠO KHUYẾN MÃI" class="checkMinMaxBtn text-danger form-control" style="background: green;" />  !-->
<script src="/admins/js/handlingCoffeesInPromotion.js"></script>

@endsection