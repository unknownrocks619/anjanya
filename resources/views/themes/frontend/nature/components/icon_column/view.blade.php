@php
    /** @var App\Models\ComponentBuilder $_loadComponentBuilder */
    $componentValue = $_loadComponentBuilder->values;
    $data = $componentValue['data'];
    $iconArray = [];
    foreach ($data as $rowKey => $row){
        foreach ($row as $column_key => $column_value) {
            $iconArray[] = $column_value;
        }
    }
@endphp
<div class="container">
    <div class="iconbox-container-bg justify-content-center">
        @foreach ($iconArray as $column_value)
            <div class="iconbox-item-bg">
                <div class="iconbox-content-bg">
                    <i aria-hidden="true" class="{{$column_value['icon']}}"></i>
                    <h4>{{$column_value['title']}}</h4>
                </div>
            </div>
        @endforeach
    </div>
</div>
