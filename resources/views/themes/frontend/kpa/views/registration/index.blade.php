@php
    $bannerImage = $menu->getImage()->where('type','banner_image')->latest()->first();
    
    if ( ! $bannerImage ) {
        $bannerImage = $menu->getImage()->where('type','background')->latest()->first();
    }

    if ( $bannerImage) {
        $bannerImage = App\Classes\Helpers\Image::getImageAsSize($bannerImage->image->filepath,'m');
    } else {
        $bannerImage = asset('images/breadcrumb-banner.jpeg');
    }
    $post = new App\Models\Post;
    $post->title = $menu->menu_name;
@endphp
@extends($user_theme->frontend_layout($extends))
@section('page_title') Registration @endsection

@push('page_setting')
    <style>
        .form-group input {
            border: 2px solid #000 !important;
            background-color: #efeeee !important;
        }
        .form-group label {
            font-size: 20px 
        }
        .form-group select {
            height: 50px;
            font-size: var(--font-size-b2);
            background-color: #efeeee
        }

        .form-group textarea{
            font-size: var(--font-size-b2);
            background-color: #efeeee;
            border: 2px solid #000;
        }

        @if($current_step == 'step_two')
            h1 {
            color: #88B04B;
            font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
            font-weight: 900;
            font-size: 40px;
            margin-bottom: 10px;
            }
            p {
            color: #404F5E;
            font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
            font-size:20px;
            margin: 0;
            }
        i {
            color: #9ABC66;
            font-size: 100px;
            line-height: 200px;
            margin-left:-15px;
        }
        .card {
            background: white;
            padding: 60px;
            border-radius: 4px;
            box-shadow: 0 2px 3px #C8D0D8;
            display: inline-block;
            margin: 0 auto;
        }
        @endif

    </style>
@endpush

@push('page_settings')
    <link rel="stylesheet" href="{{ asset('frontend/css/dropzone.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/font-awesome.css') }}">
@endpush


@section('main')
    {!! $user_theme->partials('post.cover',['cover' => $bannerImage,'post' => $post]) !!}
    <div class="main_registration_content" data-current-step="{{$current_step}}">
        <form action="{{route('frontend.users.register')}}" method="post" class="ajax-form">
            @include('themes.frontend.kpa.views.registration.steps.'.App\Models\User::REGISTRATION_STEPS[$current_step]);
        </form>
    </div>
    <div class="my-5"></div>
@endsection
