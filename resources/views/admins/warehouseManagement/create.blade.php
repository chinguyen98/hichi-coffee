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
                                            <span class="input-group-addon">Chọn nhà cung cấp</span>
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
                                            <input name="searchCoffee" type="text" class="form-control" placeholder="Nhập tên sản phẩm cần để nhập kho">
                                            <select name="listCoffee" class="form-control pro-edt-select form-control-primary">

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="input-group mg-b-pro-edt">
                                            <span class="input-group-addon">Chọn số lượng nhập</span>
                                            <input name="capacity" type="text" class="form-control" placeholder="Nhập số lượng cần nhập kho">
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="input-group mg-b-pro-edt">
                                            <button class="addNewInputDetail btn btn-primary">Cập nhật phiếu thu</button>
                                        </div>
                                    </div>
                                </div>
                                <form method="POST" onsubmit="return checkEmptyInput()" id="formInput" action="{{route('admins.manage.warehouse.store')}}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                            <div class="input-group mg-b-pro-edt">
                                                <span style="color: white;">ID</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                            <div class="input-group mg-b-pro-edt">
                                                <span style="color: white;">Tên sản phẩm</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                            <div class="input-group mg-b-pro-edt">
                                                <span style="color: white;">Số lượng</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                            <div class="input-group mg-b-pro-edt">
                                                <span style="color: white;"></span>
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
                                                <input type="submit" class="btn btn-success" value="Lưu phiểu thu">
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

<script src="/admins/js/renderCoffeesInWareHouseSearching.js"></script>

@endsection