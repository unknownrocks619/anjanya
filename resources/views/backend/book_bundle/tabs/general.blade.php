<form action="{{ route('admin.book.bundle.edit', ['bundle' => $bundle]) }}" class="ajax-form" method="post">
    <div class="row mt-2">
        <div class="col-md-8">
            <div class="form-group">
                <label for="book_title">Bundle Title</label>
                <input type="text" name="title" id="book_title" value="{{ $bundle->bundle_title }}"
                    class="form-control" />
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="slug">Slug</label>
                <input type="text" name="slug" id="slug" value="{{ $bundle->slug }}" class="form-control" />
            </div>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-md-6">
            <div class="form-group">
                <label>Select Products</label>
                <select name="products[]" multiple class="form-control">
                    @foreach (\App\Models\Product::where('status', 'active')->get() as $product)
                        <option @if (in_array($product->getKey(), $bundle->products)) selected @endif value="{{ $product->getKey() }}">
                            {{ $product->product_name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="categories">Select Categories</label>
                <select name="categories[]" id="categories" multiple class="form-control">
                    @foreach (\App\Models\Category::where('category_type', 'books')->get() as $category)
                        <option value="{{ $category->getKey() }}" @if ($bundle->categories && in_array($category->getKey(), $bundle->categories)) selected @endif>
                            {{ $category->category_name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-md-12">
            <div class="form-group">
                <label for="intro_text">Intro Text</label>
                <textarea name="intro_text" class="form-control">{{ $bundle->intro_text }}</textarea>
            </div>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-md-12 mt-2">
            <div class="form-group">
                <label for="short_description">Short Description</label>
                <textarea name="short_description" class="form-control tiny-mce">{{ $bundle->short_description }}</textarea>
            </div>
        </div>
        <div class="col-md-12 mt-2">
            <div class="form-group">
                <label for="full_description">Full Description</label>
                <textarea name="full_description" class="form-control tiny-mce">{{ $bundle->full_description }}</textarea>
            </div>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-md-3">
            <div class="form-group d-flex align-items-center mt-1">
                <div class="m-t-15 m-checkbox-inline">
                    <div class="form-check form-check-inline checkbox checkbox-dark mb-0">
                        <input {{ $bundle->active ? 'checked' : '' }} class="form-check-input" name="active"
                            id="active" type="checkbox" data-bs-original-title="" title="Active">
                        <label class="form-check-label" for="active">
                            Active
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 text-end">
            <button type="submit" class="btn btn-primary">
                Update Bundle
            </button>
        </div>
    </div>
</form>
