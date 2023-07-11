@extends('themes.frontend.users.auth', ['bodyAttribute' => ['class' => 'bg-light']])

@push('title')
    :: Reset Password
@endpush

@section('main_content')
    <div class="container  d-flex justify-content-center mt-5">
        <div class="row mt-5">
            <div class="mt-5 col-md-12 pb-5 px-5 bg-white">

                <div class="row bg-white mt-4">
                    <div class="col-md-12">
                        <p class="mt-4"
                            style="color:#03014C !important;font-family:'Lexend' !important;font-size:20px;line-height:25px;">
                            We'll send password reset instructions to the email address associated with your
                            account.
                        </p>
                    </div>
                </div>
                <form method="POST" class="ajax-form ajax-append" action="{{ route('frontend.users.reset') }}">
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <div class="bg-white pt-3">
                                <div class="row me-5">
                                    <div class="col-md-12">
                                        <div class="form-group">

                                            <label for="email" class="mb-2"
                                                style="color:#03014C !important;font-size:20px;font-weight:700;font-family:'Lexend'">
                                                Enter Email Address
                                            </label>
                                            <input value="{{ old('email') }}" type="text" name="email"
                                                class="py-4 form-control rounded-3 @error('email') border border-danger @enderror"
                                                id="email" placeholder="" />
                                            @error('email')
                                                <div class="text-danger"
                                                    style="font-weight:700;color:#B81242 !important;font-family:'Inter' !important;font-size:17px !important;">
                                                    {{ $message }}</div>
                                            @enderror

                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4 text-start me-5">
                                    <div class="col-md-12 text-start mt-4 d-flex justify-content-start">
                                        <button class="btn btn-primary next py-3 px-5 login-button" type="submit">
                                            Reset Password
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="row mt-4">
                    <div class="col-md-12 " style="color:#03014C !important; font-weight:700">
                        Don’t have an Upschool account?
                        <a href="{{ route('frontend.users.register') }}" class="text-danger"
                            style="color:#D61A5F !important;text-decoration:none">Sign up</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
