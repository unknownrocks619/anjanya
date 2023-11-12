@php
    /** @var \App\Models\Category $category */
    $bannerImage = $category->getImage()->where('type','banner_image')->first();
    if ($bannerImage ) {
        $bannerImage = \App\Classes\Helpers\Image::getImageAsSize($bannerImage->image?->filepath,'xl');
    }
    $posts = $category::getPosts([$category->getKey()]);
@endphp
@extends($user_theme->frontend_layout($extends))

@section('page_title')
    {{ $category->category_name }}
@endsection
@section('main')
    {!! $user_theme->partials('page-header',['bannerImage' => $bannerImage,'title' => $category->category_name]) !!}
    <!-- section main content -->
    <div class="archive-section blog-archive">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 primary right-sidebar">
                    <!-- blog post item html start -->
                    <div class="grid blog-inner row">
                        @foreach ($posts as $post)
                            {!! $user_theme->partials('post.lister',['post' => $post,'category' => $category]) !!}
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
