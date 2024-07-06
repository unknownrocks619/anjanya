@php
    $categoriesID = array_keys($categories->groupBy('connected_id')->toArray());
    $categories = App\Models\Category::whereIn('id',$categoriesID)->where('active',true)->get();
    $displayType = 'posts';
    $posts = App\Models\Category::getPosts($categoriesID);

    /**
     * Check if categories have product based category
     * If true, than display one product based category.
     * */
    if ($categories->where('category_type','product')->count()) {
        $displayType = 'products';
        $posts = App\Plugins\Product\Http\Models\ProductCategory::whereIn('id_cat',$categoriesID)->with('product')->get();
    }


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
    $post->title = $menu->menu_name;

@endphp
@extends($user_theme->frontend_layout($extends))

@section('page_title')
    {{ $menu->menu_name }}
@endsection

@section('main')
{!! $user_theme->partials('post.cover',['post' => $post]) !!}

<div class="rts-blog-grid-area rts-section-gap">
    <div class="container-xl">
        <div class="row mt-2">
            <div class="@if (\App\Classes\Helpers\SystemSetting::PageConfiguration('sidebar', true)) col-md-8 sidebar-content @else col-md-12 @endif">
                @if($displayType == 'products')
                    @include('Product::frontend.products.product-list',['products' => $posts])
                @else
                    <div class="row">
                        @foreach ($posts as $post)
                            @php $post->cat_slug = $menu->slug; @endphp
                            {!! $user_theme->partials('post.grid',['post' => $post]) !!}
                        @endforeach
                    </div>
                @endif
            </div>
            @if (\App\Classes\Helpers\SystemSetting::PageConfiguration('sidebar', true))
                <div class="col-md-4">
                    <div class="sidebar">
                        @foreach (\App\Classes\Helpers\SystemSetting::PageConfiguration('sidebar', true, 'additonal_text') as $widget)
                            {!! $user_theme->widget($widget) !!}
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
        @include('frontend.components.lister', ['model' => $menu])

    </div>
</div>
@endsection
