<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
        <a class="navbar-brand" href="{{route('customers.home')}}">Hichi<small>Coffee</small></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button>
        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item {{$homeActive ?? ''}}"><a href="{{route('customers.home')}}" class="nav-link">Trang chủ</a></li>
                <li class="nav-item {{$introActive ?? ''}}"><a href="/intro" class="nav-link">Giới thiệu</a></li>
                <li class="nav-item {{$coffeeActive ?? ''}}"><a href="/coffees" class="nav-link">Sản phẩm</a></li>
                <li class="nav-item {{$newsActive ?? ''}}"><a href="/news" class="nav-link">Tin tức</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="room.html" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Tài khoản</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown04">
                        <a class="dropdown-item" href="/login">Đăng nhập</a>
                        <a class="dropdown-item" href="/register">Tạo tài khoản</a>
                    </div>
                </li>
                <li class="nav-item cart"><a href="/carts" class="nav-link"><span class="icon icon-shopping_cart"></span><span class="bag d-flex justify-content-center align-items-center"><small>1</small></span></a></li>
            </ul>
        </div>
    </div>
</nav>