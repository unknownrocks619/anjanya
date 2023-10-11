<div class="modal fade" id="reservaton-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Reservation / Enquiry Form</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body"  style="background:#f8f5f0">
                <div class="row">
                    <!-- Booking From -->
                    <div class="col-md-12">
                        <div class="booking-inner clearfix">
                                <form method="post" action="{{route('room.booking')}}" class="form1 clearfix ajax-form ajax-append  booking-form-submit">
                                    @if(isset($room) )
                                        <input type="hidden" name="room" value="{{$room->slug}}" class="form-control d-none" />
                                    @else
                                        <div class="row mb-2">
                                            <div class="col-md-12">
                                                <div class="select1_wrapper">
                                                    <label>Rooms</label>
                                                    <div class="select1_inner">
                                                        <select name="room" class="select border-0" style="width: 100%">
                                                            <option value="">Please Select Room</option>
                                                            @foreach (\App\Plugins\Rooms\Http\Models\Rooms::where('status','active')->get() as $select_room)
                                                                <option value="{{$select_room->slug}}" @if(isset($room) && $room->slug == $select_room) selected  @endif>{{$select_room->room_name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                        <div class="row my-3">
                                            <div class="col-md-12">
                                                <div class="input1_wrapper form-group">
                                                    <label>Number of room</label>
                                                    <div class="input2_inner">
                                                        <input type="number" value="1" min="1" name="no_of_rooms"
                                                                                      id="no_of_rooms"
                                                                                      class="form-control"
                                                                                      placeholder="Number of rooms"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="input1_wrapper form-group">
                                                <label>Full Name</label>
                                                <div class="input2_inner">
                                                    <input type="text" name="full_name" class="form-control" placeholder="Full Name" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="input1_wrapper form-group">
                                                <label>Email</label>
                                                <div class="input2_inner">
                                                    <input type="email" class="form-control" name="email_address" placeholder="Email Address" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="input1_wrapper form-group">
                                                <label>Check in</label>
                                                <div class="input1_inner">
                                                    <input type="text" name="check_in" class="form-control input datepicker" autocomplete="false" placeholder="Check in" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="input1_wrapper form-group">
                                                <label>Check out</label>
                                                <div class="input1_inner">
                                                    <input type="text" name="check_out" class="form-control input datepicker" autocomplete="false" placeholder="Check out" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="select1_wrapper form-group">
                                                <label>Adults</label>
                                                <div class="select1_inner">
                                                    <select name="adult_count" class="select" style="width: 100%">
                                                        <option value="0">Adults</option>
                                                        @for($i = 1 ; $i <= 20; $i++)
                                                            <option value="{{$i}}">{{$i}}</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="select1_wrapper form-group">
                                                <label>Children</label>
                                                <div class="select1_inner">
                                                    <select name="child_count" class="select" style="width: 100%">
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
</div>
