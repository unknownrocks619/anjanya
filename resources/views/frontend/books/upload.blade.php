@extends('themes.frontend.users.auth', ['bodyAttribute' => ['id' => 'home', 'class' => 'bg-white'], 'isLanding' => true, 'isFooter' => true])

@push('title')
    :: Upload Your Book
@endpush


@section('main_content')
    <div class="container">

        <div class="row px-0 mx-auto step-parent-row mt-4 mb-4 " style="margin-bottom:50px !important">
            <!-- Row -->
            <div class="mt-4 col-md-9 pl-0 ml-0 mx-auto" id="book_upload_contianer" data-current-step='{{ $current_tab }}'
                style="padding-left:0px !important;position:relative">
                @include('frontend.books.partials.' . \App\Models\Book::BOOK_UPLOAD_STAGE[$current_tab])
            </div>
            @include('frontend.books.partials.upload-progress-bar')
        </div>
    </div>
@endsection


@push('page_script')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.1/css/lightbox.min.css">
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>

    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">

    <style type="text/css">
        .dropzone {
            border: 2px dashed #E2E6EA;
            /* box-shadow: 0px 0px 0px 5px rgb(255 255 255); */
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            background: #F8F8F8;
            border-radius: 24px;

        }

        .dz-filename {
            display: none !important;
        }

        .image-3d {
            -webkit-transition: 0.2s;
        }

        .image-3d:hover {
            transform: perspective(400px) rotateY(-20deg);
            box-shadow: 0px 3px 30px rgba(0, 0, 0.22);
            transform-style: preserve-3d;
            transition: .2s;
            /* transition-timing-function: ease-in; */
            -webkit-transition: 0.2s;
        }

        ._df_thumb {
            box-shadow: none !important;
            border: none !important;
        }

        @media (max-width: 768px) {
            .responsive-img {
                max-height: auto;
            }
        }

        /** next size - mobile */
        @media (max-width: 480px) {
            .responsive-img {
                max-height: auto;
            }
        }
    </style>
    <style type="text/css">
        p {
            font-family: 'Inter', sans-serif !important;
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

        textarea {
            font-family: 'Inter';
        }

        .next {
            background: #242254;
            color: #fff;
        }

        .next:hover {
            background: #242254 !important;
            color: #fff !important;

        }

        .next:visited {
            background: inherit !important;
        }

        .next:active {
            background: inherit !important;
        }

        .next:disabled {
            background: inherit !important;
        }

        input[type="checkbox"]:checked {
            border-color: red;
            background-color: red;
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
            background: rgba(255, 255, 255, 0.2);
            max-width: 1px;
            margin-left: 19px;
            margin-top: 10px
        }

        .information-circle-disabled {
            background: transparent;
            min-height: 40px;
            min-width: 40px;
            border-radius: 50%;
            border: 2px solid rgba(255, 255, 255, 0.2);
            color: rgba(255, 255, 255, 0.2);
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
            /* color: #6076D1; */
            color: rgba(255, 255, 255, 0.2);
            font-family: 'Inter';
            line-height: 24px;
            margin-top: 15px;
            margin-left: 6px;
        }

        .information-line-disabled {
            min-width: 1px;
            min-height: 32px;
            /* background: #6076D1; */
            background: rgba(255, 255, 255, 0.2);
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

        .progress-bar {
            background: #D61A5F !important;
        }

        .steps>p {
            font-size: 14px !important;
            font-family: "Inter";
        }

        .responsive-img {
            max-height: 88px;
        }

        @media only screen and (max-width: 600px) {
            .dynamic-padding {
                padding-left: 10px !important;
                /* padding-right: 10px !important; */
            }

            .pe-5 {
                padding-right: 0px !important;
            }

            .me-1 {
                margin-right: 0px !important;
            }

            .me-5 {
                margin-right: 0px !important;
            }

            .w-100 {
                width: 98% !important;
            }

            .responsive-img {
                max-height: inherit !important;
            }
        }
    </style>
@endpush
