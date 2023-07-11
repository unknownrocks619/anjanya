<form action="{{ route('admin.categories.edit', ['category' => $category]) }}" class="ajax-form" method="post">
    <div class="row g-2">
        <div class="mb-3 col-md-8 mt-0">
            <label for="course_name">Category Name</label>
            <div class="form-group">
                <input class="form-control" id="category_name" value="{{ $category->category_name }}" name="category_name"
                    type="text" required="" placeholder="Category Name" autocomplete="off">
            </div>
        </div>
        <div class="mb-3 col-md-4 mt-0">
            <label for="category_slug">Category Slug</label>
            <div class="form-group">
                <input class="form-control" value="{{ $category->slug }}" name="category_slug" type="text"
                    required="" placeholder="category-slug" autocomplete="off">
            </div>
        </div>
    </div>

    <div class="row g-2">
        <div class="mb-3 col-md-6">
            <label for="category_type">
                Category Type
            </label>
            <select name="category_type" id="category" class="form-control">
                @foreach (\App\Models\Category::CATEGORY_TYPES as $key => $value)
                    <option value="{{ $key }}" @if ($category->category_type == $key) selected @endif>
                        {{ $value }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6 d-flex align-item-center justify-content-center">
            <div class="form-group d-flex align-items-center mt-1">
                <div class="m-t-15 m-checkbox-inline">
                    <div class="form-check form-check-inline checkbox checkbox-dark mb-0">
                        <input {{ $category->active ? 'checked' : '' }} class="form-check-input" name="active"
                            id="active" type="checkbox" data-bs-original-title="" title="Active">
                        <label class="form-check-label" for="active">
                            Active
                        </label>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="row g-2">
        <div class="col-md-12">
            <label for="">Description</label>
            <textarea name="description" class="form-control tiny-mce">{{ $category->full_description }}</textarea>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-md-12 text-end">
            <button type="submit" class="btn btn-info">
                Update Category
            </button>
        </div>
    </div>
</form>
