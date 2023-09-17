@php
    $roomQuery = \App\Plugins\Rooms\Http\Models\Rooms::where('status','active');
    if ( isset ($room) ) {
        $roomQuery->where('id','!=',$room->getKey());
    }
    $roomQuery->with(['getImage'=>function($query){
        $query->with('image');
    },'amenities']);
    $rooms =$roomQuery->get();
@endphp
<!-- Similiar Room -->
<section class="rooms1 section-padding bg-blck">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-subtitle"><span>{{\App\Classes\Helpers\SystemSetting::basic_configuration('site_name')}}</span></div>
                <div class="section-title"><span>Similar Rooms</span></div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="owl-carousel owl-theme">
                    @foreach($rooms as $similar_room)
                    <div class="item">
                        <div class="position-re o-hidden"> <img src="img/rooms/1.jpg" alt=""> </div> <span class="category"><a href="rooms2.html">Book</a></span>
                        <div class="con">
                            <h6><a href="{{route('room.detail',['slug' => $similar_room->slug])}}">{{$similar_room->price}}$ / Night</a></h6>
                            <h5><a href="{{route('room.detail',['slug' => $similar_room->slug])}}">{{$similar_room->room_name}}</a> </h5>
                            <div class="line"></div>
                            <div class="row facilities">
                                <div class="col col-md-7">
                                    <ul>
                                        @foreach ($similar_room->amenities as $room_amenity)
                                        <li><i class="{{$room_amenity->icon_name}}"></i></li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="col col-md-5 text-end">
                                    <div class="permalink"><a href="{{route('room.detail',['slug' => $similar_room->slug])}}">Details <i class="ti-arrow-right"></i></a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</section>
