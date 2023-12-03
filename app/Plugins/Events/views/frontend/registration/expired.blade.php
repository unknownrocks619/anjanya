@php
    /** @var  \App\Plugins\Events\Http\Models\Event $event */
    $bannerImage = $event->getImage()->where('type','banner_image')->first();
@endphp
@extends($user_theme->frontend_layout($extends))
@section('page_title') - {{$event->event_title}} @endsection
@section('main')
    <div class="eduvibe-coming-soon edu-coming-soon-area edu-coming-soon-style ptb--150 ptb_md--80 ptb_sm--80 bg-image" @if($bannerImage) style="background: {{\App\Classes\Helpers\Image::getImageAsSize($bannerImage->image->filepath,'l')}}" @endif>
        <div class="container eduvibe-animated-shape">
            <div class="row g-5">
                <div class="col-xl-10 offset-xl-1">
                    <div class="content text-center">

                        <h1 class="title">Oops !! <br /> <span class="text-primary" style="color: #f86f03 !important;">{{$event->event_title}}</span> <br /> <span class="text-danger">Has Expired</span></h1>
                        <p class="description">
                            Don't worry we got you cover. If you don't want to miss other upcoming events, subscribe now for news, events, post notification directly to your email.
                            We do not spam.
                        </p>
                        {!! $user_theme->widget('newsletter') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
