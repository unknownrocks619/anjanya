@php
    /** @var \App\Models\Menu $menu */
    $bannerImage = $menu->getImage()->where('type','banner_image')->first();
    if ($bannerImage ) {
        $bannerImage = \App\Classes\Helpers\Image::getImageAsSize($bannerImage->image?->filepath,'xl');
    }
@endphp
@extends($user_theme->frontend_layout($extends))

@section('page_title')
    {{ $menu->menu_name }}
@endsection
@section('main')
    {!! $user_theme->partials('page-header',['bannerImage' => $bannerImage,'title' => $menu->menu_name]) !!}
    <!-- section main content -->
    <div class="archive-section blog-archive">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 primary right-sidebar">
                    <!-- blog post item html start -->
                    <div class="grid blog-inner row">
                        @foreach ($categories as $category)
                            @php
                                $image = \App\Classes\Helpers\SystemSetting::logo();
                                    if ( $category instanceof \App\Models\Connector) {

                                        $category = \App\Models\Category::where('id',$category->connected_id)->with(['getImage'=> function($query) {
                                            $query->with('image');
                                        }])->first();

                                    }
                            @endphp
                            {!! $user_theme->partials('category.lister',['category' => $category]) !!}
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
