@extends($user_theme->frontend_layout($extends))

@section('page_title')
    Registration
@endsection


@push('page_settings')
    <link rel="stylesheet" href="{{ asset('frontend/css/dropzone.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/font-awesome.css') }}">
@endpush

@section('main')
    {!! $user_theme->partials('pre-loader', ['title' => 'Membership Registration']) !!}

    <!-- site wrapper -->
    <div class="site-wrapper">

        <div class="main-overlay"></div>

        {!! $user_theme->header() !!}

        <!-- PageTitle -->
        {!! $user_theme->partials('page-header', ['title' => 'Membership Registration']) !!}
        <!-- PageTitle -->

        <!-- section main content -->
        <section class="main-content mt-0">
            <div class="container-fluid">
                <div class="card border-0" style="height:100% !important;box-shadow: none">
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
            </div>
        </section>

        <!-- footer -->
        {!! $user_theme->partials('footer-master') !!}

    </div><!-- end site wrapper -->

    <!-- search popup area -->
    <div class="search-popup">
        <!-- close button -->
        <button type="button" class="btn-close" aria-label="Close"></button>
        <!-- content -->
        <div class="search-content">
            <div class="text-center">
                <h3 class="mb-4 mt-0">Press ESC to close</h3>
            </div>
            <!-- form -->
            <form class="d-flex search-form">
                <input class="form-control me-2" type="search" placeholder="Search and press enter ..."
                    aria-label="Search">
                <button class="btn btn-default btn-lg" type="submit"><i class="icon-magnifier"></i></button>
            </form>
        </div>
    </div>

    {!! $user_theme->partials('canvas_menu') !!}
@endsection
