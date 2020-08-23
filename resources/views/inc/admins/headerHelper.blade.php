<div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
    <div class="header-right-info">
        <ul class="nav navbar-nav mai-top-nav header-right-menu">
            <li class="nav-item">
                <a style="margin-right: 1em;" href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle">
                    <i class="icon nalika-user"></i>
                    <span class="admin-name">Admin</span>
                    <i class="icon nalika-down-arrow nalika-angle-dw"></i>
                </a>
                <ul role="menu" class="dropdown-header-top author-log dropdown-menu animated zoomIn">
                    <li><a href="{{route('admins.home')}}"><span class="icon nalika-home author-log-ic"></span> Trang Chủ</a>
                    </li>
                    <li><a href="{{route('admins.renderInfoAdmin',['id'=>Auth::user()->id])}}"><span class="icon nalika-user author-log-ic"></span> Thông Tin Cá Nhân</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/admins/logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <span class="icon nalika-settings author-log-ic"></span> Đăng Xuất
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </li>
            <li style="margin-right: 2em;" class="nav-item nav-setting-open"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><i class="icon nalika-menu-task"></i></a>

            </li>
        </ul>
    </div>
</div>