<div class="container pt-4 mt-2">
    @if (isset($menu) && isset($menu->getImage) && count($menu->getImage))
        @php
            $bannerImageRelation = $menu
                ->getImage()
                ->where('type', 'banner_image')
                ->first();
            $bannerImage = null;
            if ($bannerImageRelation) {
                $bannerImage = $bannerImageRelation->image;
            }
            
        @endphp
        @if ($bannerImage)
            <div class="row">
                <div class="col-md-12"
                    style="min-height: {{ $bannerImage->sizes->height }}px;background:url({{ \App\Classes\Helpers\Image::getImageAsSize($bannerImage, 'm') }});background-size:contain;background-repeat:no-repeat;background-position:center">

                </div>
            </div>
        @endif
    @endif
    <div class="row ">
        <div class="col-md-12">
            <div class="form-group">
                <div class="search-input position-relative">
                    <input type="text" placeholder="Search by title, author name or country">
                    <a href="javascript:void(0)" class="search-icon">
                        <span class="iconify" data-icon="ri:search-line"></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    @foreach ($bundles as $bundle)
        <div class="col-md-4 col-4 mb-4 mt-3">
            <div class="card">
                <div class="card-img">
                    @if ($bundle->getImage()->count())
                        @php
                            // get featured or cover image.
                            $image = $bundle
                                ->getImage()
                                ->where('type', 'cover_image')
                                ->first();
                            
                            if (!$image) {
                                $image = $bundle
                                    ->getImage()
                                    ->where('type', 'featured_image')
                                    ->first();
                            }
                            
                            if (!$image) {
                                $image = $bundle
                                    ->getImage()
                                    ->latest()
                                    ->first();
                            }
                            
                            $image = $image->image;
                        @endphp
                        <img src="{{ \App\Classes\Helpers\Image::getImageAsSize($image, 'm') }}"
                            alt="{{ $bundle->bundle_title }}" class="w-100">
                    @else
                        <img src="{{ asset('missing-image.png') }}" alt="{{ $bundle->bundle_title }}" class="w-100">
                    @endif
                </div>
                <div class="card-content px-md-3 px-2" style="background:#F4F4F4">
                    <div class="fs-16 fw-600 my-2 textAdd text-center">
                        <div class="fs-16 fw-600 text-900">
                            <div class="fs-22 fw-700 text-900">{{ $bundle->bundle_title }}</div>
                            <div class="fs-14 t-elip">
                                {!! $bundle->intro_text !!}
                            </div>
                        </div>
                        <div class="seller-button">
                            <a href="{{ route('frontend.books.bundle_show', ['slug' => $bundle->slug]) }}"
                                class="more-btn mt-md-3 w-100">Read More</a>
                        </div>
                    </div>
                </div>
    @endforeach
</div>
