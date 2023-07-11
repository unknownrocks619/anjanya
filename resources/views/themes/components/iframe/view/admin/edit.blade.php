<form action="{{ route('admin.components.update', ['componentBuilder' => $component]) }}" method="post" class="ajax-form">
    <input type="hidden" name="component" value="iframe">
    <div class="bg-light px-2 py-2 mt-3">
        <div class="component-container">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="iframe_code" class="text-dark">Iframe Code</label>
                        <textarea name="iframe" id="iframe_code" class="form-control">{{ $component->values }}</textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 d-flex justify-content-end">
                <button type="submit" class="btn btn-danger data-confirm" data-confirm="Are you sure? "
                    data-action='{{ route('admin.components.delete', ['componentBuilder' => $component]) }}'
                    data-method="post">
                    Delete
                </button>
                <button type="submit" class="btn btn-primary ms-2">
                    Update Component
                </button>
            </div>
        </div>
    </div>
</form>
