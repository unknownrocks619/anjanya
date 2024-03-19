@php
    /** @var \App\Plugins\Events\Http\Models\Event $event */

    $heroSliderStart = 100;
    $carbonEventDate = \Carbon\Carbon::createFromFormat('Y-m-d\TH:i', $event->event_start_date);
    $image = null;
    $eventImage = $event->getImage()
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
<!-- Start Event Grid   -->
<div class="col-12 col-sm-12 col-xl-4 col-md-6" data-sal-delay="{{$heroSliderStart}}" data-sal="slide-up" data-sal-duration="800">
    <div class="edu-event event-grid-1 radius-small">
        <div class="inner">
            <div class="thumbnail">
                <a href="{{route('frontend.event.event-detail',['slug' => $event->event_slug])}}">
                    <img src="{{$image}}" alt="Event Images ">
                </a>
                <div class="top-position status-group left-top">
                    <span class="eduvibe-status status-06">{{$carbonEventDate->format('d M Y')}}</span>
                </div>
            </div>
            <div class="content">
                @if($event->event_location)
                    <ul class="event-meta">
                        <li><i class="icon-map-pin-line"></i>{{$event->event_location}}</li>
                    </ul>
                @endif
                <h5 class="title">
                    <a href="{{route('frontend.event.event-detail',['slug' => $event->event_slug])}}">
                        {{$event->event_title}}</a>
                </h5>
                <div class="read-more-btn">
                    <a class="btn-transparent" href="{{route('frontend.event.event-detail',['slug' => $event->event_slug])}}">
                        View Detail
                        <i class="icon-arrow-right-line-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Event Grid   -->
