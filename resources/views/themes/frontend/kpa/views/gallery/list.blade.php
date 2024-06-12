@php
    /** @var  \App\Models\Menu $menu */
    $bannerImage = null;
    // get Banner Image from $page.
        $banner_image = $menu?->getImage()->where('type','banner_image')->first();
    if ( ! $banner_image ) {
        $banner_image = $menu?->getImage()->where('type','featured_image')->first();
    }

    if ($banner_image) {
        $bannerImage = \App\Classes\Helpers\Image::getImageAsSize($banner_image->image->filepath,'l');
    } else {
        $bannerImage = asset('images/breadcrumb-banner.jpeg');

    }
    // if Banner image is not available from page, try from menu.
    $post = new App\Models\Post;
    $post->title = $menu->menu_name
@endphp

@extends($user_theme->frontend_layout($extends,['cover' => $bannerImage,'post' => $post]))

@section('page_title', $menu->menu_name)

@section('main')
    {!! $user_theme->partials('post.cover',['post' => $post]) !!}
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-12">
                <div class="title-area-left-ten center">
                    <h2 class="title">
                        <span>{{$menu->menu_name}}</span>
                    </h2>
                </div>
                @if($menu->description)
                    <div class="desc text-center">{!! $menu->description !!}</div>
                @endif
            </div>
        </div>
        @include('frontend.components.lister', ['model' => $menu])

    </div>


@endsection

@push('page_setting')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/css/lightbox.css" />
@endpush
@push('page_script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/js/lightbox.min.js"></script>
    <script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
    <script>
    $(()=>{

        if ($('.grid').length && $('.grid-item').length) {
            $('.grid').masonry({
                itemSelector : '.grid-item'
            })
        }
    })
    </script>
@endpush
