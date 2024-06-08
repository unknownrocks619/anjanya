@php
    if ( ! isset ($coverImage)){
    $bannerImage = $post
        ->getImage()
        ->where('type', 'banner_image')
        ->first();
    
    $image = asset('images/breadcrumb-banner.jpeg');
    $enableColorAlter = true;
    if ($bannerImage) {
        $image = $bannerImage->image;
        $image = \App\Classes\Helpers\Image::getImageAsSize($image->filepath, 'm');
        $enableColorAlter = false;
    }
} else {
    $image = $coverImage;
}

@endphp
<!-- cover header -->
<section class="single-cover data-bg-image" data-bg-image="{{ $image }}">

    <div class="container-xl">

        <div class="cover-content post">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a
                            href="{{ \App\Classes\Helpers\SystemSetting::basic_configuration('host') }}">Home</a></li>
                    @if(isset($category))
                    <li class="breadcrumb-item">
                        <a
                            href="{{ route('frontend.category.detail', ['slug' => $category?->slug]) }}">{{ $category?->category_name }}</a>
                    </li>
                    @endif
                    <li class="breadcrumb-item active  @if($enableColorAlter === true) text-white @endif" aria-current="page">{{ $post->title }}</li>
                </ol>
            </nav>

            <!-- post header -->
            <div class="post-header">
                <h1 class="title mt-0 mb-3  @if($enableColorAlter === true) text-white @endif">{{ $post->title }}</h1>

                @if($post->updated_at)

                    <ul class="meta list-inline mb-0">

                        <li class="list-inline-item">
                            <a href="#">
                                <img src="{{ \App\Classes\Helpers\SystemSetting::logo() }}" class="author"
                                    alt="{{ \App\Classes\Helpers\SystemSetting::basic_configuration('site_name') }}"
                                    style="width:30px;height:30px;" />
                            </a>
                        </li>

                        <li class="list-inline-item">
                            {{ \App\Classes\Helpers\SystemSetting::basic_configuration('site_name') }}</li>
                        <li class="list-inline-item">{{ date('d M Y', strtotime($post->updated_at)) }}</li>
                    </ul>

                @endif
            </div>
        </div>

    </div>

</section>
