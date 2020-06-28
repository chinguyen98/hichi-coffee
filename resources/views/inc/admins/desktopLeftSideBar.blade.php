<div class="left-sidebar-pro">
    <nav id="sidebar" class="">
        <div class="sidebar-header">
            <a href="index.html"><img class="main-logo" src="admins/img/logo/logo.png" alt="" /></a>
            <strong><img src="admins/img/logo/logosn.png" alt="" /></strong>
        </div>
        <div class="nalika-profile">
            <div class="profile-dtl">
                @if(Auth::user()->id_role == 2)
                <a href="#"><img src="admins/img/notification/B612.jpg" alt="" /></a>
                <h2>{{Auth::user()->name}}</h2>
                @else
                <a href="#"><img src="admins/img/notification/chi.jpg" alt="" /></a>
                <h2>{{Auth::user()->name}}</h2>
                @endif
                
                
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
                        <img class="spanaa home"  src="/apps/images/icons/home.png" alt="">
                            <span class="mini-click-non">TỔNG QUAN</span>
                        </a>
                        <ul class="submenu-angle" aria-expanded="true">
                            <li><a title="Trang Chủ" href="/admins/home"><span class="mini-sub-pro"><i>Trang Chủ</i></span></a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="has-arrow" href="index.html">
                        <img class="spanaa"  src="/apps/images/icons/cafeproduct.png" alt="">
                            <span class="mini-click-non">SẢN PHẨM</span>
                        </a>
                        <ul class="submenu-angle" aria-expanded="true">
                            <li><a title="Xem toàn bộ" href="/admins/manage/coffees"><span class="mini-sub-pro"><i>Quản Lý</i></span></a></li>
                            <li><a title="Thêm mới" href="/admins/manage/coffees/create"><span class="mini-sub-pro"><i>Thêm Sản Phẩm</i></span></a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="has-arrow" href="index.html">
                            <img class="spanaa"  src="/apps/images/icons/cafe.png" alt="">
                            <span class="mini-click-non">KHO</span>
                        </a>
                        <ul class="submenu-angle" aria-expanded="true">
                            <li><a title="Xem toàn bộ" href="{{route('admins.manage.warehouse.index')}}"><span class="mini-sub-pro"><i>Quản Lý</i></span></a></li>
                            <li><a title="Thêm mới" href="{{route('admins.manage.warehouse.create')}}"><span class="mini-sub-pro"><i>Nhập Kho</i></span></a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="has-arrow" href="index.html">
                        <img class="spanaa"  src="/apps/images/icons/sale.png" alt="">
                            <span class="mini-click-non">KHUYẾN MÃI</span>
                        </a>
                        <ul class="submenu-angle" aria-expanded="true">
                            <li><a title="Xem toàn bộ" href="{{route('admins.manage.promotion.index')}}"><span class="mini-sub-pro"><i>Quản Lý</i></span></a></li>
                            <li><a title="Thêm mới" href="{{route('admins.manage.promotion.create')}}"><span class="mini-sub-pro"><i>Thêm Khuyến Mãi</i></span></a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="has-arrow" href="index.html">
                        <img class="spanaa"  src="/apps/images/icons/order.png" alt="">
                            <span class="mini-click-non">ĐƠN HÀNG</span>
                        </a>
                        <ul class="submenu-angle" aria-expanded="true">
                            <li><a title="Xem toàn bộ" href="{{route('admins.manage.order.check.index')}}"><span class="mini-sub-pro"><i>Kiểm Tra Đặt Hàng</i></span></a></li>
                        </ul>
                    </li>
                    
                    @if(Auth::user()->id_role==1)

                    <li>
                        <a class="has-arrow" href="index.html">
                        <img class="spanaa"  src="/apps/images/icons/member.png" alt="">
                            <span class="mini-click-non">QUẢN TRỊ</span>
                        </a>
                        <ul class="submenu-angle" aria-expanded="true">
                            <li><a title="Xem toàn bộ" href="{{route('admins.renderAdminManagementPage')}}"><span class="mini-sub-pro"><i>Quản Lý</i></span></a></li>
                            <li><a title="Thêm mới" href="{{route('admins.register.show')}}"><span class="mini-sub-pro"><i>Tạo Tài Khoản</i></span></a></li>
                        </ul>
                    </li>

                    @endif
                </ul>
            </nav>
        </div>
    </nav>
</div>