
@php
    $title = isset($title) ? 'Most Recent <span>' . $title .'</span>' : 'Blog Post';
    $subtitle = isset($subtitle) ? $subtitle : 'Blog Updates';
    $description = isset($description)  ? $description : '';
    $posts = isset($posts) ? $posts : [];

@endphp

@extends('themes.frontend.kpa.layout.preview-layout')
@section('main')
<div id="commonComponentBuilder">
    <!-- banner ten area end -->
        <!-- blog post area start -->
        <div class="blog-post-ten-area rts-section-gapTop">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="title-area-left-ten center">
                            <span class="pre-title">{{$subtitle}}</span>
                            <h2 class="title">
                                {!! $title !!}
                            </h2>
                        </div>
                    </div>
                    @if(! empty( $description) ) 
                        <div class="col-lg-12 text-center">
                                {!! $description !!}
                        </div>
                    @endif
                </div>
                <div class="row g-5 mt--30">
                    @forelse ($posts as $post)
                        {!! $user_theme->partials('post.grid',['post' => $post]) !!}
                    @empty
                    <div class="col-lg-6">
                        <!-- single blog style ten -->
                        <div class="single-blog-style-ten">
                            <a href="blog-details.html" class="thumbnail">
                                <img src="assets/images/blog/17.png" alt="blog">
                            </a>
                            <div class="information">
                                <div class="blog-top-area">
                                    <div class="single-area">
                                        <i class="far fa-clock"></i>
                                        <span>15 Oct, 2022</span>
                                    </div>
                                   
                                </div>
                                <div class="main-wrapper">
                                    <a href="#">
                                        <h5 class="title">
                                            How Analytics Agencies Shape
                                            Business Strategies
                                        </h5>
                                    </a>
                                    <a class="rts-read-more btn-primary" href="#"><i class="far fa-arrow-right"></i>Read
                                        More</a>
                                </div>
                            </div>
                        </div>
                        <!-- single blog style ten end -->
                    </div>
                    <div class="col-lg-6">
                        <!-- single blog style ten -->
                        <div class="single-blog-style-ten">
                            <a href="blog-details.html" class="thumbnail">
                                <img src="assets/images/blog/18.png" alt="blog">
                            </a>
                            <div class="information">
                                <div class="blog-top-area">
                                    <div class="single-area">
                                        <i class="far fa-clock"></i>
                                        <span>15 Oct, 2022</span>
                                    </div>
                                    <div class="single-area">
                                        <i class="fal fa-user"></i>
                                        <span>by Admin</span>
                                    </div>
                                </div>
                                <div class="main-wrapper">
                                    <a href="blog-details.html">
                                        <h5 class="title">
                                            HR Agencies' Role in Attracting &
                                            Retaining Top Performers
                                        </h5>
                                    </a>
                                    <a class="rts-read-more btn-primary" href="blog-details.html"><i class="far fa-arrow-right"></i>Read
                                        More</a>
                                </div>
                            </div>
                        </div>
                        <!-- single blog style ten end -->
                    </div>
                    <div class="col-lg-6">
                        <!-- single blog style ten -->
                        <div class="single-blog-style-ten">
                            <a href="blog-details.html" class="thumbnail">
                                <img src="assets/images/blog/19.png" alt="blog">
                            </a>
                            <div class="information">
                                <div class="blog-top-area">
                                    <div class="single-area">
                                        <i class="far fa-clock"></i>
                                        <span>15 Oct, 2022</span>
                                    </div>
                                    <div class="single-area">
                                        <i class="fal fa-user"></i>
                                        <span>by Admin</span>
                                    </div>
                                </div>
                                <div class="main-wrapper">
                                    <a href="blog-details.html">
                                        <h5 class="title">
                                            Performance Marketing Agencies
                                            Drive Revenue Growth
                                        </h5>
                                    </a>
                                    <a class="rts-read-more btn-primary" href="blog-details.html"><i class="far fa-arrow-right"></i>Read
                                        More</a>
                                </div>
                            </div>
                        </div>
                        <!-- single blog style ten end -->
                    </div>
                    <div class="col-lg-6">
                        <!-- single blog style ten -->
                        <div class="single-blog-style-ten">
                            <a href="blog-details.html" class="thumbnail">
                                <img src="assets/images/blog/20.png" alt="blog">
                            </a>
                            <div class="information">
                                <div class="blog-top-area">
                                    <div class="single-area">
                                        <i class="far fa-clock"></i>
                                        <span>15 Oct, 2022</span>
                                    </div>
                                    <div class="single-area">
                                        <i class="fal fa-user"></i>
                                        <span>by Admin</span>
                                    </div>
                                </div>
                                <div class="main-wrapper">
                                    <a href="blog-details.html">
                                        <h5 class="title">
                                            What Content Marketing Agencies
                                            Rule the Online Realm
                                        </h5>
                                    </a>
                                    <a class="rts-read-more btn-primary" href="blog-details.html"><i class="far fa-arrow-right"></i>Read
                                        More</a>
                                </div>
                            </div>
                        </div>
                        <!-- single blog style ten end -->
                    </div>
                        
                    @endforelse
                </div>
            </div>
        </div>
        <!-- blog post area end -->
    
</div>
@endsection
