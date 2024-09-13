@php
    /** @var App\Models\ComponentBuilder $_loadComponentBuilder */
    $componentValue = $_loadComponentBuilder->values;
@endphp

<div class="container-fluid">
    <input type="hidden" name="_component_name" value="slider" class="component_field d-none">
    <input type="hidden" name="_action" value="store" class="component_field d-none">
    <input type="hidden" name="_componentID" value="{{ $_loadComponentBuilder->getKey() }}"
        class="component_field d-none">

    <div class="row">
        <div class="col-md-12 d-none">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="slider_layout">
                            Slider Source
                        </label>
                        <input type="hidden" name="slider_layout" class="component_field form-control"
                            value="slider_album">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 my-2 bg-success">
            <h4 class="mt-2">
                Slider Setting
            </h4>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="layout">Layout</label>
                <select name="layout" class="form-control component_field py-2">
                    <option value="theme" @if ($componentValue['layout'] ?? '' == 'theme') selected @endif>Theme Default Slider
                    </option>
                    <option value="images" @if ($componentValue['layout'] ?? '' == 'images') selected @endif>Multi Image</option>
                    <option value="cms" @if ($componentValue['layout'] ?? '' == 'images') selected @endif>CMS Default Slider</option>
                </select>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="slider-album">Slider Album</label>
                <select name="slider_album[]" class="form-control component_field py-2">
                    @foreach (App\Models\SliderAlbum::get() as $slider)
                        <option value="{{ $slider->getKey() }}" @if (in_array($slider->getKey(), $componentValue['value'])) selected @endif>
                            {{ $slider->album_name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label for="button_label">Button Label</label>
                <input type="text" name="button_label[]" class="form-control component_field"
                    value="{{ $componentValue['buttons'][0]['label'] }}">
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label for="button_link">Button Link</label>
                <input type="url" class="form-control component_field" name="button_link[]" id="button_link"
                    value="{{ $componentValue['buttons'][0]['link'] }}" />
            </div>
        </div>
    </div>
</div>
