@extends('themes.frontend.users.auth', ['bodyAttribute' => ['id' => 'home', 'class' => 'bg-white'], 'isLanding' => true, 'isFooter' => true])

@push('title')
    :: Payment Confirmation
@endpush


@section('main_content')
    <div class="container">

        <div class="row px-0 mx-auto step-parent-row mt-4 mb-4 " style="margin-bottom:50px !important">
            <!-- Row -->
            <div class="mt-4 col-md-9 pl-0 ml-0 mx-auto" style="padding-left:0px !important;position:relative">
                <!-- Start project -->
                <div class="bg-light row step-four-row" style="margin-top:8% !important">
                    <div class="col-md-12 mt-4">
                        <div class="pt-3 ps-5 dynamic-padding" style="height:100%">
                            <div class="row">
                                <div class="col-md-12 mt-3">
                                    <h4 class="mb-0"
                                        style="color: #03014C !important;font-weight:700;line-height:42px;font-size:28px;font-family: 'Lexend' !important">
                                        {{ $title }}
                                    </h4>
                                </div>
                            </div>
                            <div class="row mt-4 pt-4 me-5 mb-3 pb-2">
                                <div class="col-md-12 upschool-color"
                                    style="font-family: 'Roboto' !important;font-size:19px;">
                                    {{ $message }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<style type="text/css">
    .upschool-color {
        color: #242254 !important;
        font-family: 'Roboto' !important;
        font-size: 19px !important;
        line-height: 26px !important;

    }
</style>
