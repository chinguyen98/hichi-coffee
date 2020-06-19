<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{$title ?? 'Hichi Coffee'}}</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans:400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Great+Vibes" rel="stylesheet">

    <link rel="stylesheet" href="/customers/css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="/customers/css/animate.css">

    <link rel="stylesheet" href="/customers/css/owl.carousel.min.css">
    <link rel="stylesheet" href="/customers/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="/customers/css/magnific-popup.css">

    <link rel="stylesheet" href="/customers/css/aos.css">

    <link rel="stylesheet" href="/customers/css/ionicons.min.css">

    <link rel="stylesheet" href="/customers/css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="/customers/css/jquery.timepicker.css">


    <link rel="stylesheet" href="/customers/css/flaticon.css">
    <link rel="stylesheet" href="/customers/css/icomoon.css">
    <link rel="stylesheet" href="/customers/css/style.css">
    <link rel="stylesheet" href="/customers/css/owner.css">
</head>

<body>
    @include('inc.customers.navbar')

    @yield('content')

    @include('inc.customers.footer')

    <!-- loader -->
    <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
            <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
            <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00" /></svg></div>

    <script src="/apps/js/renderCartQuantity.js"></script>
    <script src="/customers/js/jquery.min.js"></script>
    <script src="/customers/js/jquery-migrate-3.0.1.min.js"></script>
    <script src="/customers/js/popper.min.js"></script>
    <script src="/customers/js/bootstrap.min.js"></script>
    <script src="/customers/js/jquery.easing.1.3.js"></script>
    <script src="/customers/js/jquery.waypoints.min.js"></script>
    <script src="/customers/js/jquery.stellar.min.js"></script>
    <script src="/customers/js/owl.carousel.min.js"></script>
    <script src="/customers/js/jquery.magnific-popup.min.js"></script>
    <script src="/customers/js/aos.js"></script>
    <script src="/customers/js/jquery.animateNumber.min.js"></script>
    <script src="/customers/js/bootstrap-datepicker.js"></script>
    <script src="/customers/js/jquery.timepicker.min.js"></script>
    <script src="/customers/js/scrollax.min.js"></script>
    <script src="/customers/js/main.js"></script>

    <!-- Start Embed JS -->

    @if(Request::is('checkout'))

    <script src="/apps/js/renderAddress.js"></script>
    <script src="/apps/js/handlingCheckoutPage.js"></script>

    @endif

    <!-- End Embed JS -->

    <script>
        $(document).ready(function() {
            $(".owl-carousel").owlCarousel({
                loop: true,
                nav: true,
            });
        });
    </script>

</body>

</html>