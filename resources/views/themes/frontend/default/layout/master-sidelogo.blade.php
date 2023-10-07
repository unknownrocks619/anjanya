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
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png">

    <link href="https://fonts.googleapis.com/css2?family=Alegreya:ital,wght@0,400;0,500;1,400;1,700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('frontend/default/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/default/js/jquery.sticky-sidebar.min.js') }}"></script>
    <script src="{{ asset('frontend/default/js/slick.min.js') }}"></script>

    @stack('page_settings')
    @vite(['resources/js/public_app.js', 'public/frontend/default/app.js', 'public/frontend/default/app.css'])
</head>

<body>

    {!! $user_theme->partials('pre-loader', ['title' => 'Membership Registration']) !!}

    <!-- site wrapper -->
    <div class="site-wrapper">

        <div class="main-overlay"></div>

        <!-- header -->
        {!! $user_theme->header() !!}

        @yield('main')


        {!! $user_theme->partials('insta-feed') !!}

        {!! $user_theme->partials('footer-master') !!}

    </div><!-- end site wrapper -->

    <!-- search popup area -->
    {!! $user_theme->partials('search-popup') !!}

    <!-- canvas menu -->
    {!! $user_theme->partials('canvas_menu') !!}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script src="https://kit.fontawesome.com/cb35896f9c.js" crossorigin="anonymous"></script>
    <script type='text/javascript'
        src='https://platform-api.sharethis.com/js/sharethis.js#property=649a0cca6fc24400124f2c47&product=sop'
        async='async'></script>
</body>

</html>
