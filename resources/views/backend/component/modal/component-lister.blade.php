<div class="modal-content">
    <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel">Select Components</h3>
        <button class="btn-close" data-original-title="test" type="button" data-bs-dismiss="modal"
                aria-label="Close">
        </button>
    </div>
    <div class="modal-body">
        <div class="row">
            @foreach(\App\Classes\Components\ComponentService::allComponents() as $componenyKey => $componentValue)
                <div class="col-md-3 mx-2  bg-light  py-2 my-2">
                    <ul class="nav main-menu custom-scrollbar">
                        <li class="mx-2">
                            <a href="#"
                               onclick="CB.selectComponent(this)"
                               class="common-component-selector select-component"
                               data-url="{{route('admin.components.common.create',['component_name' => $componentValue])}}" data-component-name="{{$componentValue}}"
                            >
                                {{__('components.'.$componentValue)}}
                            </a>
                        </li>
                    </ul>
                </div>
            @endforeach
        </div>
    </div>
</div>
