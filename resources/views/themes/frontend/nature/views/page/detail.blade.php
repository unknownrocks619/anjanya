@php
    /** @var  \App\Models\Page $page */
    $pageFeaturedImage = $page
        ->getImage()
        ->where('type', 'featured_image')
        ->first();
    $banner_image = $page->getImage()->where('type','banner_image')->first();

    if ($banner_image ) {
        $banner_image =\App\Classes\Helpers\Image::getImageAsSize($banner_image->image?->filepath, 'm');
    }

    $image = null;
    if ($pageFeaturedImage) {
        $image = \App\Classes\Helpers\Image::getImageAsSize($pageFeaturedImage->image?->filepath, 'm');
    }


@endphp

@extends($user_theme->frontend_layout($extends))

@section('page_title')
    {{ $page->title }}
@endsection

@section('main')
    {!! $user_theme->partials('blog-page-header',['backgroundImage' => $banner_image,'title' => $page->title,'date' => date('F d, Y', strtotime($page->updated_at))]) !!}
    <!-- section main content -->
    <section class=" about-page-section mt-0">
        <div class="container-xl">
            <div class="row gy-4 mt-2">
                <div class="@if (\App\Classes\Helpers\SystemSetting::PageConfiguration('sidebar', true)) col-md-8 sidebar-content @else col-md-12 @endif">
                    <div class="page-content bordered rounded padding-30">

                        @if ($image)
                            <img src="{{ $image }}" alt="{{ $page->title }}" class="rounded mb-4 w-100" />
                        @endif

                        {!! $page->full_description !!}
                        <hr class="my-4">


                        <div class="sharethis-inline-share-buttons"></div><!-- ShareThis END -->

                    </div>
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
        </div>
    </section>
    @include('frontend.components.lister', ['model' => $page])

@endsection
