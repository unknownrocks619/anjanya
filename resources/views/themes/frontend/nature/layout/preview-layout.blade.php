<!doctype html>
<html lang="en">

<!-- Mirrored from demo.bosathemes.com/html/environ/ by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 06 Oct 2023 19:27:32 GMT -->
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- favicon -->
    <link rel="icon" type="image/png" href="{{\App\Classes\Helpers\SystemSetting::logo()}}">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Fonts Awesome CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/nature/assets/vendors/fontawesome/css/all.min.css')}}">
    <!-- Elmentkit Icon CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/nature/assets/vendors/elementskit-icon-pack/assets/css/ekiticons.css')}}">
    <!-- Fonts Awesome CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset ('frontend/nature/assets/vendors/progressbar-fill-visible/css/progressBar.css')}}">
    <!-- jquery-ui css -->
    <link rel="stylesheet" type="text/css" href="{{asset ('frontend/nature/assets/vendors/jquery-ui/jquery-ui.min.css')}}">
    <!-- modal video css -->
    <link rel="stylesheet" type="text/css" href="{{asset ('frontend/nature/assets/vendors/modal-video/modal-video.min.css')}}">
    <!-- light box css -->
    <link rel="stylesheet" type="text/css" href="{{asset ('frontend/nature/assets/vendors/fancybox/dist/jquery.fancybox.min.css')}}">
    <!-- slick slider css -->
    <link rel="stylesheet" type="text/css" href="{{asset ('frontend/nature/assets/vendors/slick/slick.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset ('frontend/nature/assets/vendors/slick/slick-theme.css')}}">
    <!-- google fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&amp;family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,400&amp;display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <title>@section('page_title')</title>
    @stack('page_setting')
    @vite(['resources/js/themes/nature/css/app.css'])
</head>
<body>
<div id="page" class="full-page">
    <main id="content" class="main-content">
        @yield('main')
    </main>
</div>
</body>
