@php
    /** @var App\Models\ComponentBuilder $_loadComponentBuilder */
    $componentValue = $_loadComponentBuilder->values;
@endphp
<div class="row align-items-center">
    <div class="col-lg-12 col-md-6 order-2 order-md-1 mt-4 pt-2 mt-sm-0 opt-sm-0">
        <input type="hidden" name="_component_name" value="content" class="component_field  d-none">
        <input type="hidden" name="_componentID" value="{{$_loadComponentBuilder->getKey()}}" class="component_field  d-none">
        <input type="hidden" name="_action" value="store" class="component_field d-none">
        <div editable="rich">
            <div class="description component_field tiny-mce" name="description">
                {!! $componentValue['description'] !!}
            </div>
        </div>
        <!--end row-->
    </div>
    <!--end col-->
</div>

<script>
    window.setupTinyMceAll();
</script>
