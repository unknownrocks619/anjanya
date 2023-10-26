@php
    /** @var  \App\Plugins\Events\Http\Models\Event $event */
    $startTime = \Carbon\Carbon::createFromFormat('Y-m-d\TH:i',$event->event_start_date);
    $endTime = \Carbon\Carbon::createFromFormat('Y-m-d\TH:i',$event->event_end_date);
    $today = \Carbon\Carbon::now();
@endphp
<div class="sidebar">
    <div class="widget widget-bg widget-detail">
        <h4 class="bg-title">Event details</h4>
        <ul>
            <li class="d-flex">
                <h5>Starting time</h5>
                <span>{{$startTime->format('h:i A')}} to {{$endTime->format('h:i A')}}</span>
            </li>
            <li class="d-flex">
                <h5>Event date</h5>
                <span>{{$startTime->format('Y-m-d')}} to {{$endTime->format('Y-m-d')}}</span>
            </li>
            @if($event->event_contact_person)
                <li class="d-flex">
                    <h5>Contact Person</h5>
                    <span>{{$event->event_contact_person}}</span>
                </li>
            @endif
            @if($event->event_contact_number)
            <li class="d-flex">
                <h5>Phone number</h5>
                <span>{{$event->event_contact_number}}</span>
            </li>
            @endif
            @if($event->event_location)
            <li class="d-flex">
                <h5>Location</h5>
                <span>{{$event->event_location}}</span>
            </li>
            @endif
        </ul>
    </div>
    @if($event->event_location_iframe)
    <div class="widget widget-map">
        {!! $event->event_location_iframe !!}
    </div>
    @endif
    @if($events->where('id','!=',$event->getKey())->count())
        <div class="widget widget-bg icon-list-content text-center">
            <h4 class="bg-title">Upcoming events</h4>
            <ul>
                @foreach ($events as $upcomingEvent)
                    @if($upcomingEvent->getKey() == $event->getKey())
                        @php continue; @endphp
                    @endif
                    <li>
                        <a class="d-flex" href="{{route('frontend.event.event-detail',['slug' => $upcomingEvent->event_slug])}}">
                            <i class="icon icon-arrow-right-circle"></i>{{$upcomingEvent->event_title}}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
{{--    <div class="widget widget-bg information-content widget-bg-image text-center" style="background-image: url(assets/images/banner-img.jpg);">--}}
{{--        <h3>Join together for charity</h3>--}}
{{--        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.</p>--}}
{{--        <a href="#" class="button-round-primary">GET A QUOTE</a>--}}
{{--    </div>--}}
</div>
