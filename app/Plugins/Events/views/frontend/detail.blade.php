@extends($user_theme->frontend_layout($extends))
@php
    /** @var  \App\Plugins\Events\Http\Models\Event $event */
    $bannerImage = $event->getImage()->where('type','banner_image')->first();
    $welcomeImage = $event->getImage()->where('type','welcome_image')->first();
    $banner_image = null;
    $welcome_image = null;
    if ($bannerImage) {
        $banner_image = \App\Classes\Helpers\Image::getImageAsSize($bannerImage->image?->filepath, 'l');
    }
    if ($welcomeImage) {
        $welcome_image = \App\Classes\Helpers\Image::getImageAsSize($welcomeImage->image?->filepath, 'l');
    }
    $eventStartDate = \Carbon\Carbon::createFromFormat('Y-m-d\TH:i', $event->event_start_date);
    $today  = \Carbon\Carbon::now();
@endphp
@section('page_title') - {{$event->event_title}} @endsection
@section('main')
    @include('Events::frontend.partials.banner',['event' => $event,'banner_image' => $banner_image,'events' => $events])
    <section class="event-page-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 primary right-sidebar">
                    <div class="event-detail-container">
                        @if($welcome_image)
                            <figure class="event-feture-img">
                                <img src="{{$welcome_image}}" alt="{{$event->event_titles}}">
                            </figure>
                            @if( ! $eventStartDate->lessThan($today))
                                <div class="time-counter-wrap">
                                    <div class="time-counter" data-date="{{$eventStartDate->format('Y-m-d H:i:s')}}">
                                        <!-- Date Formate Input yyyy-mm-dd hh:mm:ss -->
                                        <div class="counter-time">
                                            <span class="counter-days">00</span>
                                            <span class="label-text">Days</span>
                                        </div>
                                        <div class="counter-time">
                                            <span class="counter-hours">00</span>
                                            <span class="label-text">Hours</span>
                                        </div>
                                        <div class="counter-time">
                                            <span class="counter-minutes">00</span>
                                            <span class="label-text">Minutes</span>
                                        </div>
                                        <div class="counter-time">
                                            <span class="counter-seconds">00</span>
                                            <span class="label-text">Seconds</span>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endif
                        <h2>{{$event->event_title}}</h2>
                        <!-- Time count down html -->
                        <div class="event-text">
                            {!! $event->full_description !!}
                        </div>
                    </div>
                    @include('frontend.components.lister', ['model' => $event])
                </div>
                <div class="col-lg-4 secondary">
                    @include('Events::frontend.partials.sidebar',['event' => $event,'events' => $events])
                </div>
            </div>
        </div>
    </section>
@endsection
