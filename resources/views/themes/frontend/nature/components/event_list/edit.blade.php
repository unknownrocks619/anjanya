@php
    /** @var App\Models\ComponentBuilder $_loadComponentBuilder */
    $componentValue = $_loadComponentBuilder->values;
@endphp
<input type="hidden" name="_component_name" value="event_list" class="component_field  d-none">
<input type="hidden" name="_action" value="store" class="component_field d-none">
<input type="hidden" name="_componentID" value="{{$_loadComponentBuilder->getKey()}}" class="component_field d-none">
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="title" value="{{$componentValue['title']}}" class="component_field form-control">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Background Text</label>
                    <input type="text" name="background_text" value="{{$componentValue['background-text']}}" class="component_field form-control" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 my-2">
                <div class="required">
                    <label>Background Colour</label>
                    <input type="color" value="{{$componentValue['background_colour']}}" name="background-color"
                           class="component_field form-control"/>
                </div>
            </div>
            <div class="col-md-6 my-2">
                <div class="required">
                    <label>Underline text</label>
                    <input type="text" value="{{$componentValue['underline_text']}}" name="underline-text"
                           class="component_field form-control"/>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description"
                              class="tiny-mce form-control component_field">{{$componentValue['description']}}</textarea>                        </div>
            </div>
        </div>
    </div>
</div>
<script>
    window.setupTinyMce();
</script>
