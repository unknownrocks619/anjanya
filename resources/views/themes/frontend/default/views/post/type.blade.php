@extends($user_theme->frontend_layout($extends))

@section('title')
    {{ ucwords($postType) }}
@endsection

@section('main')
    {!! $user_theme->partials('pre-loader', ['title' => ucwords($postType)]) !!}

    <!-- site wrapper -->
    <div class="site-wrapper">

        <div class="main-overlay"></div>

        {!! $user_theme->partials('header') !!}

        <!-- PageTitle -->
        {!! $user_theme->partials('page-header', ['title' => ucwords($postType)]) !!}
        <!-- PageTitle -->

        <!-- section main content -->
        <section class="main-content mt-0">
            <div class="container-xl">
                <div class="row gy-4 mt-2">
                    @foreach ($posts as $post)
                        {!! $user_theme->partials('post.detail-card', ['post' => $post]) !!}
                    @endforeach

                    <div class="col-md-12 d-flex justify-content-center">{{ $posts->links() }}</div>

                </div>
            </div>
        </section>

        {!! $user_theme->partials('footer-master') !!}
    </div><!-- end site wrapper -->

    <!-- search popup area -->
    {!! $user_theme->partials('search-popup') !!}

    <!-- canvas menu -->
    {!! $user_theme->partials('canvas_menu') !!}
@endsection
