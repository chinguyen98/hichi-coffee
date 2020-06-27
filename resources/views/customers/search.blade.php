@extends('layouts/app')

@section('content')

<section class="home-slider owl-carousel">
    <div class="slider-item" style="background-image: url(customers/images/bg_3.jpg);" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row slider-text justify-content-center align-items-center">

                <div class="col-md-7 col-sm-12 text-center ftco-animate">
                    <h1 class="mb-3 mt-5 bread">Tìm kiếm</h1>
                    <p class="breadcrumbs"><span class="mr-2"><a href="/">Trang chủ</a></span> <span>Tìm kiếm</span></p>
                </div>

            </div>
        </div>
    </div>
</section>

<div class="container my-5">
    <div class="row">
        <div class="col col-md-10 text-center">
            <form id="searchForm" action="{{route('customers.search.index')}}" method="get" onsubmit="return handlingQueryParams()">
                <div class="d-flex justify-content-center align-items-center">
                    <input type="search" name="ca-phe" id="coffeeName" value="{{$coffeeName ?? ''}}">
                    <input type="submit" class="btn btn-primary ml-1" value="Tìm kiếm">
                </div>
            </form>
            <div class="row mt-5 searchResult">
                @if(isset($searchResult) && count($searchResult)>0)

                @foreach($searchResult as $coffee)

                <div class="col col-md-3 my-2">
                    <a href="{{route('customer.coffees.show', ['slug'=>$coffee->slug])}}">
                        <img src="/apps/images/coffees/{{$coffee->image}}" alt="{{$coffee->name}}">
                    </a>
                    <a href="{{route('customer.coffees.show', ['slug'=>$coffee->slug])}}">
                        <div class="row">
                            <div title="{{$coffee->name}}" class="coffeeName col-md-12 text-center text-truncate">
                                {{$coffee->name}}
                            </div>
                        </div>
                    </a>
                    <p>{{number_format($coffee->price)}} VNĐ</p>
                </div>

                @endforeach

                @elseif(isset($searchResult) && count($searchResult)==0)

                <div class="text-center col col-md-12">
                    <h1>Không tìm thấy sản phẩm phù hợp!</h1>
                </div>

                @else

                <div class="col col-md-12">
                    <h1 class="mt-1">Nhập để tìm kiếm</h1>
                </div>

                @endif
            </div>
        </div>
        <div class="col col-md-2">
            <div class="d-flex flex-column align-items-start">
                <h3>Giá</h3>
                <p>Chọn khoảng giá</p>
                <div class="d-flex justify-content-around">
                    <input style="width: 90%;" type="text" name="from">
                    <span class="mx-1"> - </span>
                    <input style="width: 90%;" type="text" name="to">
                </div>
                <input class="btn btn-success mt-2" form="searchForm" type="submit" value="OK">
            </div>
        </div>
    </div>
</div>

@endsection