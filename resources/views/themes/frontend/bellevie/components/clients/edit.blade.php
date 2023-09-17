@php
    /** @var App\Models\ComponentBuilder $_loadComponentBuilder */
    $componentValue = $_loadComponentBuilder->values;
@endphp
<input type="hidden" name="_component_name" value="clients" class="component_field  d-none">
<input type="hidden" name="_action" value="store" class="component_field d-none">
<input type="hidden" name="_componentID" value="{{$_loadComponentBuilder->getKey()}}" class="component_field d-none">

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>
                Component Name
            </label>
            <input type="text" value="{{$componentValue['name']}}" name="title" class="form-control component_field" />
        </div>
    </div>
</div>
