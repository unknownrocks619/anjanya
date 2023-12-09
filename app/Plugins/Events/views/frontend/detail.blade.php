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
    if ( ! $welcomeImage) {
        $welcomeImage = $event->getImage()->where('type','featured_image')->first();
    }

    if ( $welcomeImage ) {
        $welcome_image = \App\Classes\Helpers\Image::getImageAsSize($welcomeImage->image?->filepath, 'l');
    }

    $eventStartDate = \Carbon\Carbon::createFromFormat('Y-m-d\TH:i', $event->event_start_date);
    $today  = \Carbon\Carbon::now();

    $breadCrumb = [
        ['label' => 'Home','link' => '/'],
        ['label' => 'Events' ,'link' => '/events'],
        ['label' => $event->event_title,'link' => '#'],
    ];
@endphp
@section('page_title') - {{$event->event_title}} @endsection
@section('main')
    {!! $user_theme->partials('page-header',['title' => $event->event_title,'bannerImage' => $banner_image,'breadCrumb' => $breadCrumb]) !!}
    <div class="edu-event-details-area edu-event-details edu-section-gap bg-color-white">
        <div class="container">
            @if($welcome_image)
            <div class="row g-5">
                <div class="col-lg-12">
                    <div class="thumbnail">
                        <img src="{{$welcome_image}}" alt="{{$event->event_title}} Event Image" class="w-100" />
                    </div>
                </div>
            </div>
            @endif
            <div class="row g-5">
                <div class="col-lg-7">
                    <div class="content">
                        <h3 class="title">{{$event->event_title}}</h3>
                        {!! $event->full_description !!}
                    </div>
                    @include('frontend.components.lister', ['model' => $event])

                </div>

                <div class="col-lg-5">
                    <div class="eduvibe-sidebar">
                        <div class="eduvibe-widget eduvibe-widget-details">
                            <h5 class="title">Event Detail</h5>
                            <div class="widget-content">
                                <ul class="mb-2">
                                    <li>
                                        <span>
                                            <i class="icon-calendar-2-line"></i>
                                            Start Date</span><span>{{$eventStartDate->format('d M, Y')}}</span>
                                    </li>

{{--                                    <li>--}}
{{--                                        <span>--}}
{{--                                            <i class="icon-time-line"></i>--}}
{{--                                            Start Time</span>--}}
{{--                                        <span>{{ $eventStartDate->format('H:i A')  }}</span>--}}
{{--                                    </li>--}}

                                    @if($event->event_end_date)
                                        @php
                                            $eventEndDate = \Illuminate\Support\Carbon::createFromFormat('Y-m-d\TH:i',$event->event_end_date);
                                        @endphp
                                        <li>
                                            <span>
                                                <i class="icon-calendar-2-line"></i>
                                                End Date</span><span>{{$eventEndDate->format('d M, Y')}}</span></li>
{{--                                        <li>--}}
{{--                                            <span>--}}
{{--                                                <i class="icon-time-line"></i>--}}
{{--                                                End Time</span>--}}
{{--                                            <span>{{$eventEndDate->format('H:i A')}}</span>--}}
{{--                                        </li>--}}
                                    @endif
                                    @if($event->event_location)
                                        <li>
                                            <span>
                                                <i class="icon-map-pin-line"></i>
                                                Location</span>
                                            <span>{{$event->event_location}}</span>
                                        </li>
                                    @endif

                                    @if($event->event_contact_email)
                                        <li>
                                            <span>
                                                <i class="icon-mail-line-2"></i>
                                                Email
                                            </span>
                                            <span>
                                                {{$event->event_contact_email}}
                                            </span>
                                        </li>
                                    @endif
                                    @if($event->event_contact_number)
                                        <li>
                                            <span>
                                                <i class="icon-phone-fill"></i>
                                                Contact
                                            </span>
                                            <span>
                                                {{$event->event_contact_number}}
                                            </span>
                                        </li>
                                    @endif
                                    @if($event->event_contact_person)
                                        <li>
                                            <span>
                                                <i class="icon-user-line"></i>
                                                Contact Person
                                            </span>
                                            <span>
                                                {{$event->event_contact_person}}
                                            </span>
                                        </li>
                                    @endif
                                </ul>

                                <div class="read-more-btn mt--15">
                                    <a class="edu-btn w-100 text-center" href="{{route('frontend.event.event-registration',['slug' => $event->event_slug])}}">Register For Event</a>
                                </div>

                                <div class="read-more-btn mt--30 text-center">
                                    <div class="eduvibe-post-share">
                                        <span>Share: </span>
                                        <div class="sharethis-inline-share-buttons"></div><!-- ShareThis END -->
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if($event->event_location_iframe)
                            <div class="eduvibe-widget eduvibe-widget-details mt--40">
                                <h5 class="title">Map</h5>
                                <div class="widget-content">
                                    <div class="google-map">
                                        {!! $event->event_location_iframe !!}
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
