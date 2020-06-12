@extends('layouts/app')

@section('content')

<section class="home-slider owl-carousel">
    <div class="slider-item" style="background-image: url(customers/images/bg_1.jpg);">
        <div class="overlay"></div>
        <div class="container">
            <div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">

                <div class="col-md-8 col-sm-12 text-center ftco-animate">
                    <span class="subheading">Welcome</span>
                    <h1 class="mb-4">Website Coffee số 1 Việt Nam</h1>
                    <p class="mb-4 mb-md-5 slogan">Thêm chút đường cho cà phê ngọt <br /> Thêm chút tình mình có thuộc về nhau?</p>
                    <p><a href="/coffees" class="btn btn-primary p-3 px-xl-4 py-xl-3">Xem sản phẩm</a> <a href="/login" class="btn btn-white btn-outline-white p-3 px-xl-4 py-xl-3">Đăng nhập</a></p>
                </div>

            </div>
        </div>
    </div>

    <div class="slider-item" style="background-image: url(customers/images/bg_2.jpg);">
        <div class="overlay"></div>
        <div class="container">
            <div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">

                <div class="col-md-8 col-sm-12 text-center ftco-animate">
                    <span class="subheading">Welcome</span>
                    <h1 class="mb-4">Cà phê của giàu có <br /> và hạnh phúc</h1>
                    <p class="mb-4 mb-md-5 slogan">Thêm chút đường cho cà phê ngọt <br /> Thêm chút tình mình có thuộc về nhau?</p>
                    <p><a href="/coffees" class="btn btn-primary p-3 px-xl-4 py-xl-3">Xem sản phẩm</a> <a href="/login" class="btn btn-white btn-outline-white p-3 px-xl-4 py-xl-3">Đăng nhập</a></p>
                </div>

            </div>
        </div>
    </div>

    <div class="slider-item" style="background-image: url(customers/images/bg_3.jpg);">
        <div class="overlay"></div>
        <div class="container">
            <div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">

                <div class="col-md-8 col-sm-12 text-center ftco-animate">
                    <span class="subheading">Welcome</span>
                    <h1 class="mb-4">Niềm cảm hứng bất tận</h1>
                    <p class="mb-4 mb-md-5 slogan">Thêm chút đường cho cà phê ngọt <br /> Thêm chút tình mình có thuộc về nhau?</p>
                    <p><a href="/coffees" class="btn btn-primary p-3 px-xl-4 py-xl-3">Xem sản phẩm</a> <a href="/login" class="btn btn-white btn-outline-white p-3 px-xl-4 py-xl-3">Đăng nhập</a></p>
                </div>

            </div>
        </div>
    </div>
</section>

<section class="ftco-intro">
    <div class="container-wrap">
        <div class="wrap d-md-flex align-items-xl-end">
            <div class="info">
                <div class="row no-gutters">
                    <div class="col-md-3 d-flex ftco-animate">
                        <div class="icon"><span class="icon-phone"></span></div>
                        <div class="text">
                            <h3>(028) 38 503 717</h3>
                            <p>Mọi lúc mọi nơi</p>
                        </div>
                    </div>
                    <div class="col-md-5 d-flex ftco-animate">
                        <div class="icon"><span class="icon-my_location"></span></div>
                        <div class="text">
                            <h3>79 Đường 204 Cao Lỗ, Phường 4, Quận 8</h3>
                            <p>Lô B5 - Khu Công Nghiệp Trà Đa, Pleiku, Gia Lai</p>
                        </div>
                    </div>
                    <div class="col-md-4 d-flex ftco-animate">
                        <div class="icon"><span class="icon-clock-o"></span></div>
                        <div class="text">
                            <h3>Mở cửa: Thứ 2 - Thứ 7</h3>
                            <p>6:00am - 19:00pm</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<section class="ftco-about d-md-flex">
    <div class="one-half img" style="background-image: url(customers/images/about.jpg);"></div>
    <div class="one-half ftco-animate">
        <div class="overlap">
            <div class="heading-section ftco-animate ">
                <span class="subheading aquarelleFont">Khơi Nguồn</span>
                <h2 class="my-4">SÁNG TẠO</h2>
            </div>
            <div>
                <p>Cà phê, không sặc sỡ để gây sự chú ý, Không ngọt ngào để "xu nịnh cảm xúc" Mà nó tồn tại để mang lại cho chúng ta một kho tàng. Cần khám phá một người dẫn lối để đi đến sự thanh tịnh.</p>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section ftco-services">
    <div class="container">
        <div class="row">
            <div class="col-md-4 ftco-animate">
                <div class="media d-block text-center block-6 services">
                    <div class="icon d-flex justify-content-center align-items-center mb-5">
                        <span class="flaticon-choices"></span>
                    </div>
                    <div class="media-body">
                        <h3 class="heading">Dễ dàng đặt hàng</h3>
                        <p>Thao tác đơn giản chỉ sau một click chuột</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 ftco-animate">
                <div class="media d-block text-center block-6 services">
                    <div class="icon d-flex justify-content-center align-items-center mb-5">
                        <span class="flaticon-delivery-truck"></span>
                    </div>
                    <div class="media-body">
                        <h3 class="heading">Giao hàng nhanh chóng</h3>
                        <p>Cam kết giao hàng đúng thời hạn</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 ftco-animate">
                <div class="media d-block text-center block-6 services">
                    <div class="icon d-flex justify-content-center align-items-center mb-5">
                        <span class="flaticon-coffee-bean"></span></div>
                    <div class="media-body">
                        <h3 class="heading">Chất lượng cao</h3>
                        <p>Chất lượng không thể nào thiếu phong cách</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 pr-md-5">
                <div class="heading-section text-md-right ftco-animate">
                    <span class="subheading aquarelleFont">Thế Giới</span><br />
                    <h2>Cà phê</h2>
                    <p class="mb-4">Trong màu đen của cà phê, tinh ý sẽ thấy được nét sóng sánh của màu nâu đỏ,
                        sau vị đắng ngắm lòng là dư vị ngọt ngọt lạ kỳ của vị hương.
                        Nhìn qua lăng kính phân kì sẽ thấy ngỡ ngàng sự hoà quyện của tập hợp bao nhiêu là màu sắc,
                        thoang thoảng trong kí ức bao trùm cả không gian những mùi vị của yêu thương.</p>
                    <p><a href="#" class="btn btn-primary btn-outline-primary px-4 py-3">Xem sản phẩm</a></p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-6">
                        <div class="menu-entry">
                            <a href="#" class="img" style="background-image: url(customers/images/menu-1.jpg);"></a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="menu-entry mt-lg-4">
                            <a href="#" class="img" style="background-image: url(customers/images/menu-2.jpg);"></a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="menu-entry">
                            <a href="#" class="img" style="background-image: url(customers/images/menu-3.jpg);"></a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="menu-entry mt-lg-4">
                            <a href="#" class="img" style="background-image: url(customers/images/menu-4.jpg);"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="ftco-counter ftco-bg-dark img" id="section-counter" style="background-image: url(customers/images/bg_2.jpg);" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="row">
                    <div class="col-md-6 col-lg-3 d-flex justify-content-center counter-wrap ftco-animate">
                        <div class="block-18 text-center">
                            <div class="text">
                                <div class="icon"><span class="flaticon-coffee-cup"></span></div>
                                <strong class="number" data-number="100">0</strong>
                                <span>Coffee Branches</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 d-flex justify-content-center counter-wrap ftco-animate">
                        <div class="block-18 text-center">
                            <div class="text">
                                <div class="icon"><span class="flaticon-coffee-cup"></span></div>
                                <strong class="number" data-number="85">0</strong>
                                <span>Number of Awards</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 d-flex justify-content-center counter-wrap ftco-animate">
                        <div class="block-18 text-center">
                            <div class="text">
                                <div class="icon"><span class="flaticon-coffee-cup"></span></div>
                                <strong class="number" data-number="10567">0</strong>
                                <span>Happy Customer</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 d-flex justify-content-center counter-wrap ftco-animate">
                        <div class="block-18 text-center">
                            <div class="text">
                                <div class="icon"><span class="flaticon-coffee-cup"></span></div>
                                <strong class="number" data-number="900">0</strong>
                                <span>Staff</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('inc.customers.bestSeller')

<section class="ftco-gallery">
    <div class="container-wrap">
        <div class="row no-gutters">
            <div class="col-md-3 ftco-animate">
                <a href="gallery.html" class="gallery img d-flex align-items-center" style="background-image: url(customers/images/gallery-1.jpg);">
                    <div class="icon mb-4 d-flex align-items-center justify-content-center">
                        <span class="icon-search"></span>
                    </div>
                </a>
            </div>
            <div class="col-md-3 ftco-animate">
                <a href="gallery.html" class="gallery img d-flex align-items-center" style="background-image: url(customers/images/gallery-2.jpg);">
                    <div class="icon mb-4 d-flex align-items-center justify-content-center">
                        <span class="icon-search"></span>
                    </div>
                </a>
            </div>
            <div class="col-md-3 ftco-animate">
                <a href="gallery.html" class="gallery img d-flex align-items-center" style="background-image: url(customers/images/gallery-3.jpg);">
                    <div class="icon mb-4 d-flex align-items-center justify-content-center">
                        <span class="icon-search"></span>
                    </div>
                </a>
            </div>
            <div class="col-md-3 ftco-animate">
                <a href="gallery.html" class="gallery img d-flex align-items-center" style="background-image: url(customers/images/gallery-4.jpg);">
                    <div class="icon mb-4 d-flex align-items-center justify-content-center">
                        <span class="icon-search"></span>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>

@include('inc.customers.discoverProducts')

@include('inc.customers.customersSay')

@include('inc.customers.recentBlog')

@endsection