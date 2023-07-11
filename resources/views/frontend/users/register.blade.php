@extends('themes.frontend.users.auth', ['bodyAttribute' => ['id' => 'home', 'class' => 'bg-white']])

@push('title')
    :: Register
@endpush

@push('page_css')
    <style type="text/css">
        body {
            background: #f4f4f4 !important
        }

        p {
            font-family: 'Inter', sans-serif !important;
        }

        .social-login {
            font-family: 'Inter'sans-serif !important;
            font-weight: 600;
            color: #03014C !important
        }

        .social-login:hover {
            background: #CFCFCF !important;
        }

        label {
            font-family: 'Inter';
            font-weight: 400;
            line-height: 23px;
            /* font-size: 19px; */
        }

        .dynamic-padding {
            padding-left: 80px !important;
            /* padding-right: 20px !important; */
        }

        input {
            box-shadow: none;
            font-family: "Inter";


        }

        .next {
            background: #242254;
            color: #fff;
        }

        .next:hover {
            background: #242254 !important;
            color: #fff !important;

        }

        .progress-bar {
            background: #B81242
        }

        .btn-primary:active {
            background: #B81242 !important;
        }

        .btn-primary:disabled {
            background: #B81242 !important;
        }

        /* .active-bar {
                    background: #fff;
                    min-height: 40px;
                    min-width: 40px;
                    border-radius: 50%;
                    border: 2px solid red;
                    max-width: 30px;
                    margin-top: 78px;
                } */
        .active-circle {
            background: #fff !important;
            color: #fff !important;
            border: 2px solid red !important;
        }

        .active-text {
            color: #fff !important;
        }

        .active-line {
            background: #fff !important;
            color: #fff !important;

        }

        .information {
            font-size: 19px;
            color: #fff;
            font-family: 'Inter';
            line-height: 24px;
            margin-top: 15px;
            margin-left: 6px;
        }

        .information-line {
            min-width: 1px;
            min-height: 32px;
            background: #fff;
            max-width: 1px;
            margin-left: 19px;
            margin-top: 10px
        }

        .information-circle-disabled {
            background: transparent;
            min-height: 40px;
            min-width: 40px;
            border-radius: 50%;
            border: 2px solid #6076D1;
            max-width: 30px;
            margin-top: 15px;
        }

        .information-circle-disabled:first {
            background: transparent;
            min-height: 40px;
            min-width: 40px;
            border-radius: 50%;
            border: 2px solid #6076D1;
            max-width: 30px;
            margin-top: 15px;
        }

        .first {
            margin-top: 5px;
        }

        .information-disabled {
            font-size: 19px;
            color: #6076D1;
            font-family: 'Inter';
            line-height: 24px;
            margin-top: 15px;
            margin-left: 6px;
        }

        .information-line-disabled {
            min-width: 1px;
            min-height: 32px;
            background: #6076D1;
            max-width: 1px;
            margin-left: 19px;
            margin-top: 10px
        }

        .progress-title {
            text-align: left;
            color: #fff;
            font-size: 23px;
            font-family: 'Inter';
            line-height: 28px;
            margin-left: 0px;
            padding-left: 0px;
            margin-top: 0px;
            padding-top: 0px;
        }

        .progress-title>h5 {
            color: #fff !important;
            font-family: 'Inter' !important;
        }

        .steps {
            font-size: 14px;
            font-family: 'Inter';
            color: #B5CCEC;
            line-height: 17px;
        }

        .signup-progress-bar {
            margin-top: 50px;
            text-align: left;

        }

        .steps>p {
            font-size: 14px !important;
            font-family: "Inter";
        }

        @media only screen and (max-width: 600px) {
            .dynamic-padding {
                padding-left: 10px !important;
                /* padding-right: 10px !important; */
            }
        }

        .text-danger {
            font-family: 'Inter' !important;
        }
    </style>
@endpush

@section('main_content')
    <div class="container">
        <div class="row d-flex justify-content-center align-items-center p-4" style="margin-top:6%;margin-bottom:2%">
            <!-- Row -->
            <div class="col-md-8 bg-white ps-5 border-start" id="book_upload_contianer"
                data-current-step='{{ $current_step }}'>
                @if (in_array($current_step, ['step_one', 'step_two']))
                    <!-- Step Zero -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="pt-5 mt-3 pb-3" style="height:100%">
                                <div class="row me-5 social-login-row">
                                    <h4 class="mb-0" style="color: #03014C !important;font-weight:700;line-height:42px;">
                                        Create Your Upschool Account </h4>
                                    <p>
                                        You are a few clicks away from creating your account.
                                    </p>

                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                @include ($partial_view)
            </div>
            @include('frontend.users.register.sidebar.side-progress-bar')
        </div>
    </div>
@endsection
