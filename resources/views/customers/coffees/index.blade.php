@extends('layouts/app')

@section('content')

<!-- <section class="home-slider owl-carousel">
    <div class="slider-item" style="background-image: url(customers/images/bg_1.jpg);" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row slider-text justify-content-center align-items-center">
                <div class="col-md-7 col-sm-12 text-center ftco-animate">
                    <h1 class="mb-3 mt-5 bread">Sản phẩm</h1>
                    <p class="breadcrumbs"><span class="mr-2"><a href="/">Trang chủ</a></span>&nbsp; / &nbsp; <span>Sản phẩm</span></p>
                </div>
            </div>
        </div>
    </div>
</section> -->

<section class="bannerCoffee mt-5">
    <div class="container">
        <div class="row slider-text justify-content-center align-items-center">
            <div class="col-md-7 mt-5 col-sm-12 text-center ftco-animate">
                <h1 class="mb-3 mt-5 bread">Sản phẩm</h1>
                <p class="breadcrumbs"><span class="mr-2"><a href="/">Trang chủ</a></span> / <span class="text-white">Sản phẩm</span></p>
            </div>
        </div>
    </div>
</section>
</br>

<section class="ftco-about d-md-flex">
    <div class="one-half img" style="background-image: url(apps/images/about.jpg);"></div>
    <div class="one-half ftco-animate">
        <div class="overlap">
            <div class="heading-section ftco-animate text-center">
                <span class="subheading aquarelleFont">Danh mục</span>
                <h2 class="my-4">SẢN PHẨM</h2>
            </div>
            <div>
                <div id="accordion">

                    @foreach($brands as $brand)

                    <div class="card">
                        <div class="dmsp-container text-center card-header " id="{{$brand->id}}">
                            <h5 class="mb-0">
                                <button class="dmsp-container__btn btn btn-link collapsed" data-toggle="collapse" data-target="#collapse{{$brand->id}}" aria-expanded="false" aria-controls="collapseThree">
                                    <img src="apps/images/brands/{{$brand->image}}" alt="" srcset="">
                                </button>
                            </h5>
                        </div>
                        <div id="collapse{{$brand->id}}" class="collapse" aria-labelledby="{{$brand->id}}" data-parent="#accordion">
                            <div class="lstdmsp card-body">
                                <div>
                                    <div class="list-group">

                                        @foreach($coffee_types[$brand->id] as $coffee_type)

                                        <a href="{{route('customers.coffees.index', ['brand'=>$brand->slug, 'type'=>$coffee_type->slug])}}" class="list-group-item list-group-item-action">
                                            <p>{{$coffee_type->name}}</p>
                                        </a>

                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @endforeach

                </div>
            </div>
        </div>
    </div>
</section>

<section class="ftco-menu">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7 heading-section text-center ftco-animate">
                <span class="subheading">CH Coffee</span>
                <h2 class="mb-4 mt-2">Danh mục sản phẩm</h2>
                <div class="slogan sloganknst">
                    <p>Đàn ông rất giống cà phê <br> bởi nếu là loại ngon sẽ làm bạn mất ngủ!</p>
                </div>
            </div>
        </div>

        @foreach($menu_types as $type)
        <div class="dmsp-main-container mt-3">
            <a href="{{route('customers.coffees.index', ['type'=>$coffee_type->slug])}}">
                <div class="dmsp-main-container__name text-center">
                    <span>{{$type->name}}</span>
                </div>
            </a>
            <div class="pt-3 row dmsp-main-container__list d-lg-flex flex-wrap">
                @foreach($type->coffees as $key=>$coffee)

                @if($key===8)

                @break

                @else

                <div class="dmsp-main-container__item col-sm-12 col col-md-3 pt-3 text-center  d-sm-flex d-lg-flex flex-column justify-content-center align-items-center">
                    <a href="{{route('customer.coffees.show', ['slug'=>$coffee->slug])}}"><img src="apps/images/coffees/{{$coffee->image}}" alt=""></a>
                    <a href="{{route('customer.coffees.show', ['slug'=>$coffee->slug])}}">
                        <div class="row">
                            <div title="{{$coffee->name}}" class="coffeeName mt-3 col-md-12 text-center text-truncate">
                                {{$coffee->name}}
                            </div>
                        </div>
                    </a>
                    <span>{{number_format($coffee->price)}} VND</span>
                    <p><a href="{{route('customer.coffees.show', ['slug'=>$coffee->slug])}}" class="btn btn-primary btn-outline-primary">XEM SẢN PHẨM</a></p>
                </div>

                @endif

                @endforeach
            </div>
        </div>
        @endforeach
    </div>
</section>

@endsection