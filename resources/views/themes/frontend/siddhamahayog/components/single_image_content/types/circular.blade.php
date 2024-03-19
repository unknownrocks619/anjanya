@php
    /** @var App\Models\ComponentBuilder $_loadComponentBuilder */
    $componentValue = $_loadComponentBuilder->values;
    $glittersBackground = null;
    $featuredBackgroundGlitter = null;
    $imageButtonSide = null;

    if ( $componentValue['glitter_background'] ) {
        $glittersBackground = \App\Models\GalleryAlbums::where('id',$componentValue['glitter_background'])
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
    <!-- Start Feature Area  -->
<div class="edu-feature-area eduvibe-home-one-video edu-section-gap bg-color-white" style="{{$styleKey}} : {{$styleValue}} !important; background-size: cover" >
    <div class="container eduvibe-animated-shape">
        <div class="row row--35">
            <!-- Image -->
            <div class="col-lg-6 col-12 order-1 order-lg-1">
                <div class="testimonial-left-image pr--80">
                    <div class="thumbnail">
                        <div class="circle-image-wrapper">
                            <img class="radius-round" src="{{$componentValue['image']}}" alt="{{$componentValue['heading']}}">
                            <div class="circle-image">
                                <span></span>
                                <span></span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-lg-6 col-12 order-2 order-lg-2">
                <div class="inner mt_md--40 mt_sm--40">
                    <div class="section-title text-start" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
                        <span class="pre-title">{!! $componentValue['subtitle'] !!}</span>
                        <h3 class="title">{!! $componentValue['heading'] !!}</h3>
                    </div>
                    <div class="description" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
                        {!! $componentValue['description'] !!}
                    </div>
                    <div class="feature-list-wrapper mt--10">
                        @foreach ($componentValue['bullets'] as $bullet_key => $bulletPoint)
                            <div class="feature-list mt--35 mt_mobile--15" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
                                <div class="content">
                                    <h6 class="title">{!! $bulletPoint !!}</h6>
                                    @if(isset($componentValue['bullets_description'][$bullet_key]))
                                    <div>
                                        {!! $componentValue['bullets_description'][$bullet_key] !!}
                                    </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>

        <div class="shape-dot-wrapper shape-wrapper d-xl-block d-none">
            @if($glittersBackground)
                @php($count=1);
                @foreach ($glittersBackground->items ?? [] as $items)
                    @continue($items->featured_background)
                    @continue($items->featured_button)

                    @if($count >= 3)
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
<!-- End Feature Area  -->
