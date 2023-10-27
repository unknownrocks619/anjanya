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
    <style>
        @font-face {
            font-family: 'gnsmfTagline';
            src : url('{{asset('gnsmfFonts/taglineFonts.ttf')}}')
        }
    </style>
</head>

<body style="padding:0px;margin:0px; {{$styleKey}}:{{$styleValue}};min-height:100vh">
<div class="container-fluid">
    <div class="row align-items-center">
        <div class="col-12 text-center">
            <img src="{{ \App\Classes\Helpers\SystemSetting::logo() }}"
                 class="img-fluid" style="max-width:150px;" />
            <h4 style="font-family: gnsmfTagline">
                {{\App\Classes\Helpers\SystemSetting::basic_configuration('tagline')}}
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
        <div class="col-8 text-center">
            <div class="table-responsive">
                <table class="table table-hover table-border">
                    <tbody>
                    @foreach ($maintenanceMode->buttons as $button)
                        <tr>
                            <th>
                                {{$button->title}}
                            </th>
                            <td>
                                {!! $button->description !!}
                            </td>
                            <td>
                                @if($button->response_type == 'link')
                                    <a href="{{$button->button_response}}" class="btn btn-info" target="_blank">
                                        {{$button->button_label}}
                                    </a>
                                @endif
                                @if($button->response_type == 'image')
                                    @php
                                        $imageModalHolder['notificationTitle'.$button->getKey()] = ['image'=> asset($button->button_response),'title' => $button->title];
                                    @endphp
                                    <a href="#" class="btn btn-info" data-bs-target="#notificationTitle{{$button->getKey()}}" data-bs-toggle="modal">
                                        {{$button->button_label}}
                                    </a>
                                @endif
                                @if($button->response_type == 'pdf')
                                    <a href="{{asset($button->button_response)}}" class="btn btn-info">
                                        {{$button->button_label}}
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
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
