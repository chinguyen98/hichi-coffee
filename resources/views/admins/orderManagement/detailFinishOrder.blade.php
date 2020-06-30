@extends('layouts.adminManage')

@section('content')

<div class="product-status mg-b-30">
    <div class="container-fluid">
        <div class="row">
            @include('inc.admins.orderStatusDetail')
        </div>
    </div>
</div>

@endsection