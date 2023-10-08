@php
    /** @var App\Models\ComponentBuilder $_loadComponentBuilder */
    $componentValue = $_loadComponentBuilder->values;
@endphp
<input type="hidden" name="_component_name" value="testimonials" class="component_field  d-none">
<input type="hidden" name="_action" value="store" class="component_field d-none">
<input type="hidden" name="_componentID" value="{{$_loadComponentBuilder->getKey()}}" class="component_field d-none">

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>
                Title
            </label>
            <input type="text" value="{{$componentValue['title']}}" name="title" class="form-control component_field" />
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>
                Subtitle
            </label>
            <input type="text"  value="{{$componentValue['subtitle']}}"  name="subtitle" class="form-control component_field" />
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>
                Underline Text
            </label>
            <input type="text" name="underline_text" value="{{$componentValue['underline_text']}}" class="form-control component_field" />
        </div>
    </div>
</div>
<div class="row mt-2">
    <div class="col-md-12">
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control tiny-mce component_field">{!! $componentValue['description'] !!}</textarea>
        </div>
    </div>
</div>

<script>
    window.setupTinyMce()
</script>

