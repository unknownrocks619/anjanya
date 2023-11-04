@php
    use App\Classes\Helpers\Image;use App\Classes\Helpers\SystemSetting;$imageModalHolder = [];
    $styleKey = 'background-color';
    $styleValue = $maintenanceMode->background_color;
    $backgroundImage = $maintenanceMode->getImage()->where('type','background')->latest()->first();
    if ($backgroundImage) {
        $styleKey = 'background';
        $styleValue = 'url('.Image::getImageAsSize($backgroundImage->image->filepath,'l').');background-position:center;background-size:cover';
    }
@endphp
    <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ SystemSetting::basic_configuration('site_name') }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hammersmith+One&display=swap" rel="stylesheet">
    <style type="text/css">
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
            background : #545454
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

    </style>
</head>

<body style="padding:0px;margin:0px; {{$styleKey}}:{{$styleValue}};min-height:100vh">
<div class="container-fluid">
    <div class="row align-items-center">
        <div class="col-12 text-center">
            <img src="{{ SystemSetting::logo() }}"
                 class="img-fluid"/>
            <h4 style="font-family: gnsmfTagline;font-size: 43px">
                Your future in healthcare starts here.
            </h4>
        </div>
    </div>
    @if ( ! $maintenanceMode->buttons->count())
        <div class="row align-items-center">
            <div class="col-12 text-center">
                <a href="/maintenance" class="btn btn-primary">Go Back</a>
            </div>
        </div>
    @endif
    <div class="row align-items-center justify-content-center mt-5">
        <div class="col-8 text-center d-flex justify-content-center">
                <!-- Navigation -->
                <nav class="navbar navbar-expand-sm navbar-light" id="neubar">
                    <div class="container">

                        <div class=" collapse navbar-collapse" id="navbarNavDropdown">
                            <ul class="navbar-nav ms-auto ">
                                @foreach ($maintenanceMode->buttons as $navButton)
                                    <li class="nav-item">
                                        <a class=" mx-2 btn btn-gnsmf btn-primary px-5  rounded-pill" aria-current="page" href="#">{{$navButton->button_label}}</a>
                                    </li>
                                @endforeach
{{--                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">--}}
{{--                                        <li><a class="dropdown-item" href="#">Blog</a></li>--}}
{{--                                        <li><a class="dropdown-item" href="#">About Us</a></li>--}}
{{--                                        <li><a class="dropdown-item" href="#">Contact us</a></li>--}}
{{--                                    </ul>--}}
                            </ul>
                        </div>
                    </div>
                </nav>
                <!-- / Navigation -->
            </div>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
            crossorigin="anonymous"></script>
</body>
</html>
