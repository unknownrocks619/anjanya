@php
    $lastSettings = \App\Plugins\Maintanance\Http\Models\MaintenanaceMode::where('active',true)->latest()->first();
@endphp
    <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ \App\Classes\Helpers\SystemSetting::basic_configuration('site_name') }} @yield('page-title')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        @font-face {
            font-family: 'gnsmfTagline';
            src : url('{{asset('gnsmfFonts/taglineFonts.ttf')}}')
        }

        .nav-item .active {
            border-radius: 6px;
            background: linear-gradient(145deg, #ffe7ca, #f5d7b2);
            box-shadow:  4px 4px 8px #ddc1a0,
            -4px -4px 8px #f7e5cc;
        }
        #neubar .dropdown-menu a:hover {
            color: #454545
        }
        #neubar .nav-item {
            margin : auto 4px;
        }
        #neubar a {

            padding-left:12px;
            padding-right:12px;
        }
        #neubar .dropdown-menu {
            background : linear-gradient(145deg, #ffe7ca, #f5d7b2);
        }
        .dropdown-item {
            color : #004fab !important;
        }
        a.navbar-brand {
            color: #454545
        }
        .btn-gnsmf {
            --bs-btn-color : #004fab;
            --bs-btn-bg : #f8f9e7;
            --bs-btn-hover-color: #f8f9e7;
            --bs-btn-hover-bg: #004fab;
        }
        .gnsmf-default-color {
            color : #004fab !important;
            font-family: 'Hammersmith One', sans-serif !important;
            font-size: 25px !important;
            text-transform: uppercase;
        }
        .gnsmf-default-heading {
            color : #004fab !important;
            font-family: 'Hammersmith One', sans-serif !important;
            font-weight: bold;
            font-size: 45px !important;
            text-transform: uppercase;
        }

    </style>
    @stack('page-css')
</head>

<body style="padding:0px;margin:0px; background:#ede8d8">
<div class="container-fluid">
    @yield('main')
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
@stack('page-script')
</body>
</html>
