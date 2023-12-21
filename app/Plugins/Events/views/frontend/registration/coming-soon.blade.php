@php
    /** @var  \App\Plugins\Events\Http\Models\Event $event */
    $bannerImage = null;
@endphp
@extends($user_theme->frontend_layout($extends))
@section('page_title') - {{$event->event_title}} @endsection
@section('main')
    <div class="eduvibe-coming-soon edu-coming-soon-area edu-coming-soon-style ptb--150 ptb_md--80 ptb_sm--80 bg-image" @if($bannerImage) style="background: {{\App\Classes\Helpers\Image::getImageAsSize($bannerImage->image->filepath,'l')}}" @endif>
        <div class="container eduvibe-animated-shape">
            <div class="row g-5">
                <div class="col-xl-10 offset-xl-1">
                    <div class="content text-center">

                        <h1 class="title">Oh, Oh <br /> <span class="text-primary" style="color: #f86f03 !important;">{{$event->event_title}}</span> <br /> <span class="text-danger"> Is Too Early</span></h1>
                        <p class="description">
                            We all are excited for the event. Do not rush, You can always stay connected with us. Just provide your email address, we will notify you when are program will be ready to go live.
                        </p>
                        {!! $user_theme->widget('newsletter') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
