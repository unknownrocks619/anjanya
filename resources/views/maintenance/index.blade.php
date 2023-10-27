@php
    $lastSettings = \App\Plugins\Maintanance\Http\Models\MaintenanaceMode::where('active',true)->latest()->first();
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ \App\Classes\Helpers\SystemSetting::basic_configuration('site_name') }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        @font-face {
            font-family: 'gnsmfTagline';
            src : url('{{asset('gnsmfFonts/taglineFonts.ttf')}}')
        }
    </style>
</head>

<body style="padding:0px;margin:0px; background:#ede8d8">
    <div class="container-fluid">
        <div class="row vh-100 align-items-center">
            <div class="col-12 text-center">
                <img src="{{ \App\Classes\Helpers\SystemSetting::logo() }}"
                    class="img-fluid w-25" />
                <h4 style="font-family:gnsmfTagline">
                    {{\App\Classes\Helpers\SystemSetting::basic_configuration('tagline')}}
                </h4>
                <div class="mt-4">
                    <button type="button" class="btn btn-primary py-3 px-4 mx-2" data-bs-toggle="collapse" data-bs-target="#hospital-service"
                            aria-expanded="false"  aria-controls="multiCollapseExample2">
                        Hospital Service</button>
                    <a @if($lastSettings) href="{{route('frontend.maintenance-mode.mode-settings',['slug' => $lastSettings->slug])}}"  @else href="#" @endif class="btn btn-primary py-3 px-4">Education Service</a>
                </div>
            </div>
            <div class="collapse col-12 text-center alert alert-danger" id="hospital-service">
                <h2>Sorry This service is currently unavailable. Please visit later.</h2>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>
