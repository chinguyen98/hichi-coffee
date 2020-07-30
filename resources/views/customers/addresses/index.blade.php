@extends('layouts.app')

@section('content')

<section class="home-slider owl-carousel">
    <div class="slider-item" style="background-image: url(/customers/images/bg_1.jpg);" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row slider-text justify-content-center align-items-center">
                <div class="col-md-7 col-sm-12 text-center ftco-animate">
                    <h1 class="mb-3 mt-5 bread">Địa chỉ của tôi</h1>
                    <p class="breadcrumbs"><span class="mr-2"><a href="/">Trang chủ</a></span>&nbsp; / &nbsp; <span>Địa chỉ của tôi</span></p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="container my-5">
    <h2>Số địa chỉ</h2>
    <div class="row">
        <a href="{{route('customers.addresses.create')}}" class="col col-md-12">
            <div style="background-color: rgba(255, 255, 255, 0.05); border: 1px dashed white;" class="px-2 py-3 d-flex flex-row justify-content-center">
                <div><span class="text-success">&#43;</span><span class="ml-4 text-success">Thêm địa chỉ mới</span></div>
            </div>
        </a>

        @foreach($customer_addresses as $customer_address)

        <div style="background-color: rgba(255, 255, 255, 0.05);" class="col col-md-12 my-3 px-3 py-1 customerAddress-{{$customer_address->id}}">
            <div class="d-flex flex-row justify-content-between my-2">
                <div>
                    <span class="mr-3">{{Auth::user()->name}}</span>
                    @if($customer_address->is_current==1)

                    <span class="text-success">&#10003;</span>
                    <span class="text-success">Địa chỉ mặc định</span>

                    @endif
                </div>
                <div>
                    <a href="{{route('customers.addresses.show', ['id'=>$customer_address->id])}}" class="text-info">Chỉnh sửa</a>
                    @if($customer_address->is_current==0)

                    <button onclick="deleteAddress('{{$customer_address->id}}')" class="btn btn-danger ml-4">Xóa</button>

                    @endif
                </div>
            </div>
            <span>Địa chỉ: </span><span class="text-primary ml-3">{{$customer_address->full_address}}</span>
        </div>

        @endforeach
    </div>
</section>

<br>

@endsection