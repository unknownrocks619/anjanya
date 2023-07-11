@extends('themes.frontend.users.auth', ['bodyAttribute' => ['class' => 'bg-light']])

@push('title')
    :: Login
@endpush

@section('main_content')
    <div class="row  d-flex justify-content-center align-items-center" style="margin-top:8%;margin-bottom:2%">
        <!-- Row -->
        <div class="col-md-5 bg-white">
            <div class="row bg-white ms-4 ps-3">
                <div class="col-md-12 ps-4 bg-white">
                    <h4 class="mb-0 pt-4"
                        style="color: #03014C !important;font-weight:700;line-height:42px;font-size:25px;font-family:'Lexend'">
                        Welcome Back to Upschool.co</h4>
                    <p class="mt-3" style="color:#242254 !important;font-family:'Inter' !important;font-size:18px">
                        Sign in to continue to your account.
                    </p>
                </div>
                <div class="col-md-12 ps-4">
                    <form method="POST" class="ajax-form ajax-append" id="loginForm"
                        action="{{ route('frontend.users.login') }}">
                        <div class="bg-white pt-3" style="height:100%">
                            @csrf
                            <div class="row me-5">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        @error('email')
                                            <div class="text-danger mb-2"
                                                style="font-weight:700;color:#B81242 !important;font-family:'Inter' !important;font-size:17px !important;">
                                                {{ $message }}</div>
                                        @enderror
                                        <input value="{{ old('email') }}" type="text" style="font-family:'Inter'"
                                            name="email"
                                            class="py-4 form-control rounded-3 @error('email') border border-danger @enderror w-100"
                                            id="email" placeholder="Email Address" />
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-1 me-5">
                                <div class="col-md-12 mt-1">
                                    <div class="form-group mt-3">
                                        <input required type="password" style="font-family:'Inter' !important"
                                            value="{{ old('password') }}" name="password" placeholder="Password"
                                            class="py-4 rounded-3 form-control @error('password') border border-danger @enderror"
                                            id="password" />
                                        @error('password')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4 me-5">
                                <div class="col-md-12  d-flex justify-content-start">
                                    <input id="remember" style="width:22px; height: 22px;" type="checkbox" name="remember"
                                        value="1" />
                                    <label for="remember" class="mb-2 ms-2 pt-0">
                                        Keep me logged in until I log out
                                    </label>
                                </div>
                            </div>
                            <div class="row mt-4 text-right me-5">
                                <div class="col-md-12 text-right d-flex justify-content-end">
                                    <button class="w-100 btn btn-primary next py-3 px-5 login-button" type="submit">
                                        Sign In
                                    </button>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-6"
                                    style="color:#03014C;font-size:17px; font-family:'Inter';font-weight:700">
                                    <a style="color:#03014C !important;text-decoration:none"
                                        href="{{ route('frontend.users.reset') }}">Forgot Password?</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-12 mt-2 ps-4">
                    <div class="pl-0 ml-0 mx-auto step-parent pb-5 bg-white"
                        style="color:#03014C !important; font-weight:400">
                        Don’t have an Upschool account ? <a href="{{ route('frontend.users.register') }}"
                            class="text-danger" style="color:#D61A5F !important;text-decoration:none">Sign up</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
