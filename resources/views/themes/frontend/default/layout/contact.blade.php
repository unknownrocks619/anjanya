<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script src="{{ asset('frontend/default/js/slick.min.js') }}"></script>
    <script src="{{ asset('frontend/default/js/jquery.sticky-sidebar.min.js') }}"></script>
    @stack('page_settings')
    @vite(['resources/js/public_app.js', 'public/frontend/default/app.js', 'public/frontend/default/app.css'])
</head>

<body>
    @yield('main')
    <script src="https://kit.fontawesome.com/cb35896f9c.js" crossorigin="anonymous"></script>

</body>

</html>
