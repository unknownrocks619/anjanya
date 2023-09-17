@php
    $rooms = \App\Plugins\Rooms\Http\Models\Rooms::where('status','active')->get();
@endphp
<input type="hidden" name="_component_name" value="hotel_block" class="component_field  d-none">
<input type="hidden" name="_action" value="store" class="component_field d-none">
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="background-color">Background Color</label>
            <input type="color" name="background_color" id="background-color" class="form-control component_field" />
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="subtitle">Subtitle</label>
            <input type="text" name="subtitle" id="subtitle" class="form-control component_field" />
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="heading">Heading</label>
            <input type="text" name="heading" id="heading" class="form-control component_field" />
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-8">
        <div class="form-group">
            <label for="rooms">Rooms</label>
            <select multiple name="rooms[]" id="rooms" class="form-control component_field">
                @foreach ($rooms as $room)
                    <option value="{{$room->getKey()}}">
                        {{$room->room_name}}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
</div>

<script>
    $('#rooms').select2();
</script>
