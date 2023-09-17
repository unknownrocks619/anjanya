@php
$roomAmenities = $room->amenities?->keyBy('id')->toArray() ?? [];
$roomAmenities = array_keys($roomAmenities);
@endphp
<form action="{{route('admin.room.update',['room' => $room])}}" class="ajax-form" method="post">
    <div class="card rounded-3">
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="room_name">Room Name
                            <sup class="text-danger">*</sup>
                        </label>
                        <input type="text" name="room_name" value="{{$room->room_name}}" id="room_name"
                               class="form-control"/>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="room_slug">Slug Name</label>
                        <input type="text" name="room_slug" id="room_slug" class="form-control"
                               placeholder="[Auto Generated]" value="{{$room->slug}}"/>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="room_intro">Room Intro Text</label>
                        <textarea name="room_intro" id="room_intro"
                                  class="form-control">{{$room->intro_text}}</textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="short_description">
                            Short Description
                            <sup class="text-danger">*</sup>
                        </label>
                        <textarea name="short_description" id="short_description"
                                  class="form-control tiny-mce">{!! $room->short_description !!}</textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="full_description">
                            Full Description
                            <sup class="text-danger">*</sup>
                        </label>
                        <textarea name="full_description" id="full_description"
                                  class="form-control tiny-mce">{!! $room->full_description !!}</textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="price">
                            Price Per Night
                        </label>
                        <input type="text" name="price" id="price" class="form-control" value="{{$room->price}}">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="currency">
                            Currency
                        </label>
                        <select name="currency" id="currency" class="form-control">
                            <option value="USD" selected>USD</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="amenities">
                            Amenities
                        </label>
                        <select multiple name="amenities[]" id="amenities" class="form-control">
                            @foreach (\App\Plugins\Amenities\Http\Models\Amenities::get() as $amenity)
                                <option value="{{$amenity->getKey()}}" @if(in_array($amenity->getKey(),$roomAmenities)) selected @endif>
                                    {{$amenity->amenities}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group d-flex align-items-center mt-1">
                        <div class="m-t-15 m-checkbox-inline">
                            <div class="form-check form-check-inline checkbox checkbox-dark mb-0">
                                <input {{ $room->status == 'active' ? 'checked' : '' }} class="form-check-input"
                                       name="active" id="active" type="checkbox" data-bs-original-title=""
                                       title="Active">
                                <label class="form-check-label" for="active">
                                    Active
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col-md-12 text-end">
                    <button type="submit" class="btn btn-primary">
                        Save Room
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
