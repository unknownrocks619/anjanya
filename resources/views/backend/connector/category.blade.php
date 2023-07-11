<div class="row mt-2 bg-light py-3">
    <form action="{{ route('admin.connector.store', ['type' => 'category']) }}" class="ajax-form" method="post">
        <div class="col-md-12">
            <div class="form-group">
                <label for="categories" class="text-dark">
                    Select Category To link
                </label>
                <select name="category" id="categories" class="form-control">
                    @foreach (\App\Models\Category::get() as $category)
                        <option value="{{ $category->getKey() }}">
                            {{ $category->category_name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <input type="hidden" name="model" value="{{ $model::class }}" />
            <input type="hidden" name="model_id" value="{{ $model->getKey() }}" />
        </div>
        <div class="col-md-12 d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">
                Link Category
            </button>
        </div>
    </form>
</div>
@foreach ($categories as $category)
    <div class="row mt-3">
        <div class="col-md-10">
            <span class="fs-4 text-inf">
                {{ $category->eloquentClass->category_name }}
            </span>
            <span>
                <a href="" class="remove-linked-page">
                    <i class="<i class="icon-trash"></i>
                </a>
            </span>
        </div>
        <div class="col-md-2 text-end">
            <a type="submit" class="btn btn-danger data-confirm" data-confirm='Are you sure?' data-method="post"
                data-action="{{ route('admin.connector.remove', [$category->getKey()]) }}">Unlink Category</a>
        </div>
    </div>
@endforeach
