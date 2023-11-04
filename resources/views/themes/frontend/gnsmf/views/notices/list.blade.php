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
            <h1 class="gnsmf-default-heading">{{$menu->menu_name}}</h1>
        </div>
        @foreach ($notices_group as $notice_group)
            <div class="col-md-8 mt-3 text-white" style="background: #54545442 !important;">
                <div class="row">
                    @foreach ($notice_group->buttons ?? [] as $notice)
                        <div class="col-md-6">
                            <ul>
                                <li class="d-flex justify-content-between p-1">
                                    <h5>
                                        {{$notice->title}}
                                    </h5>
                                    @if($notice->response_type == 'image' || $notice->response_type == 'pdf')
                                        <a href="{{asset($notice->button_response)}}" target="_blank">{{$notice->button_label}}</a>
                                    @endif
                                </li>
                            </ul>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
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
