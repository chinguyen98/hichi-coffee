<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{$title ?? 'Hichi Coffee'}}</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" type="image/x-icon" href="/apps/images/icons/a.png">
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

@if ( Session::has('success_message') )

    @include('inc.customers.successMessageNofity')

@endif

@if ( Session::has('fail_message') )

    @include('inc.customers.failMessageNotify')

@endif

@include('inc.customers.navbar')

<div class="notify text-center">
    <h2>Thông báo:</h2>
    <h4 class="notity__error text-danger"></h4>
</div>

@yield('content')

@include('inc.customers.footer')

<!-- loader -->
<div id="ftco-loader" class="show fullscreen">
    <svg class="circular" width="48px" height="48px">
        <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/>
        <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10"
                stroke="#F96D00"/>
    </svg>
</div>

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

<!-- <script src="/apps/js/chatbox.js"></script> -->

@if(Request::is('checkout'))

    <script src="/apps/js/handlingCheckoutPage.js"></script>

@endif

@if(Request::is('carts'))

    <script src="/apps/js/handlingCartPage.js"></script>

@endif

@if(Request::is('accounts'))

    <script src="/apps/js/handlingAccountIndexPage.js"></script>

@endif

@if(Request::is('search'))

    <script src="/apps/js/handlingSearchCoffeePage.js"></script>

@endif

@if(Request::route()->getName()==='customer.coffees.show')

    <script src="/apps/js/handlingCoffeeDetailPage.js"></script>
    <script src="/apps/js/handlingCustomerComment.js"></script>
    <script src="/apps/js/handlingCoffeeFavorite.js"></script>

@endif

@if(Request::route()->getName()==='customers.addresses.create')

    <script src="/apps/js/handlingAddress.js"></script>

@endif

@if(Request::route()->getName()==='customers.addresses.index')

    <script src="/apps/js/handlingAddressIndex.js"></script>

@endif

@if(Request::route()->getName()==='customers.addresses.show')

    <script src="/apps/js/handlingAddressDetail.js"></script>

@endif

<script src="/apps/js/checkFavorite.js"></script>

@if(Request::route()->getName()==='customers.favorites.index')

    <script src="/apps/js/handlingFavorite.js"></script>

@endif

@if(Request::route()->getName()==='customers.comments.index')

    <script src="/apps/js/handlingCommentPage.js"></script>

@endif

<script src="/apps/js/handlingLogout.js"></script>

<!-- Botman -->
<script>
    var botmanWidget = {
        aboutText: 'Hichi-Coffee',
        bubbleAvatarUrl: 'https://image.flaticon.com/icons/svg/1030/1030449.svg',
        mainColor: '#c49b63',
        bubbleBackground: '#408591',
        // introMessage: "Hi! Hichi-Coffee xin chào bạn",
        placeholderText: 'Nhập gì đó đi',
        title: 'Chatbot Hichi',
    };
</script>

<script src='https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/js/widget.js'></script>

<script>
    window.addEventListener("load", function (event) {
        document.querySelector('.desktop-closed-message-avatar img').addEventListener('click', function () {
            document.querySelector('#botmanWidgetRoot').addEventListener('DOMSubtreeModified', function () {
                let botframe = document.getElementById('chatBotManFrame');
                if (botframe === null)
                    return;
                botframe.addEventListener('load', function () {
                    let htmlFrame = this.contentWindow.document.getElementsByTagName("html")[0];
                    let bodyFrame = this.contentWindow.document.getElementsByTagName("body")[0];
                    let headFrame = this.contentWindow.document.getElementsByTagName("head")[0];

                    let image = "/customers/images/bg_4.jpg"

                    htmlFrame.style.backgroundImage = "url(" + image + ")";
                    bodyFrame.style.backgroundImage = "url(" + image + ")";
                })
            })
        });
    });
</script>

<!-- End Embed JS -->

<script>
    $(document).ready(function () {
        $(".owl-carousel").owlCarousel({
            loop: true,
            nav: true,
        });
    });
</script>

</body>

</html>
