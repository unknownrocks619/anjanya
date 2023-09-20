@php
    $bookingAction = route('room.booking');
    if (isset($room) ) {
        /**  @var \App\Plugins\Rooms\Http\Models\Rooms $room */
        $bannerImages = $room->getImage()->where('type','banner')->first();
        $bookingAction = route('room.booking',['slug' => $room->slug]);
    }
@endphp
<!-- Reservation & Booking Form -->
<section class="testimonials mt-3" id="booking-form">
    <div class="background bg-img bg-fixed section-padding pb-0" data-background="{{\App\Classes\Helpers\Image::getImageAsSize($bannerImages->image->filepath,'l')}}" data-overlay-dark="2">
        <div class="container">
            <div class="row">
                <!-- Reservation -->
                <div class="col-md-5 mb-30 mt-30">
                    <p><i class="star-rating"></i><i class="star-rating"></i><i class="star-rating"></i><i class="star-rating"></i><i class="star-rating"></i></p>
                    <h5>
                        {{\App\Classes\Helpers\SystemSetting::basic_configuration('intro_description')}}
                    </h5>
                    <div class="reservations mb-30">
                        <div class="icon color-1"><span class="flaticon-call"></span></div>
                        <div class="text">
                            <p class="color-1">Reservation</p> <a class="color-1" href="tel:{{\App\Classes\Helpers\SystemSetting::primary_contact_info('primary_contact_number')}}">{{\App\Classes\Helpers\SystemSetting::primary_contact_info('primary_contact_number')}}</a>
                        </div>
                    </div>
                </div>
                <!-- Booking From -->
                <div class="col-md-5 offset-md-2">
                    <div class="booking-box">
                        <div class="head-box">
                            <h6>Rooms & Suites</h6>
                            <h4>Hotel Booking Form</h4>
                        </div>
                        <div class="booking-inner clearfix">
                            <form method="post" action="{{$bookingAction}}" class="form1 clearfix ajax-form ajax-append  booking-form-submit">
                                @if(isset($room) )
                                    <input type="hidden" name="room" value="{{$room->slug}}" class="form-control d-none" />
                                @else
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="select1_wrapper">
                                                <label>Rooms</label>
                                                <div class="select1_inner">
                                                    <select name="room" class="select2 select" style="width: 100%">
                                                        @foreach (\App\Plugins\Rooms\Http\Models\Rooms::where('status','active')->get() as $room)
                                                            <option value="{{$room->slug}}">{{$room->room_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="input1_wrapper">
                                            <label>Full Name</label>
                                            <div class="input2_inner">
                                                <input type="text" name="full_name" class="form-control" placeholder="Full Name" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="input1_wrapper">
                                            <label>Email</label>
                                            <div class="input2_inner">
                                                <input type="email" class="form-control" name="email_address" placeholder="Email Address" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="input1_wrapper">
                                            <label>Check in</label>
                                            <div class="input1_inner">
                                                <input type="text" name="check_in" class="form-control input datepicker" autocomplete="false" placeholder="Check in" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="input1_wrapper">
                                            <label>Check out</label>
                                            <div class="input1_inner">
                                                <input type="text" name="check_out" class="form-control input datepicker" autocomplete="false" placeholder="Check out" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="select1_wrapper">
                                            <label>Adults</label>
                                            <div class="select1_inner">
                                                <select name="adult_count" class="select2 select" style="width: 100%">
                                                    @for($i = 1 ; $i <= 20; $i++)
                                                        <option value="{{$i}}">{{$i}}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="select1_wrapper">
                                            <label>Children</label>
                                            <div class="select1_inner">
                                                <select name="child_count" class="select2 select" style="width: 100%">
                                                    <option value="0">Children</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <button type="submit"  class="btn-form1-submit mt-15">Send Booking Enquiry</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Clients -->

@push('page_script')
    <script>
        $('.btn-form1-submit').change(function() {
            if ($(this).is('disabled')) {
                $(this).addClass('bg-secondary');
            } else {
                $(this).removeClass('bg-secondary');
            }
        })
    </script>
@endpush
