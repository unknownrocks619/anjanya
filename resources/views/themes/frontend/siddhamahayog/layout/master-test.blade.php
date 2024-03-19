<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Event Details - Education HTML Template Using Bootstrap 5</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.png">

    <!-- CSS
	============================================ -->
    <link rel="stylesheet" href="{{asset('frontend/siddhamahayog/css/vendor/remixicon.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/siddhamahayog/css/vendor/eduvibe-font.css')}}">
    <link rel="stylesheet" href="{{ asset ('frontend/siddhamahayog/css/vendor/magnifypopup.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/siddhamahayog/css/vendor/slick.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/siddhamahayog/css/vendor/odometer.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/siddhamahayog/css/vendor/lightbox.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/siddhamahayog/css/vendor/animation.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/siddhamahayog/css/vendor/jqueru-ui-min.css')}}">
    <link rel="stylesheet" href="{{asset ('frontend/siddhamahayog/css/style.css')}}">
</head>

<body>
<div class="main-wrapper">
    {!! $user_theme->header('header-single') !!}
    {!! $user_theme->partials('mobile-menu') !!}


    <!-- Start Search Popup  -->
    <div class="edu-search-popup">
        <div class="close-button">
            <button class="close-trigger"><i class="ri-close-line"></i></button>
        </div>
        <div class="inner">
            <form class="search-form" action="#">
                <input type="text" class="eduvibe-search-popup-field" placeholder="Search Here...">
                <button class="submit-button"><i class="icon-search-line"></i></button>
            </form>
        </div>
    </div>
    <!-- End Search Popup  -->


    @yield('main')
    {!! $user_theme->footer() !!}

</div>

<div class="rn-progress-parent">
    <svg class="rn-back-circle svg-inner" width="100%" height="100%" viewBox="-1 -1 102 102">
        <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
    </svg>
</div>

<!-- JS
============================================ -->
<!-- Modernizer JS -->
<script src="{{asset ('frontend/siddhamahayog/js/vendor/modernizr.min.js')}}"></script>
<!-- jQuery JS -->
<script src="{{asset ('frontend/siddhamahayog/js/vendor/jquery.js')}}"></script>
<script src="{{asset ('frontend/siddhamahayog/js/vendor/bootstrap.min.js')}}"></script>
<script src="{{asset ('frontend/siddhamahayog/js/vendor/sal.min.js')}}"></script>
<script src="{{asset ('frontend/siddhamahayog/js/vendor/backtotop.js')}}"></script>
<script src="{{asset ('frontend/siddhamahayog/js/vendor/magnifypopup.js')}}"></script>
<script src="{{asset ('frontend/siddhamahayog/js/vendor/slick.js')}}"></script>
<script src="{{asset ('frontend/siddhamahayog/js/vendor/countdown.js')}}"></script>
<script src="{{asset ('frontend/siddhamahayog/js/vendor/jquery-appear.js')}}"></script>
<script src="{{asset ('frontend/siddhamahayog/js/vendor/odometer.js')}}"></script>
<script src="{{asset ('frontend/siddhamahayog/js/vendor/isotop.js')}}"></script>
<script src="{{asset ('frontend/siddhamahayog/js/vendor/imageloaded.js')}}"></script>
<script src="{{asset ('frontend/siddhamahayog/js/vendor/lightbox.js')}}"></script>
<script src="{{asset ('frontend/siddhamahayog/js/vendor/wow.js')}}"></script>
<script src="{{asset ('frontend/siddhamahayog/js/vendor/paralax.min.js')}}"></script>
<script src="{{asset ('frontend/siddhamahayog/js/vendor/paralax-scroll.js')}}"></script>
<script src="{{asset ('frontend/siddhamahayog/js/vendor/jquery-ui.js')}}"></script>
<script src="{{asset ('frontend/siddhamahayog/js/vendor/tilt.jquery.min.js')}}"></script>
<!-- Main JS -->
<script src="{{asset ('frontend/siddhamahayog/js/main.js') }}"></script>
</body>


<!-- Mirrored from eduvibe.html.devsvibe.com/event-details.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 12 Nov 2023 20:31:12 GMT -->
</html>
