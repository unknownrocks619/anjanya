<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>
        {{ \App\Classes\Helpers\SystemSetting::basic_configuration('site_name') }}
        @yield('page_title')
    </title>
    @php
        $defined = get_defined_vars();
        if (isset($defined['seo'])) {
            echo $defined['seo'];
        }
    @endphp
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="shortcut icon" type="image/x-icon" href="{{\App\Classes\Helpers\SystemSetting::logo()}}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Barlow&amp;family=Barlow+Condensed&amp;family=Gilda+Display&amp;display=swap">
    <link rel="stylesheet" href="{{asset('frontend/bellevie/css/plugins.css')}}" />
    <link rel="stylesheet" href="{{asset('frontend/bellevie/css/style.css')}}" />
    <style type="text/css">
        .float-reservation {
            font-family: sans-serif;
            background: #de8f37;
            padding: 5px;;
            width: 230px;
            z-index: 100;
            position: fixed;
            top : 60%;
            transform: translate(0, -50%);
            right: 1%;
            color : #FFF;
            font-size : 20px;
            border : 2px solid;
            box-shadow: 3px 3px 5px rgba(0, 0, 0, 0.2);
        }
        #ui-datepicker-div {
            z-index: 9999 !important;
        }
    </style>
    @stack('page_settings')

</head>

<body>
    <!-- Preloader -->
    <div class="preloader-bg"></div>
    <div id="preloader">
        <div id="preloader-status">
            <div class="preloader-position loader"> <span></span> </div>
        </div>
    </div>
    <!-- Progress scroll totop -->
    <div class="progress-wrap cursor-pointer">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </div>
    <div class="float-reservation py-3">
        <a href="#" data-bs-target="#reservaton-modal" data-bs-toggle="modal">
            <div class="icon d-flex justify-content-center align-items-center p-2">
                <i class="flaticon-call"></i>
                <div class="call ms-3">Booking / Enquiry</div>

            </div>
        </a>
    </div>
    {!! $user_theme->partials('header.navbar') !!}
    <!-- site wrapper -->
    <div class="site-wrapper">
        @yield('main')
    </div>
    <!-- end site wrapper -->
    {!! $user_theme->partials('modal.booking-modal') !!}
    {!! $user_theme->partials("footer.footer") !!}
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="{{asset('frontend/bellevie/js/modernizr-2.6.2.min.js')}}"></script>
<script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js"></script>
<script src="{{asset('frontend/bellevie/js/pace.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
<script src="{{asset('frontend/bellevie/js/scrollIt.min.js')}}"></script>
<script src="{{asset('frontend/bellevie/js/jquery.waypoints.min.js')}}"></script>
<script src="{{asset('frontend/bellevie/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('frontend/bellevie/js/jquery.stellar.min.js')}}"></script>
<script src="{{asset('frontend/bellevie/js/jquery.magnific-popup.js')}}"></script>
<script src="{{asset('frontend/bellevie/js/YouTubePopUp.js')}}"></script>
<script src="{{asset('frontend/bellevie/js/select2.js')}}"></script>
<script src="{{asset('frontend/bellevie/js/datepicker.js')}}"></script>
<script src="{{asset('frontend/bellevie/js/smooth-scroll.min.js')}}"></script>
@vite(['resources/js/themes/bellevie/js/app.js'])
@stack('page_script')
</html>
