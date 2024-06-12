@php
    /** @var App\Models\ComponentBuilder $_loadComponentBuilder */
    $componentValue = $_loadComponentBuilder->values;
    $componentValue['layout'] = 'mansonry';//($componentValue['layout'] == 'list' ) ? 'mansonry' : $componentValue['layout'];

    // if ($componentValue['layout'] == 'grid'){
        // $path = 'themes.frontend.siddhamahayog.components.'.$_loadComponentBuilder->component_type .'.layout.';
    // } else {
        $path = 'themes.components.'.$_loadComponentBuilder->component_type.'.layout.';
    // }
    $path .= $componentValue['layout'];
@endphp
<div class="row align-items-center">
    <div class="col-md-12">
        @include($path,['componentValue' => $componentValue,'_loadComponentBuilder' => $_loadComponentBuilder])
    </div>
</div>
