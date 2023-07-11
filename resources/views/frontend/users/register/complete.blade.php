@extends('themes.frontend.users.auth', ['class' => 'bg-light', 'id' => 'home'])

@push('title')
    :: Email Verification
@endpush

@section('main_content')
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-10 text-center ms-5 ps-5 mt-5 pt-4 ">
                    <!-- Login -->
                    <h2 class="mb-6 text-success" style="font-weight:bold;color:#03014C !important;font-weight:700;">
                        Congratulations! Your account is already Verified!
                    </h2>
                    <!-- Text -->

                </div>
            </div>
            <div class="row">
            </div>

            <div class="row mb-3 mt-5">
                <div class="col-md-12 text-center">
                    <img src="{{ asset('images/2.png') }}" class="img-fluid w-25" />
                </div>
            </div>

            <div class="row mx-auto text-center mt-5 pt-5">
                <div class="col-md-6 text-center mx-auto">
                    <a style="background: #242254" class="btn btn-primary ms-3 py-3 px-5 w-25"
                        href="{{ route('frontend.users.login') }}">Sign In</a>
                </div>
            </div>
        </div>
    </div>
@endsection
