@php
    /** @var App\Models\ComponentBuilder $_loadComponentBuilder */
    $componentValue = $_loadComponentBuilder->values;
    $testimonials = \App\Plugins\Testimonials\Http\Models\Testimonial::orderBy('created_at','desc')->limit(12)->get();
    $glittersBackground = null;
    $featuredBackgroundGlitter = null;
    $imageButtonSide = null;

    if ( $componentValue['glitter'] ) {
        $glittersBackground = \App\Models\GalleryAlbums::where('id',$componentValue['glitter'])
                                                        ->where('active',true)
                                                        ->with(['items' => function($query) {
                                                            $query->with(['getImage' => function($query) {
                                                                $query->with('image');
                                                            }])
                                                            ->limit('3');
                                                        }])
                                                        ->first();
        $featuredBackgroundGlitter = $glittersBackground?->items()->where('featured_background',true)->first();
        $imageButtonSide = $glittersBackground?->items()->where('featured_button',true)->first();
    }

    $styleKey = 'background-image';
    $styleValue = 'url('.$componentValue['background_image'].')';

    if ($componentValue['background_type'] == 'colour') {
        $styleKey = 'background';
        $styleValue = $componentValue['colour'];
    }
@endphp

    <!-- Start Testimonial Area  -->
<div class="eedu-testimonial-area eduvibe-home-two-testimonial bg-color-white testimonial-card-box-bg edu-section-gap position-relative bg-image" style="{{$styleKey}} : {{$styleValue}} !important;background-size: cover">
    <div class="container eduvibe-animated-shape">
        <div class="row g-5">
            <div class="col-lg-12">
                <div class="section-title text-center" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
                    <span class="pre-title">{{$componentValue['subtitle']}}</span>
                    <h3 class="title">{{$componentValue['title']}}</h3>
                </div>
            </div>
        </div>

        <div class="edu-testimonial-activation testimonial-item-3 mt--40 edu-slick-button">

            @foreach ($testimonials as $testimonial)
                <!-- Start Tastimonial Card  -->
                <div class="testimonial-card-box">
                    <div class="inner">
                        <div class="client-info">
                            <div class="thumbnail">
                                <img src="{{\App\Classes\Helpers\Image::getImageAsSize($testimonial->images,'s')}}" alt="{{$testimonial->full_name}}">
                            </div>
                            <div class="content">
                                <h6 class="title">{{$testimonial->full_name}}</h6>
                                <span class="designation">{{$testimonial->profession}}</span>
                            </div>
                        </div>
                        <div class="description">“{!! $testimonial->comment !!}”</div>
                    </div>
                </div>
                <!-- End Tastimonial Card  -->
            @endforeach
        </div>

        <div class="shape-dot-wrapper shape-wrapper d-xl-block d-none">
            @if($glittersBackground)
                @php($count=1)
                @foreach ($glittersBackground->items ?? [] as $items)
                    @continue($items->featured_background)
                    @continue($items->featured_button)

                    @if($count >= 4)
                        @php ($count = 1)
                    @endif
                    <div class="shape-image shape-image-{{$count}}">
                        <img src="{{\App\Classes\Helpers\Image::getImageAsSize($items->getImage()->first()?->image->filepath,'s')}}" alt="Shape Thumb" />
                    </div>
                    @php($count++)
                @endforeach
            @endif

        </div>

    </div>
</div>
<!-- End Testimonial Area  -->

