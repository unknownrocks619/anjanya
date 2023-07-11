<div class="row mt-2 bg-light py-3">
    <form action="{{ route('admin.connector.store', ['type' => 'page']) }}" class="ajax-form" method="post">
        <div class="col-md-12">
            <div class="form-group">
                <label for="pages" class="text-dark">
                    Select Page to Link
                </label>
                <select name="pages" id="pages" class="form-control">
                    @foreach (\App\Models\Page::get() as $page)
                        <option value="{{ $page->getKey() }}">
                            {{ $page->title }}
                        </option>
                    @endforeach
                </select>
            </div>
            <input type="hidden" name="model" value="{{ $model::class }}" />
            <input type="hidden" name="model_id" value="{{ $model->getKey() }}" />
        </div>
        <div class="col-md-12 d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">
                Link Page
            </button>
        </div>
    </form>
</div>
@foreach ($pages as $page)
    <div class="row mt-3">
        <div class="col-md-10">
            <span class="fs-4 text-inf">
                {{ $page->eloquentClass->title }}
            </span>
            <span>
                <a href="" class="remove-linked-page">
                    <i class="<i class="icon-trash"></i>
                </a>
            </span>
        </div>
        <div class="col-md-2 text-end">
            <a type="submit" class="btn btn-danger data-confirm" data-confirm='Are you sure?' data-method="post" data-action="{{route('admin.connector.remove',[$page->getKey()])}}">Unlink Page</a>
        </div>
    </div>
@endforeach
