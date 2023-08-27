<div class="row align-items-center">
    <div class="col-lg-6 col-md-6 col-12 order-1 order-md-2">
        <input type="hidden" name="_component_name" value="block_builder" class="component_field  d-none">
        <input type="hidden" name="_componentID" value="{{$_loadComponentBuilder->getKey()}}" class="d-none component_field">
        <input type="hidden" name="_action" value="update" class="component_field d-none">
        <div class="form-group">
            <label>
                Select Slider
            </label>
            <select name="slider_name" class="form-control">
                @foreach (\App\Models\SliderAlbum::get() as $slider)
                    <option value="{{$slider->getKey()}}" @if(in_array($slider->getKey(), $_loadComponentBuilder->values)) selected @endif>
                        {{ $slider->album_name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    <!--end col-->
</div>
