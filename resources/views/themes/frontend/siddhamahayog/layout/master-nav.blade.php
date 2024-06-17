<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>{{\App\Classes\Helpers\SystemSetting::basic_configuration('site_name')}}@yield('page_title')</title>
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{\App\Classes\Helpers\SystemSetting::logo()}}">

    <!-- CSS
    ============================================ -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('frontend/siddhamahayog/css/vendor/remixicon.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/siddhamahayog/css/vendor/eduvibe-font.css')}}">
    <link rel="stylesheet" href="{{ asset ('frontend/siddhamahayog/css/vendor/magnifypopup.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/siddhamahayog/css/vendor/slick.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/siddhamahayog/css/vendor/odometer.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/siddhamahayog/css/vendor/lightbox.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/siddhamahayog/css/vendor/animation.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/siddhamahayog/css/vendor/jqueru-ui-min.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    @stack('page_setting')
    @vite(['resources/js/themes/siddhamahayog/css/app.css'])
</head>
<body style="position:relative">

<div class="container-fluid d-md-block  d-sm-block">
    <div class="row">
        <div class="col-md-12 text-center bg-danger">
            <a href="/course/vedanta-darshan" target="_blank" class="btn edu-btn">Click Here For Vedanta Darshan Enrollment</a>
        </div>
    </div>
</div>

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

@stack('addition_footer')

<div class="rn-progress-parent">
    <svg class="rn-back-circle svg-inner" width="100%" height="100%" viewBox="-1 -1 102 102">
        <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
    </svg>
</div>

<!-- Modernizer JS -->
<script src="{{asset ('frontend/siddhamahayog/js/vendor/modernizr.min.js')}}"></script>
<!-- jQuery JS -->
<script src="{{asset('frontend/siddhamahayog/js/vendor/jquery.js')}}"></script>
{{--        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>--}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
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
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

@vite(['resources/js/themes/siddhamahayog/js/app.js','resources/js/public_app.js'])
<script src="https://kit.fontawesome.com/cb35896f9c.js" crossorigin="anonymous"></script>
<script type='text/javascript'
        src='https://platform-api.sharethis.com/js/sharethis.js#property=649a0cca6fc24400124f2c47&product=sop'
        async='async'></script>

@stack('page_script')
</body>
</html>
