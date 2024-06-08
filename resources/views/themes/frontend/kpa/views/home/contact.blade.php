@php
$featuredImage = $menu->getImage()->where('type','banner_image')->latest()->first();
$enableColorAlter = true;

if ( ! $featuredImage ) {
    $featuredImage = $menu->getImage()->where('type','background')->latest()->first();
}

if ( $featuredImage) {
    $enableColorAlter = false;
    $featuredImage = App\Classes\Helpers\Image::getImageAsSize($featuredImage->image->filepath,'m');
} else {
    $featuredImage = asset('images/breadcrumb-banner.jpeg');
}
$post = new App\Models\Post;
$post->title = $menu->menu_name;

@endphp
@extends($user_theme->frontend_layout($extends))
@section("page_title"){{$menu->menu_name}}@endsection

@section('main')
    {{$user_theme->partials('post.cover',['post' => $post,'coverImage' => $featuredImage,'enableColorAlter' => $enableColorAlter])}}
    <div class="rts-contact-area rts-section-gap">
        <div class="container g-5">
            <div class="row">
                <div class="col-md-12">
                    @include('frontend.components.lister', ['model' => $post])
                </div>
            </div>
        </div>
    </div>
@endsection