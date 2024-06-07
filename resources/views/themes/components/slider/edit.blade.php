<div class="row align-items-center">
    <div class="col-lg-6 col-md-6 col-12 order-1 order-md-2">
        <input type="hidden" name="_component_name" value="slider" class="component_field  d-none">
        <input type="hidden" name="_componentID" value="{{$_loadComponentBuilder->getKey()}}" class="d-none component_field">
        <input type="hidden" name="_action" value="update" class="component_field d-none">
        <div class="form-group">
            <label>
                Select Slider
            </label>
            <select name="slider" class="form-control component_field">
                <option value="">Select Slider Option</option>
                @foreach (\App\Models\SliderAlbum::get() as $slider)
                    <option value="{{$slider->getKey()}}" @if($_loadComponentBuilder->values['slider'] == $slider->getKey()) selected @endif>
                        {{ $slider->album_name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-lg-6 col-md-6 col-12 order-1 order-md-2">
        <div class="form-group">
            <label>
                Slider Type
            </label>
            <select name="type" class="form-control component_field">
                <option value="single" @if( ! isset($_loadComponentBuilder->values['type']) || (isset($_loadComponentBuilder->values['type']) == 'single')) selected @endif>Single</option>
                <option value="multiple" @if( isset($_loadComponentBuilder->values['type']) == 'multiple') selected @endif>Multiple</option>
            </select>
        </div>
    </div>
    <!--end col-->
</div>
