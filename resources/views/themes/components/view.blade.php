<?php
$model->load('webComponents');
$allComponents = $model->webComponents;
?>
@if ($allComponents && count($allComponents))

    <div class="row main-component-wrapper">
        <div class="col-md-12">
            <div data-method="post" class="default-according datatable-sortable-component component-parent"
                id="accordionicon"
                data-action="{{ route('admin.sort.re-order-column', ['mode_id' => $model, 'model_name' => 'CommonComponentConnector']) }}">
                @foreach ($allComponents as $component)
                    <div class="card" data-sort-id="{{ $component->connector_id }}">
                        <div class="card-header bg-primary"
                            id="{{ $component->getKey() }}">
                            <div class="row">
                                <div class="col-md-3 d-flex align-item-center justify-content-between">
                                    <i class="fa fa-ellipsis-v fs-3 me-3  sortable-handle" style="cursor:grab"></i>
                                    <input
                                        data-action='{{ route('admin.components.rename', ['componentBuilder' => $component->connector_id]) }}'
                                        type="text" class="form-control d-none component-name-change"
                                        data-component-id='{{ $component->getKey() }}'
                                        name="update-component[{{ $component->getKey() }}]"
                                        value="{{ $component->connector_id }}" />
                                    <span>{{$component->component_name}}</span>
                                    <div class="col-md-3 d-inline ms-3">
                                        <div class="form-group d-flex align-items-center mt-1">
                                            <div class="m-t-15 m-checkbox-inline">
                                                <div class="form-check form-check-inline checkbox checkbox-dark mb-0">
                                                    <input {{ $component->connector_active ? 'checked' : '' }}
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
                                    <button class="btn btn-danger text-white data-confirm" data-method="post"
                                        data-action="{{ route('admin.components.delete', ['componentBuilder' => $component->connector_id]) }}">
                                        <i class="fa fa-trash-o"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endif
<script>
    $('.datatable-sortable-component').sortable({
        handle: '.sortable-handle',
        update: function (event, ui) {
            let items = {};
            $(this).find('[data-sort-id]').each(function (index, item) {
                items[$(item).attr('data-sort-id')] = index;
            })

            let url = $(this).closest('.component-parent').attr('data-action');
            $.ajax({
                method: "POST",
                url: url,
                data: items,
                headers: {
                    'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
                },
                success: function (response) {
                    handleOKResponse(response)
                },
                error: function (response) {

                }
            });
        }
    });
</script>
