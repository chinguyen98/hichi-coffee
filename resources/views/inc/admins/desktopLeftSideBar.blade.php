<div class="left-sidebar-pro">
    <nav id="sidebar" class="">
        <div class="sidebar-header">
            <a href="index.html"><img class="main-logo" src="admins/img/logo/logo.png" alt="" /></a>
            <strong><img src="admins/img/logo/logosn.png" alt="" /></strong>
        </div>
        <div class="nalika-profile">
            <div class="profile-dtl">
                <a href="#"><img src="admins/img/notification/4.jpg" alt="" /></a>
                <h2>{{Auth::user()->name}}</h2>
            </div>
            <div class="profile-social-dtl">
                <ul class="dtl-social">
                    <li><a href="#"><i class="icon nalika-facebook"></i></a></li>
                    <li><a href="#"><i class="icon nalika-twitter"></i></a></li>
                    <li><a href="#"><i class="icon nalika-linkedin"></i></a></li>
                </ul>
            </div>
        </div>
        <div class="left-custom-menu-adp-wrap comment-scrollbar">
            <nav class="sidebar-nav left-sidebar-menu-pro">
                <ul class="metismenu" id="menu1">
                    <li>
                        <a class="has-arrow" href="index.html">
                            <i class="icon nalika-home icon-wrap"></i>
                            <span class="mini-click-non">Trang chủ</span>
                        </a>
                        <ul class="submenu-angle" aria-expanded="true">
                            <li><a title="Dashboard v.1" href="index.html"><span class="mini-sub-pro">Dashboard v.1</span></a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="has-arrow" href="index.html">
                            <i class="icon nalika-home icon-wrap"></i>
                            <span class="mini-click-non">Sản phẩm</span>
                        </a>
                        <ul class="submenu-angle" aria-expanded="true">
                            <li><a title="Xem toàn bộ" href="/admins/manage/coffees"><span class="mini-sub-pro">Quản lý</span></a></li>
                            <li><a title="Thêm mới" href="/admins/manage/coffees/create"><span class="mini-sub-pro">Thêm mới</span></a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </nav>
</div>