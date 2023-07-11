@extends('themes.admin.master')

@section('content')
    <div class="container-fluid p-0">
        <div class="container-fluid p-0">
            <div class="row m-0">
                <div class="col-12 p-0">
                    <div class="login-card">
                        <div>
                            <div>
                                <a class="logo" href="#">
                                    <img class="w-25 img-fluid for-light"
                                        src="{{ \App\Classes\Helpers\SystemSetting::logo() }}" alt="logo image">
                                </a>
                            </div>
                            <div class="login-main">
                                <form class="theme-form ajax-form" method="post" action="{{ route('admin.login') }}">
                                    @csrf
                                    <h2 class="text-center">Sign in to account</h2>
                                    <p class="text-center">Enter your email & password to login</p>
                                    <div class="form-group">
                                        <label class="col-form-label">Email Address</label>
                                        <input class="form-control" type="email" name="email" required=""
                                            placeholder="Test@gmail.com">
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label">Password</label>
                                        <div class="form-input position-relative">
                                            <input class="form-control" type="password" name="password"
                                                placeholder="*********">
                                            <div class="show-hide">
                                                <span class="show"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mb-0">
                                        <div class="checkbox p-0">
                                            <input id="checkbox1" type="checkbox">
                                            <label class="text-muted" for="checkbox1">Remember password</label>
                                        </div><a class="link" href="forget-password.html">Forgot password?</a>
                                        <div class="text-end mt-3">
                                            <button class="btn btn-primary btn-block w-100" type="submit">Sign in</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
