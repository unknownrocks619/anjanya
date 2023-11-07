@php
    /** @var App\Models\ComponentBuilder $_loadComponentBuilder */
    $componentValue = $_loadComponentBuilder->values;
@endphp
<div class="row align-items-center">
    <div class="col-md-12">
        @include('themes.components.'.$_loadComponentBuilder->component_type.'.layout.'.$componentValue['layout'],['componentValue' => $componentValue]);
    </div>
</div>
