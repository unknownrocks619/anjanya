<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="assets/images/favicon.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="upschool an online course app" />
    <link rel="apple-touch-icon" href="assets/images/favicon.png" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap 5.2.2 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <!-- font awesome css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Google fonts  -->
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <!-- Iconify  -->
    <script src="https://code.iconify.design/2/2.2.1/iconify.min.js"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.1/iconify-icon.min.js"></script>
    <!-- style css  -->
    <link rel="stylesheet" href="assets/css/style.css">
    <title>
        Upschool @stack('title')
    </title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    @vite(['resources/css/public_profile_app.css', 'resources/js/public_app.js'])
    @stack('custom_css')
</head>

<body>

    @if (session()->has('DEBUG_MODE') && session()->get('DEBUG_MODE') == true)
        <div class='container-fluid bg-danger' style="position: fixed">
            <div class="row">
                <div class="col-md-12 text-white fs-4 ps-3 d-flex align-items-center">
                    <div>YOU ARE CURRENTLY USING DEBUG MODE.</div>
                    <form
                        action="{{ route('admin.users.customers.logout_as_user', ['user' => auth()->guard('web')->user()]) }}"
                        method="post" class="ms-3 mt-0 pt-0">
                        @csrf
                        <button type="submit" class="btn btn-warning btn-sm px-2">
                            END DEBUG MODE
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @endif
    <div class="d-lg-none d-flex align-items-center justify-content-between p-3 nav-bg bg-white shadow">
        <a href="landing.html" class=""><img src="assets/images/logo.svg" height="30px" alt="" /></a>
        <a href="javascript:void()" class="" onclick="showSidebar()">
            <div class="toggle" id="toggle">
                <span class="line-toggle"></span>
                <span class="line-toggle"></span>
                <span class="line-toggle"></span>
            </div>
        </a>
    </div>

    @include('frontend.navigation.profile.header')

    <div class="main">
        @include('frontend.navigation.profile.sidebar')
        <div class="aside-content">
            @yield('main_content')
        </div>
    </div>

    <script src="assets/js/index.js"></script>
    @stack('custom_js')
</body>

</html>
