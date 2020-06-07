<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <base href="{{asset('')}}">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{$title}}</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- favicon
		============================================ -->
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
    <!-- Google Fonts
		============================================ -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
    <!-- Bootstrap CSS
		============================================ -->
    <link rel="stylesheet" href="/admins/css/bootstrap.min.css">
    <!-- Bootstrap CSS
		============================================ -->
    <link rel="stylesheet" href="/admins/css/font-awesome.min.css">
    <!-- nalika Icon CSS
		============================================ -->
    <link rel="stylesheet" href="/admins/css/nalika-icon.css">
    <!-- owl.carousel CSS
		============================================ -->
    <link rel="stylesheet" href="/admins/css/owl.carousel.css">
    <link rel="stylesheet" href="/admins/css/owl.theme.css">
    <link rel="stylesheet" href="/admins/css/owl.transitions.css">
    <!-- animate CSS
		============================================ -->
    <link rel="stylesheet" href="/admins/css/animate.css">
    <!-- normalize CSS
		============================================ -->
    <link rel="stylesheet" href="/admins/css/normalize.css">
    <!-- meanmenu icon CSS
		============================================ -->
    <link rel="stylesheet" href="/admins/css/meanmenu.min.css">
    <!-- main CSS
		============================================ -->
    <link rel="stylesheet" href="/admins/css/main.css">
    <!-- morrisjs CSS
		============================================ -->
    <link rel="stylesheet" href="/admins/css/morrisjs/morris.css">
    <!-- mCustomScrollbar CSS
		============================================ -->
    <link rel="stylesheet" href="/admins/css/scrollbar/jquery.mCustomScrollbar.min.css">
    <!-- metisMenu CSS
		============================================ -->
    <link rel="stylesheet" href="/admins/css/metisMenu/metisMenu.min.css">
    <link rel="stylesheet" href="/admins/css/metisMenu/metisMenu-vertical.css">
    <!-- calendar CSS
		============================================ -->
    <link rel="stylesheet" href="/admins/css/calendar/fullcalendar.min.css">
    <link rel="stylesheet" href="/admins/css/calendar/fullcalendar.print.min.css">
    <!-- style CSS
    ============================================ -->
    <link rel="stylesheet" href="/admins/css/alerts.css">
    <link rel="stylesheet" href="/admins/css/style.css">
    <!-- responsive CSS
		============================================ -->
    <link rel="stylesheet" href="/admins/css/responsive.css">
    <!-- modernizr JS
		============================================ -->
    <script src="admins/js/vendor/modernizr-2.8.3.min.js"></script>

    <link rel="stylesheet" href="/admins/css/owner.css">
</head>

<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

    @include('inc.admins.desktopLeftSideBar')

    <!-- Start Welcome area -->
    <div class="all-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="logo-pro">
                        <a href="index.html"><img class="main-logo" src="/admins/img/logo/logo.png" alt="" /></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-advance-area">
            <div class="header-top-area">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="header-top-wraper">
                                <div class="row">
                                    <div class="col-lg-1 col-md-0 col-sm-1 col-xs-12">
                                        <div class="menu-switcher-pro">
                                            <button type="button" id="sidebarCollapse" class="btn bar-button-pro header-drl-controller-btn btn-info navbar-btn">
                                                <i class="icon nalika-menu-task"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-7 col-sm-6 col-xs-12">
                                        <div class="header-top-menu tabl-d-n hd-search-rp">
                                            <div class="breadcome-heading">
                                                <form role="search" class="">
                                                    <input type="text" placeholder="Search..." class="form-control">
                                                    <a href=""><i class="fa fa-search"></i></a>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    @include('inc.admins.headerHelper')

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Mobile Menu start -->

            @include('inc.admins.mobileMenu')

            <!-- Mobile Menu end -->

            @include('inc.admins.dashBoardIntro')

            @yield('content')
            
        </div>
    </div>

    <!-- jquery
		============================================ -->
    <script src="admins/js/vendor/jquery-1.12.4.min.js"></script>
    <!-- bootstrap JS
		============================================ -->
    <script src="admins/js/bootstrap.min.js"></script>
    <!-- wow JS
		============================================ -->
    <script src="admins/js/wow.min.js"></script>
    <!-- price-slider JS
		============================================ -->
    <script src="admins/js/jquery-price-slider.js"></script>
    <!-- meanmenu JS
		============================================ -->
    <script src="admins/js/jquery.meanmenu.js"></script>
    <!-- owl.carousel JS
		============================================ -->
    <script src="admins/js/owl.carousel.min.js"></script>
    <!-- sticky JS
		============================================ -->
    <script src="admins/js/jquery.sticky.js"></script>
    <!-- scrollUp JS
		============================================ -->
    <script src="admins/js/jquery.scrollUp.min.js"></script>
    <!-- mCustomScrollbar JS
		============================================ -->
    <script src="admins/js/scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="admins/js/scrollbar/mCustomScrollbar-active.js"></script>
    <!-- metisMenu JS
		============================================ -->
    <script src="admins/js/metisMenu/metisMenu.min.js"></script>
    <script src="admins/js/metisMenu/metisMenu-active.js"></script>
    <!-- sparkline JS
		============================================ -->
    <script src="admins/js/sparkline/jquery.sparkline.min.js"></script>
    <script src="admins/js/sparkline/jquery.charts-sparkline.js"></script>
    <!-- calendar JS
		============================================ -->
    <script src="admins/js/calendar/moment.min.js"></script>
    <script src="admins/js/calendar/fullcalendar.min.js"></script>
    <script src="admins/js/calendar/fullcalendar-active.js"></script>
    <!-- float JS
		============================================ -->
    <script src="admins/js/flot/jquery.flot.js"></script>
    <script src="admins/js/flot/jquery.flot.resize.js"></script>
    <script src="admins/js/flot/curvedLines.js"></script>
    <script src="admins/js/flot/flot-active.js"></script>
    <!-- plugins JS
		============================================ -->
    <script src="admins/js/plugins.js"></script>
    <!-- main JS
		============================================ -->
    <script src="admins/js/main.js"></script>

    <script src="ckeditor/ckeditor.js"></script>
</body>

</html>