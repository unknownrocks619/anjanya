@php
    /** @var  \App\Plugins\Events\Http\Models\Event $event */
    $bannerImage = $event->getImage()->where('type','banner_image')->first();
    $banner_image = null;

    if ($bannerImage) {
        $banner_image = \App\Classes\Helpers\Image::getImageAsSize($bannerImage->image?->filepath, 'l');
    }
    $breadCrumb = [
        ['label' => 'Home','link' => '/'],
        ['label' => 'Events' ,'link' => '/events'],
        ['label' => $event->event_title,'link' => route('frontend.event.event-detail',['slug' => $event->event_slug])],
        ['label' => 'Registration' ,'link' => '#']
    ];
@endphp
@extends($user_theme->frontend_layout($extends))
@section('page_title') - {{$event->event_title}} @endsection
@section('main')
    {!! $user_theme->partials('page-header',['title' => $event->event_title,'bannerImage' => $banner_image,'breadCrumb' => $breadCrumb]) !!}
    <div id="event-registration-wrapper-elm" data-event-id="{{$event->getKey()}}" data-event-slug="{{$event->event_slug}}">

    </div>
@endsection
