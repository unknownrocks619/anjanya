@php
    /** @var App\Models\ComponentBuilder $_loadComponentBuilder */
    $componentValue = $_loadComponentBuilder->values;

    $carbonDate = \Carbon\Carbon::now();

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

    $events = \App\Plugins\Events\Http\Models\Event::where('active',true)
                                                    ->where('event_end_date' , '>',$carbonDate)
                                                    ->orderBy('event_start_date','asc')
                                                    ->with(['getImage' => function($query) {
                                                        $query->with('image');
                                                    }])
                                                    ->limit(8)
                                                    ->get();
    $styleKey = 'background-image';
    $styleValue = 'url('.$componentValue['background_image'].')';

    if ($componentValue['background-type'] == 'colour') {
        $styleKey = 'background';
        $styleValue = $componentValue['background_colour'];
    }
    $heroSliderStart = 100;
@endphp
@if($events->count())
    <!-- Start Event Area  -->
<div class="edu-event-area eduvibe-home-two-event edu-section-gap bg-image video-gallery-overlay-area" style="{{$styleKey}}:{{$styleValue}} !important;background-size: cover;padding-top:0px !important;">
    <div class="container eduvibe-animated-shape">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title text-center" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
                    <span class="pre-title">{{$componentValue['subtitle']}}</span>
                    <h3 class="title">{{$componentValue['title']}}</h3>
                </div>
            </div>
        </div>
        <div class="row g-5 mt--25">

            @foreach($events as $event)
                @php
                    $carbonEventDate = \Carbon\Carbon::createFromFormat('Y-m-d\TH:i', $event->event_start_date);
                    $images = null;
                        $eventImage = $event
                                            ->getImage()
                                            ->where('type', 'featured_image')
                                            ->first();
                        if ($eventImage) {
                            $image = \App\Classes\Helpers\Image::getImageAsSize($eventImage->image?->filepath, 'm');
                        }
                        if ( ! $image ) {
                            $eventImage= $event->getImage()->where('type','welcome_image')
                                                ->first();
                            if ( $eventImage ) {
                                $image = \App\Classes\Helpers\Image::getImageAsSize($eventImage->image?->filepath, 'm');
                            }
                        }
                        if ( ! $image ) {
                            $image = \App\Classes\Helpers\SystemSetting::logo();
                        }
                        $heroSliderStart = $heroSliderStart + 50;
                @endphp

                <!-- Start Event List  -->
                <div class="col-lg-12" data-sal-delay="{{$heroSliderStart}}" data-sal="slide-up" data-sal-duration="800">
                    <div class="edu-event event-list radius-small bg-white">
                        <div class="inner">
                            <div class="thumbnail">
                                <a href="{{route('frontend.event.event-detail',['slug' => $event->event_slug])}}">
                                    <img src="{{$image}}" alt="Event Images">
                                </a>
                            </div>
                            <div class="content">
                                <div class="content-left">
                                    <h5 class="title"><a href="{{route('frontend.event.event-detail',['slug' => $event->event_slug])}}">
                                            {{$event->event_title}}
                                        </a></h5>
                                    <ul class="event-meta">
                                        <li><i class="icon-calendar-2-line"></i>{{$carbonEventDate->format('dS F Y')}}</li>
                                        @if($event->event_location)
                                            <li><i class="icon-map-pin-line"></i>{{$event->event_location}}</li>
                                        @endif
                                    </ul>
                                </div>
                                <div class="read-more-btn">
                                    <a class="edu-btn btn-dark" href="{{route('frontend.event.event-detail',['slug' => $event->event_slug])}}">Event Detail<i class="icon-arrow-right-line-right"></i></a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- End Event List  -->
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
            <div class="shape shape-1"><span class="shape-dot"></span></div>
        </div>
    </div>
</div>
<!-- End Event Area  -->
@endif
