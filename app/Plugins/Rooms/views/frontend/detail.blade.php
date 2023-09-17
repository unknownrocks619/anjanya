@extends($user_theme->frontend_layout($extends))
@section('page_title') - {{$room->room_name}} @endsection
@section('main')
    @include('Rooms::frontend.partials.detail.slider',['room' => $room])

    <!-- Room Content -->
    <section class="rooms-page pt-5" data-scroll-index="1">
        <div class="container">
            <!-- project content -->
            <div class="row">
                <div class="col-md-12">
                    <span>
                        <i class="star-rating"></i>
                        <i class="star-rating"></i>
                        <i class="star-rating"></i>
                        <i class="star-rating"></i>
                        <i class="star-rating"></i>
                    </span>
                    <div class="section-subtitle">{{ \App\Classes\Helpers\SystemSetting::basic_configuration('site_name') }}</div>
                    <div class="section-title">{{$room->room_name}}</div>
                </div>
                <div class="col-md-8">
                    <div class="mb-30">
                        {!! $room->full_description !!}
                    </div>
                </div>
                <div class="col-md-3 offset-md-1">
                    <h6>Amenities</h6>
                    <ul class="list-unstyled page-list mb-30">
                        @foreach ($room->amenities as $room_amenity)
                        <li>
                            <div class="page-list-icon"> <span class="{{$room_amenity->icon_name}}"></span> </div>
                            <div class="page-list-text">
                                <p>{{$room_amenity->amenities}}</p>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    @include('frontend.components.lister', ['model' => $room])
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="butn-dark mt-15 mb-30"><a href="rooms2.html"><span>Check Now</span></a></div>
                </div>
            </div>
        </div>
    </section>
    @include('Rooms::frontend.inc.booking-form',['room' => $room])
    @include('Clients::frontend.partials.clients')
    @include("Rooms::frontend.partials.detail.similar-property")
@endsection
