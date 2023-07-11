@extends('themes.frontend.users.auth', ['bodyAttribute' => ['class' => 'bg-light']])

@push('title')
    :: Reset Password
@endpush

@section('main_content')
    <div class="row d-flex justify-content-center" style="margin-top:8%">
        <!-- Row -->
        <div class="col-md-5 bg-white px-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="pt-5">
                        <h4 class="mb-0"
                            style="color: #03014C !important;font-weight:700;line-height:42px;font-size:33px;font-family:'Lexend'">
                            Reset Your Upschool.co Password
                        </h4>
                        <p class="mt-3" style="color:#242254 !important;font-family:'Inter' !important;font-size:18px">
                            Select a new password, minimum 8 characters

                        </p>

                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-12">
                    <form method="POST" class="ajax-form ajax-append"
                        action="{{ route('frontend.users.store_reset_password') }}">
                        <input type="hidden" name="email" value="{{ $user->email }}">
                        <input type="hidden" name="user" value="{{ encrypt($user->id) }}">
                        <div class="row mt-2">
                            <div class="col-md-12 mt-3">
                                <div class="form-group">
                                    <input required type="password" value="{{ old('password') }}" name="password"
                                        placeholder="New Password"
                                        class="py-4 rounded-3 form-control @error('password') border border-danger @enderror"
                                        id="password" />
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-12 mt-3">
                                <div class="form-group">
                                    <input required type="password" value="" name="password_confirmation"
                                        placeholder="Confirm New Password"
                                        class="py-4 rounded-3 form-control @error('password') border border-danger @enderror"
                                        id="confirm_password" />
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4 text-right pb-4">
                            <div class="col-md-12 mt-2">
                                <button class="btn btn-primary next py-3 px-5" type="submit">
                                    Reset and Login
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
