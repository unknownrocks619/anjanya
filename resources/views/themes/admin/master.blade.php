<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title>
        {{ \App\Classes\Helpers\SystemSetting::basic_configuration('site_name') }}
        @stack('page_title')
    </title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link
        href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&amp;display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    @stack('custom_css')


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>

    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <script src="https://cdn.tiny.cloud/1/6dik18hj4r0g0mkrx8ph3gy6v0vdkymdgzl0l4t6otwofs7b/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"
        integrity="sha256-lSjKY0/srUM9BE3dPm+c4fBo1dky2v27Gdjm2uoZaL0=" crossorigin="anonymous"></script>
    <script src="{{ asset('backend/js/notify/bootstrap-notify.min.js') }}"></script>
    <style type="text/css">
        .video-background {
            background: #000;
            position: fixed;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            z-index: -99;
        }

        .video-foreground,
        .video-background iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
        }

        @media (min-aspect-ratio: 16/9) {
            .video-foreground {
                height: 300%;
                top: -100%;
            }
        }

        @media (max-aspect-ratio: 16/9) {
            .video-foreground {
                width: 300%;
                left: -100%;
            }
        }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body>
    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>

    <div class="loader-wrapper">
        <div class="loader"></div>
    </div>
    @if (auth()->guard('admin')->check())
        <div class="page-wrapper horizontal-wrapper auth-user" id="pageWrapper">

            <!-- Page Header -->
            @include('themes.admin.header')
            <!-- End Page Header -->


            <!-- Page Page Wrapper -->
            <div class="page-body-wrapper">

                <!-- Sidebar -->
                @include('themes.admin.navigation')
                <!-- End Sidebar -->

                <div class="page-body">
                    @yield('main-content')
                </div>

                <!-- Footer -->
                @include('themes.admin.footer')
                <!-- End Footer -->

            </div>
            <!-- End Page Wrapper -->
        </div>
        <x-modal id="ajax_components_modal"></x-modal>
    @endif

    @yield('content')

    @stack('custom_script')
    <script src="{{ asset('backend/js/icons/feather-icon/feather.min.js') }}"></script>
    <script type="text/javascript">
        $(function() {
            feather.replace()
        })
    </script>

</body>

</html>
