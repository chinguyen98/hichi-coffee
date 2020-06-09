@extends('layouts.adminManage')

@section('content')

<div class="product-status mg-b-30">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="product-status-wrap">
                    <h4>Mã quản trị: {{$admin->id}}</h4>
                    <h4>Tên quản trị: {{$admin->name}}</h4>
                    <h4>Email: {{$admin->email}}</h4>
                    <h4 class="combinedAddress"></h4>
                </div>
                <div style="margin-top: 2rem;" class="product-status-wrap">
                    
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" name="id_city" value="{{$admin->id_city}}">
    <input type="hidden" name="id_district" value="{{$admin->id_district}}">
    <input type="hidden" name="id_ward" value="{{$admin->id_ward}}">
    <input type="hidden" name="address" value="{{$admin->address}}">
</div>

<script src="/apps/js/renderAddress.js"></script>

@endsection