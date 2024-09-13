<!doctype html>
<html lang="en">

<head>
    <title> @yield('page_title') | | {{ \App\Classes\Helpers\SystemSetting::basic_configuration('site_name') }}</title>

    <link rel="shortcut icon" href="assets/css/favicon.png" type="image/x-icon">

    <link rel="stylesheet" href="{{ asset("frontend/{$user_theme->theme_name()}/css/animate.css") }}">
    <link rel="stylesheet" href="{{ asset("frontend/{$user_theme->theme_name()}/css/bootstrap.min.css") }}">
    <link rel="stylesheet" href="{{ asset("frontend/{$user_theme->theme_name()}/css/all.min.css") }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="{{ asset("frontend/{$user_theme->theme_name()}/css/lightcase.css") }}">
    <!-- main css for template -->
    <link rel="stylesheet" href="{{ asset("frontend/{$user_theme->theme_name()}/css/style.min.css") }}">
    <script src="{{ asset("frontend/{$user_theme->theme_name()}/js/jquery-3.6.0.min.js") }}"></script>

    @vite(["resources/js/themes/{$user_theme->theme_name()}/css/app.css"])
    @vite(['resources/js/partials/component/component-selector.js'])
</head>

<body>

    {!! $user_theme->header() !!}
    @yield('main')

    {!! $user_theme->footer() !!}
    <script src="{{ asset("frontend/{$user_theme->theme_name()}/js/bootstrap.bundle.min.js") }}"></script>
    <script src="{{ asset("frontend/{$user_theme->theme_name()}/js/waypoints.min.js") }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="{{ asset("frontend/{$user_theme->theme_name()}/js/lightcase.js") }}"></script>
    <script src="{{ asset("frontend/{$user_theme->theme_name()}/js/isotope.pkgd.min.js") }}"></script>
    <script src="{{ asset("frontend/{$user_theme->theme_name()}/js/donate-range.js") }}"></script>
    <script src="{{ asset("frontend/{$user_theme->theme_name()}/js/jquery.counterup.min.js") }}"></script>
    <script src="{{ asset("frontend/{$user_theme->theme_name()}/js/wow.js") }}"></script>
    <script src="{{ asset("frontend/{$user_theme->theme_name()}/js/custom.js") }}"></script>

    @vite(["resources/js/themes/{$user_theme->theme_name()}/js/app.js", 'resources/js/public_app.js'])
</body>

</html>
