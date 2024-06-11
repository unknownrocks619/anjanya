@extends($user_theme->frontend_layout($extends))

@section('page_title')
    {{ $menu->menu_name }}
@endsection

@php
    $bannerImage = null;
    $banner_image = $menu?->getImage()->where('type','banner_image')->first();

    if ( ! $banner_image ) {
        $banner_image = $menu?->getImage()->where('type','featured_image')->first();
    }

    if ($banner_image) {
        $bannerImage = \App\Classes\Helpers\Image::getImageAsSize($banner_image->image->filepath,'l');
    }

@endphp

@section('main')
    {!! $user_theme->partials('page-header',['title' => $menu?->menu_name,'bannerImage' => $bannerImage]) !!}
    <!-- section main content -->
    <!-- Inner Banner html end-->
    <section class="event-page-section bg-light-grey">
        <div class="container">
            @foreach ($events as $event)
                @php
                    $dateBreak = \Illuminate\Support\Carbon::createFromFormat('Y-m-d\TH:i',$event->event_start_date);
                    $eventFeatureImage = $event->getImage?->where('type','featured')->first();

                    if ($eventFeatureImage ) {
                        $eventFeatureImage = \App\Classes\Helpers\Image::getImageAsSize($eventFeatureImage->image->filepath,'s');
                    }
                    if (! $eventFeatureImage ) {
                        $eventFeatureImage = \App\Classes\Helpers\SystemSetting::logo();
                    }
                @endphp
                <div class="event-item">
                    <div class="event-date">
                        <h3>{{$dateBreak->format('d')}}</h3>
                        <h4>{{$dateBreak->format('M')}}<span>{{$dateBreak->format('Y')}}</span></h4>
                    </div>
                    <div class="event-image">
                        <figure>
                            <img src="{{$eventFeatureImage}}" alt="{{$event->event_title}}">
                        </figure>
                    </div>
                    <div class="event-content">
                        <h4>{{$event->event_title}}</h4>
                        {{$event->intro_description}}
                    </div>
                    <div class="event-btn text-right">
                        <a href="{{route('frontend.event.event-detail',['slug' => $event->event_slug])}}" class="button-round-secondary">ATTEND EVENT</a>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection
