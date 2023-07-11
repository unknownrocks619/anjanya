<?php
$model->load('getComponents');
$allComponents = $model->getComponents;
$folder = in_array(
    'admin',
    request()
        ->route()
        ->gatherMiddleware(),
)
    ? 'admin'
    : 'public';

?>
@if ($allComponents && count($allComponents))

    <div class="row">
        <div class="col-md-12">
            <div data-method="post" class="default-according datatable-sortable-component component-parent"
                id="accordionicon"
                data-action="{{ route('admin.sort.re-order-column', ['mode_id' => $model, 'model_name' => 'ComponentBuilder']) }}">
                @foreach ($allComponents as $component)
                    <div class="card" data-sort-id="{{ $component->getKey() }}">
                        <div class="card-header bg-primary"
                            id="{{ $component->component_type }}_{{ $component->getKey() }}">
                            <div class="row">
                                <div class="col-md-3 d-flex align-item-center justify-content-between">
                                    <i class="fa fa-ellipsis-v fs-3 me-3  sortable-handle" style="cursor:grab"></i>
                                    <input
                                        data-action='{{ route('admin.components.rename', ['componentBuilder' => $component]) }}'
                                        type="text" class="form-control component-name-change"
                                        data-component-id='{{ $component->getKey() }}'
                                        name="update-component[{{ $component->getKey() }}]"
                                        value="{{ $component->component_name }}">
                                    <div class="col-md-3 d-inline ms-3">
                                        <div class="form-group d-flex align-items-center mt-1">
                                            <div class="m-t-15 m-checkbox-inline">
                                                <div class="form-check form-check-inline checkbox checkbox-dark mb-0">
                                                    <input {{ $component->active ? 'checked' : '' }}
                                                        class="form-check-input" name="active_component_status"
                                                        id="active_{{ $component->getKey() }}" type="checkbox"
                                                        data-bs-original-title="" title="Active">
                                                    <label class="form-check-label"
                                                        for="active_{{ $component->getKey() }}">
                                                        Active
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-9 text-end">
                                    <button class="btn btn-link ps-0 text-white" data-bs-toggle="collapse"
                                        data-bs-target="#{{ $component->component_type }}_{{ $component->getKey() }}"
                                        aria-expanded="true"
                                        aria-controls="{{ $component->component_type }}_{{ $component->getKey() }}"
                                        data-bs-original-title="" title="">
                                        <i class="fa fa-level-down fs-3"></i>
                                    </button>
                                    <button class="btn btn-danger text-white data-confirm" data-method="post"
                                        data-action="{{ route('admin.components.delete', ['componentBuilder' => $component]) }}">
                                        <i class="fa fa-trash-o"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="collapse" id="{{ $component->component_type }}_{{ $component->getKey() }}"
                            aria-labelledby="headingOne" data-bs-parent="#accordionicon">
                            <div class="card-body">
                                @include(
                                    'themes.components.' . $component->component_type . '.view.admin.view',
                                    ['component' => $component]
                                )
                                @include(
                                    'themes.components.' . $component->component_type . '.view.admin.edit',
                                    [
                                        'component' => $component,
                                    ]
                                )
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endif
