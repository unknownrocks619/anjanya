<form class="form-bookmark needs-validation ajax-form" method="post" action="{{ route('admin.components.render') }}"
    id="component-selection-form" novalidate="">
    <input type="hidden" name="component_key" class="selected-component-input">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title" id="exampleModalLabel">Select Component To Add
            </h3>
            <button class="btn-close" data-original-title="test" type="button" data-bs-dismiss="modal"
                aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                @foreach ($options as $component_option)
                    <div class="col-md-12 bg-light py-2 my-2 component-div">
                        <ul class="nav main-menu custom-scrollbar">
                            <li class="mx-2">
                                <a href="" class="select-component" data-key='{{ $component_option }}'>
                                    {{ __('components.' . $component_option) }}
                                </a>
                            </li>
                        </ul>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary" type="submit">Select Component</button>
            <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Cancel</button>
        </div>
    </div>
</form>
