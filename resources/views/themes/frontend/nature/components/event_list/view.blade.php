@php
    /** @var App\Models\ComponentBuilder $_loadComponentBuilder */
    $componentValue = $_loadComponentBuilder->values;
    $carbonDate = \Carbon\Carbon::now();
    $events = \App\Plugins\Events\Http\Models\Event::where('active',true)
                                                    ->where('event_end_date' , '>',$carbonDate)
                                                    ->orderBy('event_start_date','asc')
                                                    ->with(['getImage' => function($query) {
                                                        $query->with('image');
                                                    }])
                                                    ->limit(8)
                                                    ->get();
@endphp
<section class="event-section secondary-bg" style="background-color:{{$componentValue['background_colour']}}">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <div class="section-head white-section-head text-center animated-line">
                    <div class="back-title">{{$componentValue['background-text']}}</div>
                    <h2 class="section-title">
                        @php
                            $title  = str($componentValue['title']);
                            if ($componentValue['underline_text'] && $title->contains($componentValue['underline_text'])) {

                                $componentValue['title'] = $title->replace($componentValue['underline_text'],'<span class="primary-color">'. $componentValue['underline_text'].'                                 <svg class="title-shape" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 150" preserveAspectRatio="none">
                                <path d="M9.3,127.3c49.3-3,150.7-7.6,199.7-7.4c121.9,0.4,189.9,0.4,282.3,7.2C380.1,129.6,181.2,130.6,70,139 c82.6-2.9,254.2-1,335.9,1.3c-56,1.4-137.2-0.3-197.1,9"></path>
                             </svg></span>');
                            }
                        @endphp
                        {!! $componentValue['title'] !!}
                    </h2>
                    <div class="section-disc">
                        {!! $componentValue['description'] !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="event-inner">
            @foreach ($events as $event)
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
                @endphp
                <div class="event-item">
                    <div class="event-date">
                        <h3>{{$carbonEventDate->format('d')}}</h3>
                        <h4>{{$carbonEventDate->format('M')}}<span>{{$carbonEventDate->format('Y')}}</span></h4>
                    </div>
                    <div class="event-image">
                        <figure>
                            <img src="{{$image}}" alt="{{$event->event_title}}" style="width:88px; height:88px;">
                        </figure>
                    </div>
                    <div class="event-content">
                        <h4>{{$event->event_title}}</h4>
                        {!! $event->intro_description !!}
                    </div>
                    <div class="event-btn text-right">
                        <a href="{{route('frontend.event.event-detail',['slug' => $event->event_slug])}}" class="button-round-secondary">ATTEND EVENT</a>
                    </div>
                </div>
            @endforeach
        </div>

        @if(\App\Models\Menu::where('menu_type','events')->where('active',true)->exists())
            <div class="list-more-btn text-center">
                <a href="/events" class="button-round-primary">EXPLORE ALL EVENT</a>
            </div>
        @endif
    </div>
</section>
