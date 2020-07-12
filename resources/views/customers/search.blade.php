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
        <div class="col col-md-12">
            <form id="searchForm" action="{{route('customers.search.index')}}" method="get" onsubmit="return handlingQueryParams()">

                <div class="d-flex flex-column">
                    <div class="d-flex flex-row justify-content-center">
                        <input type="search" name="ca-phe" id="coffeeName" value="{{$coffeeName ?? ''}}">
                        <input type="submit" class="btn btn-primary ml-3" value="Tìm kiếm">
                    </div>

                    <div class="d-flex flex-row justify-content-center align-items-center">
                        <div class="d-flex mt-4">
                            <label class="text-white mr-4" for="sort">
                                <h4>Lọc: </h4>
                            </label>
                            <select class="mb-3" form="searchForm" name="sortTitle" id="sort">
                                <option value="name">Tên sản phẩm</option>
                                <option value="price">Giá</option>
                            </select>
                            <select class="mb-3 ml-3" form="searchForm" name="sortValue" id="sort">
                                <option value="asc">Tăng dần</option>
                                <option value="desc">Giảm dần</option>
                            </select>
                        </div>
                        <button class="moreFilterBtn btn btn-secondary mt-2 ml-5">Lọc nâng cao</button>
                    </div>

                    <div class="moreFilter d-none row mt-3">
                        <div class="col col-md-4">
                            <h3>Giá</h3>
                            <p>Chọn khoảng giá</p>
                            <div class="d-flex justify-content-around">
                                <input data-price="" style="width: 90%;" type="text" name="from">
                                <span class="mx-1"> - </span>
                                <input data-price="" style="width: 90%;" type="text" name="to">
                            </div>
                        </div>

                        <div class="col col-md-4 px-5">
                            <h3>Thương hiệu</h3>
                            <div>
                                @foreach($brands as $brand)

                                <div class="radioArea">
                                    <input form="searchForm" name="thuong-hieu" id="{{$brand->name}}" type="radio" value="{{$brand->name}}">
                                    <label class="ml-3" for="{{$brand->name}}">{{$brand->name}}</label>
                                </div>

                                @endforeach
                            </div>
                        </div>

                        <div class="col col-md-4 px-5">
                            <h3>Loại</h3>
                            <div>
                                @foreach($coffee_types as $coffee_type)

                                <div class="radioArea">
                                    <input form="searchForm" name="loai-ca-phe" id="{{$coffee_type->name}}" type="radio" value="{{$coffee_type->name}}">
                                    <label class="ml-3" for="{{$coffee_type->name}}">{{$coffee_type->name}}</label>
                                </div>

                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="row mt-5 searchResult">
                @if(isset($searchResult) && count($searchResult)>0)

                <div class="text-center col col-md-12">
                    <h1 class="text-primary">Đã tìm thấy {{count($searchResult)}} sản phẩm</h1>
                </div>

                @foreach($searchResult as $coffee)

                <div class="col col-md-3 my-2 text-center">
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
    </div>
</div>

@endsection