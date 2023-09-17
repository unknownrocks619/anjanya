<ul>
    @foreach(\App\Classes\Components\ComponentService::allComponents()  as $componenyKey => $componentValue)
        <li onclick="CB.selectComponent(this)" class="common-component-selector" data-url="{{route('admin.components.common.create',['component_name' => $componentValue])}}" data-component-name="{{$componentValue}}">
            <div class="btn btn-primary">
                {{__('components.'.$componentValue)}}
            </div>
        </li>
    @endforeach
</ul>
