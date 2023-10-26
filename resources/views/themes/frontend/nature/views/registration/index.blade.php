@extends($user_theme->frontend_layout($extends))

@section('page_title')
    Registration
@endsection

@push('page_setting')
    <link rel="stylesheet" href="{{ asset('frontend/css/dropzone.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/font-awesome.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    @vite(['resources/css/registration.css'])
    <!-- Hello world -->
@endpush

@section('main')
    {!! $user_theme->partials('page-header', ['title' => 'Membership Registration','bannerImage' => asset('images/registration-background.jpg')]) !!}
    <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    @include('frontend.registration.sidebar.aside')
                </div>

                <div class="col-md-9 main_registration_content" data-current-step={{ $current_step }}>
                    @include(
                        'frontend.registration.steps.' .
                            \App\Models\User::REGISTRATION_STEPS[$current_step]
                    )
                </div>
            </div>
    </div>
    <!-- end site wrapper -->
@endsection
@push('page_script')
    <script src="https://kit.fontawesome.com/cb35896f9c.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    @vite(['resources/js/frontend_partials/registration.js'])
@endpush
