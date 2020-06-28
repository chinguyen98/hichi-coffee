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
                                            <span class="input-group-addon"><i><b style="color:yellowgreen;">CHỌN NHÀ CUNG CẤP</b></i></span>
                                            <select form="formInput" name="id_supplier" class="form-control pro-edt-select form-control-primary">
                                                @foreach($suppliers as $supplier)

                                                <option value="{{$supplier->id}}">{{$supplier->name}}</option>

                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="input-group mg-b-pro-edt">
                                            <span class="input-group-addon"><i class="icon nalika-edit" aria-hidden="true"></i></span>
                                            <input name="searchCoffee" type="text" class="form-control"  placeholder="#Nhập Tên Sản Phẩm Cần Nhập Kho">
                                            <select name="listCoffee" class="form-control pro-edt-select form-control-primary">

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="input-group mg-b-pro-edt">
                                            <span class="input-group-addon"><i style="color:yellowgreen"><b>NHẬP SỐ LƯỢNG</b></i></span>
                                            <input name="capacity" type="text" class="form-control" placeholder="#VD: 10">
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="input-group mg-b-pro-edt">
                                            <button class="addNewInputDetail btn btn-primary"><b>CẬP NHẬT PHIẾU THU</b></button>
                                        </div>
                                    </div>
                                </div>
                                <form method="POST" onsubmit="return checkEmptyInput()" id="formInput" action="{{route('admins.manage.warehouse.store')}}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                            <div class="input-group mg-b-pro-edt">
                                                <span style="color: teal;"><b>MÃ SẢN PHẨM</b></span>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                            <div class="input-group mg-b-pro-edt">
                                                <span style="color: teal;"><b>TÊN SẢN PHẨM</b></span>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                            <div class="input-group mg-b-pro-edt">
                                                <span style="color: teal;"><b>SỐ LƯỢNG</b></span>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div id="inputListContainer">

                                    </div>
                                    <div class="row">
                                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5"></div>
                                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5"></div>
                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                            <div class="input-group mg-b-pro-edt text-center">
                                                <input type="hidden" name="data" value="[]">
                                                <input type="submit" class="btn btn-success" style="font-weight: bold;" value="LƯU PHIẾU THU">
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

<script src="/admins/js/handlingCoffeesInWareHouseSearching.js"></script>

@endsection