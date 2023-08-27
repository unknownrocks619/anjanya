<ul>
    @foreach(\App\Classes\Helpers\Components::TYPES as $componenyKey => $componentValue)
        <li onclick="CB.selectComponent(this)" class="common-component-selector" data-url="{{route('admin.components.common.create',['component_name' => $componenyKey])}}" data-component-name="{{$componenyKey}}">
            <div class="btn btn-primary">
                {{__('components.'.$componenyKey)}}
            </div>
        </li>
    @endforeach
</ul>
