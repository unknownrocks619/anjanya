@php
    /** @var  \App\Models\Page $page */
    $featuredImage = null;
    $featuredImage = $page->getImage()->where('type','featured_image')->latest()->first();

    if ($featuredImage ) {
        $featuredImage = App\Classes\Helpers\Image::getImageAsSize($featuredImage->image->filepath,'l');
    }
@endphp

@extends($user_theme->frontend_layout($extends))
@section('main')
    <div class="row align-items-center justify-content-center">
        <div class="col-12 text-center">
            <img src="{{ \App\Classes\Helpers\SystemSetting::logo() }}"
                 class="img-fluid" style="max-width: 135px;" />
            <h4 style="font-family:gnsmfTagline">
                {{\App\Classes\Helpers\SystemSetting::basic_configuration('tagline')}}
            </h4>
            <h4 class="my-3 mb-5" style="font-family: gnsmfTagline;font-size: 35px">
                Your future in healthcare starts here.
            </h4>

        </div>
        <div class="col-12 text-center d-flex justify-content-center">
           {!! $user_theme->partials('navigation') !!}
        </div>
        <div class="col-md-12 text-center my-5">
            <h1 class="gnsmf-default-heading">
                {{$page->title}}
            </h1>
        </div>
        @if($featuredImage)
        <div class="col-md-8 text-center">
            <img src="{{$featuredImage}}" class="img-fluid" />
        </div>
        @endif
        <div class="col-md-8 d-flex justify-content-center gnsmf-default-color mt-t">
            <div>
                {!! $page->full_description !!}
            </div>
        </div>
    </div>
@endsection


@push('page-css')
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
            background : linear-gradient(145deg, #ffe7ca, #f5d7b2);
        }
        .dropdown-item {
            color : #004fab !important;
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
        .gnsmf-default-color {
            color : #004fab !important;
            font-family: 'Hammersmith One', sans-serif !important;
            font-size: 25px !important;
            text-transform: uppercase;
        }
        .gnsmf-default-heading {
            color : #004fab !important;
            font-family: 'Hammersmith One', sans-serif !important;
            font-weight: bold;
            font-size: 45px !important;
            text-transform: uppercase;
        }

    </style>
@endpush
