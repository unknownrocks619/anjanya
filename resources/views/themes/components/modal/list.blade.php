
<form class="form-bookmark needs-validation ajax-form" method="post" action="{{ route('admin.components.render') }}"
    id="component-selection-form" novalidate="">
    <input type="hidden" name="_model" value="{{$model}}" class="form-control">
    <input type="hidden" name="_modelID" value="{{$modelID}}" class="form-control">
    <input type="hidden" name="component_key" class="selected-component-input">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title" id="exampleModalLabel">Attach Component
            </h3>
            <button class="btn-close" data-original-title="test" type="button" data-bs-dismiss="modal"
                aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                @foreach (\App\Models\WebComponents::get() as $component)
                    <div class="col-md-3 bg-light py-2 mx-1 my-2 component-div">
                        <ul class="nav main-menu custom-scrollbar">
                            <li class="mx-2">
                                <input type="checkbox" class="d-none" name="web_component_enable[{{$component->getKey()}}]">
                                <input type="hidden" name="web_component[]" value="{{$component->getKey()}}">
                                <a href="" class="select-component" data-key='{{$component->component_name}}'>
                                    {{ $component->component_name }}
                                </a>
                            </li>
                        </ul>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary" type="submit">Save Component</button>
            <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Cancel</button>
        </div>
    </div>
</form>
