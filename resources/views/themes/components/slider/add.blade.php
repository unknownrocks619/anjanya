<div class="row align-items-center">
    <div class="col-lg-6 col-md-6 col-12 order-1 order-md-2">
        <input type="hidden" name="_component_name" value="slider" class="component_field  d-none">
        <input type="hidden" name="_action" value="store" class="component_field d-none">
        <div class="form-group">
            <label>
                Select Slider
            </label>
            <select name="slider" class="form-control component_field">
                @foreach (\App\Models\SliderAlbum::get() as $slider)
                    <option value="{{$slider->getKey()}}">
                        {{ $slider->album_name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    <!--end col-->
</div>
