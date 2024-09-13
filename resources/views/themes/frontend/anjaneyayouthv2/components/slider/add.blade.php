{!! $user_theme->components('slider.preview') !!}
@php
    /**
     * @todo Remove this page in the future,
     * When component is clicked it should insert dummy data
     * based on the information saved either in db, or in config file.
     * So when user interact with component, it should add component
     * with dummy data and render the preview.
     *
     * */
@endphp

<div class="container-fluid d-none">
    <input type="hidden" name="_component_name" value="slider" class="component_field d-none">
    <input type="hidden" name="_action" value="store" class="component_field d-none">
    <div class="row">
        <div class="col-md-12">
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
        <div class="col-md-12">
            <div class="form-group">
                <label for="layout">Layout</label>
                <select name="layout" class="form-control component_field">
                    <option value="theme" selected>Theme Default Slider</option>
                    <option value="images">Multi Image</option>
                    <option value="cms">CMS Default Slider</option>
                </select>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="slider-album">Slider Album</label>
                <select name="slider_album[]" class="form-control component_field">
                    @foreach (App\Models\SliderAlbum::get() as $slider)
                        <option value="{{ $slider->getKey() }}" @if ($loop->first) selected @endif>
                            {{ $slider->album_name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label for="button_label">Button Label</label>
                <input type="text" name="button_label[]" class="form-control component_field" value="Get Help Now">
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label for="button_link">Button Link</label>
                <input type="url" class="form-control component_field" name="button_link[]" id="button_link"
                    value="/" />
            </div>
        </div>
    </div>
</div>

<script>
    $(() => {
        window.CB.updateComponent();
        setTimeout(() => {
            // reload iframe,
            document.getElementById('slider_frame').contentWindow.location.reload();
        }, 1000);
    });
</script>
