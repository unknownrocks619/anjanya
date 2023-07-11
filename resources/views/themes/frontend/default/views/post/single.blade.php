@extends($user_theme->frontend_layout($extends))

@section('page_title')
    | {{ $post->title }}
@endsection


@push('page_settings')
    <link rel="stylesheet" href="{{ asset('frontend/css/dropzone.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/font-awesome.css') }}">
@endpush

@section('main')
    <!-- site wrapper -->
    <div class="site-wrapper">

        <div class="main-overlay"></div>


        <!-- PageTitle -->
        {!! $user_theme->partials('post/cover', ['post' => $post, 'category' => $category]) !!}
        <!-- PageTitle -->

        <!-- section main content -->
        <section class="sidebar-content">
            <div class="container-xl">

                <div class="row gy-4 mt-4">

                    <div class="col-lg-8">
                        <!-- post single -->
                        <div class="post post-single">
                            <!-- post content -->
                            <div class="post-content clearfix">
                                {!! $post->full_description !!}
                            </div>
                            <!-- post bottom section -->
                            <div class="post-bottom">
                                <div class="row d-flex align-items-center">
                                    <div class="col-md-7 col-12 text-center text-md-start">
                                        <!-- tags -->
                                        @php
                                            $categories = $post->getCategories();
                                        @endphp
                                        @foreach ($categories as $category)
                                            <a href="#" class="tag">#{{ $category->category_name }}</a>
                                        @endforeach
                                    </div>
                                    <div class="col-md-5 col-12">
                                        <!-- social icons -->
                                        <!-- ShareThis BEGIN -->
                                        <div class="sharethis-inline-share-buttons"></div><!-- ShareThis END -->
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="spacer" data-height="50"></div>

                        {{ $user_theme->partials('post.author', ['post' => $post, 'category' => $category]) }}

                        <div class="spacer" data-height="50"></div>

                        <!-- section header -->

                        <div class="spacer" data-height="50"></div>

                        <!-- section header -->
                        <div class="section-header">
                            <h3 class="section-title">Leave Comment</h3>
                            <img src="{{ asset('images/wave.svg') }}" class="wave" alt="wave" />
                        </div>
                        <!-- comment form -->
                        <div class="comment-form rounded bordered padding-30">
                            {!! $user_theme->partials('comment', ['post' => $post, 'category' => $category]) !!}
                        </div>
                    </div>

                    <div class="col-lg-4">

                        {!! $user_theme->partials('post.sidebar', ['post' => $post, 'category' => $category]) !!}

                    </div>

                </div>

            </div>
        </section>

    </div><!-- end site wrapper -->
@endsection
