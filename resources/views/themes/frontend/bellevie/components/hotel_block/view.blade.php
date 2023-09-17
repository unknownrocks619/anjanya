@php
    /** @var App\Models\ComponentBuilder $_loadComponentBuilder */
    $componentValue = $_loadComponentBuilder->values;
    $rooms = \App\Plugins\Rooms\Http\Models\Rooms::with(['getImage' => function($query) {
                                            $query->where('type','featured');
                                        },'amenities']);
    if ( ! empty ($componentValue['rooms']))  {
        $rooms->whereIn('id',$componentValue['rooms']);
    }
    $rooms = $rooms->get();
@endphp
@if (! empty ($componentValue['rooms']) )
    <section class="rooms1 section-padding bg-cream" data-scroll-index="1"  style="background: {{$componentValue['background']}}">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-subtitle">{{$componentValue['subtitle']}}</div>
                <div class="section-title">{{$componentValue['heading']}}</div>
            </div>

        </div>
        <div class="row">
            @foreach ($rooms as $room)
            <div class="col-md-{{($loop->index >= 3) ? 6 : 4}}">
                <div class="item">
                    <div class="position-re o-hidden">
                        @php
                            $image = null;
                            $image = $room->getImage()->where('type','featured')->first() ??  $room->getImage()->where('type','featured')->first();

                        @endphp
                        @if($image)
                            <img src="{{\App\Classes\Helpers\Image::getImageAsSize($image->image->filepath,'m')}}" alt="{{$room->room_name}}">
                        @endif
                    </div>
                    <span class="category"><a href="{{route('room.detail',['slug' => $room->slug])}}">{{$room->room_name}}</a></span>
                    <div class="con">
                        <h6><a href="room-details.html">{{$room->price}}$ / Night</a></h6>
                        <h5><a href="room-details.html">{{$room->room_name}}</a> </h5>
                        <div class="line"></div>
                        <div class="row facilities">
                            <div class="col col-md-7">
                                <ul>
                                    @foreach ($room->amenities ?? [] as $room_amenity)
                                        <li>
                                            <i class="{{$room_amenity->icon_name}}"></i>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="col col-md-5 text-end">
                                <div class="permalink"><a href="{{route('room.detail',['slug' => $room->slug])}}">Details <i class="ti-arrow-right"></i></a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

@if( empty($componentValue['rooms']))
    <!-- Rooms -->
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                @foreach ($rooms as $room)
                        @php
                            $image = null;
                            $image = $room->getImage()->where('type','featured')->first() ??  $room->getImage()->where('type','featured')->first();
                        @endphp
                        <div class="rooms2 mb-90 @if( ! $loop->iteration % 2) left @endif animate-box" data-animate-effect="fadeInUp">
                            @if($image)
                                <figure>
                                    <img src="{{\App\Classes\Helpers\Image::getImageAsSize($image->image->filepath,'m')}}" alt="" class="{{$room->room_name}}">
                                </figure>
                            @endif
                        <div class="caption">
                            <h3>{{$room->price}}$ <span>/ Night</span></h3>
                            <h4><a href="{{route('room.detail',['slug' => $room->slug])}}">{{$room->room_name}}</a></h4>
                            <p>{{$room->intro_text}}</p>
                            <div class="row room-facilities">
                                @foreach ($room->amenities as $room_amenity)
                                    <div class="col-md-4">
                                        <ul>
                                            <li><i class="{{$room_amenity->icon_name}}"></i> {{$room_amenity->amenities}}</li>
                                        </ul>
                                    </div>
                                @endforeach
                            </div>
                            <hr class="border-2">
                            <div class="info-wrapper">
                                <div class="more"><a href="{{route('room.detail',['slug' => $room->slug])}}" class="link-btn" tabindex="0">Details <i class="ti-arrow-right"></i></a></div>
                                <div class="butn-dark"> <a href="#" data-scroll-nav="1"><span>Book Now</span></a> </div>
                            </div>
                        </div>
                    </div>
{{--                        <div class="rooms2 mb-90 left animate-box" data-animate-effect="fadeInUp">--}}
{{--                        <figure><img src="img/slider/3.jpg" alt="" class="img-fluid"></figure>--}}
{{--                        <div class="caption">--}}
{{--                            <h3>200$ <span>/ Night</span></h3>--}}
{{--                            <h4><a href="room-details.html">Family Room</a></h4>--}}
{{--                            <p>Spacious, bright guestrooms with tasteful furnishing, wooden floor and panoramic windows from the ceiling to the floor.</p>--}}
{{--                            <div class="row room-facilities">--}}
{{--                                <div class="col-md-4">--}}
{{--                                    <ul>--}}
{{--                                        <li><i class="flaticon-group"></i> 1-2 Persons</li>--}}
{{--                                        <li><i class="flaticon-wifi"></i> Free Wifi</li>--}}
{{--                                    </ul>--}}
{{--                                </div>--}}
{{--                                <div class="col-md-4">--}}
{{--                                    <ul>--}}
{{--                                        <li><i class="flaticon-bed"></i> Twin Bed</li>--}}
{{--                                        <li><i class="flaticon-breakfast"></i> Breakfast</li>--}}
{{--                                    </ul>--}}
{{--                                </div>--}}
{{--                                <div class="col-md-4">--}}
{{--                                    <ul>--}}
{{--                                        <li><i class="flaticon-clock-1"></i> 200 sqft Room</li>--}}
{{--                                        <li><i class="flaticon-swimming"></i> Swimming Pool</li>--}}
{{--                                    </ul>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <hr class="border-2">--}}
{{--                            <div class="info-wrapper">--}}
{{--                                <div class="more"><a href="room-details.html" class="link-btn" tabindex="0">Details <i class="ti-arrow-right"></i></a></div>--}}
{{--                                <div class="butn-dark"> <a href="#" data-scroll-nav="1"><span>Book Now</span></a> </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                @endforeach
                </div>
            </div>
        </div>
@endif
