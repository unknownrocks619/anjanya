@php
    $componentValue = $_loadComponentBuilder->values;
    $description = $componentValue['description'];
    $subtitle = $componentValue['subtitle'];
    $title = $componentValue['title'];
    $categoriesPost = App\Models\Category::getPosts($componentValue['categories'],6);
@endphp
<!-- banner ten area start -->
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
                                Most Recent <span>{{$title}}</span>
                            </h2>
                        </div>
                        @if($description)
                            <div class="desc text-center">{!! $description !!}</div>
                        @endif
                    </div>
                </div>
                <div class="row g-5 mt--30">
                    @foreach ($categoriesPost as $post)
                        {!! $user_theme->partials('post.grid',['post' => $post]) !!}
                    @endforeach
                </div>
            </div>
        </div>
        <!-- blog post area end -->
    
</div>
<!-- banner ten area end -->