@extends('themes.frontend.default.master')

@push('page_settings')
    <link rel="stylesheet" href="{{ asset('frontend/css/dropzone.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/font-awesome.css') }}">
@endpush

@section('content')
    <div class="container bg-white" style="min-width:100%;min-height:100% !important">
        <div class="card border-0" style="height:100% !important;box-shadow: none">
            <div class="row">
                <div class="col-md-3">

                    @include('frontend.registration.sidebar.aside')
                </div>

                <div class="col-md-9 main_registration_content" data-current-step={{ $current_step }}>
                    @include('frontend.registration.steps.' . \App\Models\User::REGISTRATION_STEPS[$current_step])
                </div>
            </div>
        </div>
    </div>
@endsection
