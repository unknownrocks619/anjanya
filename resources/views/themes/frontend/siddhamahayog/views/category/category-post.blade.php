@php
    /** @var \App\Models\Category $category */
    $bannerImage = $category->getImage()->where('type','banner_image')->first();

    if ($bannerImage ) {
        $bannerImage = \App\Classes\Helpers\Image::getImageAsSize($bannerImage->image?->filepath,'xl');
    }
    $posts = $category::getPosts([$category->getKey()]);

@endphp

@extends($user_theme->frontend_layout($extends))

@section('page_title', ' | '. $category->category_name)

@section('main')
    {!! $user_theme->partials('page-header',['bannerImage' => $bannerImage,'title' => $category->category_name]) !!}
    
    <div class="container">
        <div class="row g-5 my-2">
            <div class="col-lg-12">
                <div class="row g-5">

                    @foreach ($posts as $post)
                        <div class="col-lg-4 col-md-6 col-12">
                            {!! $user_theme->partials('post.lister',['post' => $post,'category' => $category]) !!}
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection