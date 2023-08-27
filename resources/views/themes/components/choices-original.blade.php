<div class="row mt-3">
    <div class="col-md-12">
        <button class="btn btn-info component-modal ajax-modal" data-bs-target="#ajax_components_modal" data-method="post",
            data-action="{{ route('admin.components.list', ['modal' => $model::class, 'modal_id' => $model->getKey()]) }}">
            Add Component
        </button>
    </div>
</div>

<div class="row mt-2" data-modal="{{ $model::class }}" data-modal-id="{{ $model->getKey() }}">
    <form enctype="multipart/form-data" action="{{ route('admin.components.save') }}" id='component-render'
        class="ajax-component-form" method="post">
        <input type="hidden" name="model" value='{{ $model::class }}'>
        <input type="hidden" name="model_id" value='{{ $model->getKey() }}'>
    </form>
</div>


@include('themes.components.view', ['model' => $model])
