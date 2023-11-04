@php
    $imageModalHolder = [];
    $styleKey = 'background-color';
    $styleValue = $maintenanceMode->background_color;
    $backgroundImage = $maintenanceMode->getImage()->where('type','background')->latest()->first();
    if ($backgroundImage) {
        $styleKey = 'background';
        $styleValue = 'url('.\App\Classes\Helpers\Image::getImageAsSize($backgroundImage->image->filepath,'l').');background-position:center;background-size:cover';
    }
@endphp
    <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ \App\Classes\Helpers\SystemSetting::basic_configuration('site_name') }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hammersmith+One&display=swap" rel="stylesheet">
    <style>
        @font-face {
            font-family: 'gnsmfTagline';
            src : url('{{asset('gnsmfFonts/taglineFonts.ttf')}}')
        }
    </style>
</head>

<body style="padding:0px;margin:0px; {{$styleKey}}:{{$styleValue}};min-height:100vh">
<div class="container">
    <div class="row mb-3">
        <div class="col-12 d-flex justify-content-center">
            <img src="{{ \App\Classes\Helpers\SystemSetting::logo() }}"
                 class="img-fluid" style="max-width:250px;" />
            <h4 style="font-family: gnsmfTagline" class="d-block text-center">
                {{\App\Classes\Helpers\SystemSetting::basic_configuration('tagline')}}
            </h4>
        </div>
        <div class='d-flex align-items-center justify-content-center ms-3 mt-5'>
            <h2 style="font-family: 'Hammersmith One', sans-serif;font-size:48px;color:#004FAB">
                {{$button->title}}
            </h2>
        </div>
    </div>
    <div class="col-12 " style="font-family: 'Hammersmith One', sans-serif; color:#004FAB !important;">
        {!! $button->description !!}
    </div>
    @if($button->getImage()->count() && $button->response_type == 'image')
        <div class="row align-items-center justify-content-center mt-5">
            <div class="col-12 text-center">
                <div class="table-responsive">
                        @foreach ($button->getImage as $image)
                            <img src="{{asset($image->image->filepath)}}" alt="{{$button->title}}" class="img-fluid my-3" />
                        @endforeach
                </div>
            </div>
        </div>
    @endif

    @if($button->response_type == 'pdf')
        <div class="row align-items-center justify-content-center mt-5">
            <div class="col-12 text-center">
                <div class="table-responsive">
                    <a href="{{asset($button->button_response)}}" target="_blank" class="btn btn-outline-primary">
                        <svg width="35px" height="35px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M12 7L12 14M12 14L15 11M12 14L9 11" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M16 17H12H8" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"></path> <path opacity="0.5" d="M2 12C2 7.28595 2 4.92893 3.46447 3.46447C4.92893 2 7.28595 2 12 2C16.714 2 19.0711 2 20.5355 3.46447C22 4.92893 22 7.28595 22 12C22 16.714 22 19.0711 20.5355 20.5355C19.0711 22 16.714 22 12 22C7.28595 22 4.92893 22 3.46447 20.5355C2 19.0711 2 16.714 2 12Z" stroke="#1C274C" stroke-width="1.5"></path> </g></svg>
                        Download PDF
                    </a>
                </div>
            </div>
        </div>

    @endif

    @if($button->response_type == 'link')
        <div class="row align-items-center justify-content-center mt-5">
            <div class="col-12 text-center">
                <div class="table-responsive">
                    <a href="{{asset($button->button_response)}}" target="_blank" class="btn btn-outline-primary">
                        <svg width="35px" height="35px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M15.197 3.35462C16.8703 1.67483 19.4476 1.53865 20.9536 3.05046C22.4596 4.56228 22.3239 7.14956 20.6506 8.82935L18.2268 11.2626M10.0464 14C8.54044 12.4882 8.67609 9.90087 10.3494 8.22108L12.5 6.06212" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"></path> <path d="M13.9536 10C15.4596 11.5118 15.3239 14.0991 13.6506 15.7789L11.2268 18.2121L8.80299 20.6454C7.12969 22.3252 4.55237 22.4613 3.0464 20.9495C1.54043 19.4377 1.67609 16.8504 3.34939 15.1706L5.77323 12.7373" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"></path> </g></svg>
                        View Link
                    </a>
                </div>
            </div>
        </div>

    @endif

    <div class="row align-items-center mt-2">
        <div class="col-12 text-center">
            <a href="{{route('frontend.maintenance-mode.mode-settings',['slug' => $maintenanceMode->slug])}}" class="btn btn-primary" style="background: #004fab">
                <svg width="25px" height="25px" viewBox="0 0 512 512" version="1.1" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <style type="text/css"> .st0{fill:#eff0f1;} .st1{fill:none;stroke:#eff0f1;stroke-width:32;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;} </style> <g id="Layer_1"></g> <g id="Layer_2"> <g> <path class="st0" d="M256,43.5C138.64,43.5,43.5,138.64,43.5,256S138.64,468.5,256,468.5S468.5,373.36,468.5,256 S373.36,43.5,256,43.5z M324.14,358.2c6.26,6.24,6.27,16.37,0.03,22.63c-3.13,3.13-7.23,4.7-11.33,4.7 c-4.09,0-8.17-1.56-11.3-4.67L187.86,267.5c-3.01-3-4.7-7.07-4.7-11.32s1.68-8.32,4.69-11.33l113.69-113.69 c6.25-6.25,16.38-6.25,22.63,0c6.25,6.25,6.25,16.38,0,22.63L221.8,256.15L324.14,358.2z"></path> </g> </g> </g></svg>
                Go Back
            </a>
        </div>
    </div>
</div>
@foreach ($imageModalHolder as $id => $image)
    <div class="modal fade" id="{{$id}}" tabindex="-1" aria-labelledby="{{$id}}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{$image['title']}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img src="{{$image['image']}}" class="img-fluid" />
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endforeach
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
