@php
    $bannerImage = $page->getImage->where('type', 'banner_image')->first();
    if ($bannerImage) {
        $bannerImage = App\Classes\Helpers\Image::getImageAsSize($bannerImage->image->filepath, 'm');
    } else {
        $bannerImage = asset('images/breadcrumb-banner.jpeg');
    }
    $post = new App\Models\Post();
    $post->title = $page->title;
@endphp
@extends($user_theme->frontend_layout($extends))
@section('page_title')
    {{ $page->title }}
@endsection

@section('main')
    {{-- {!! $user_theme->partials('post.cover', ['post' => $post]) !!} --}}
    @include('frontend.components.lister', ['model' => $page])
@endsection
