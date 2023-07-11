<form action="{{ route('admin.ecom.edit', ['product' => $product, 'current_tab' => 'general', 'book' => $book]) }}"
    class="ajax-form" method="post">
    <div class="row mt-2">
        <div class="col-md-8">
            <div class="form-group">
                <label for="product_name">Product Name</label>
                <input type="text" name="product_name" id="product_name" value="{{ $product->product_name }}"
                    class="form-control" />
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="slug">Slug</label>
                <input type="text" name="slug" id="slug" value="{{ $product->slug }}" class="form-control" />
            </div>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-md-6">
            <div class="form-group">
                <label for="author">Change Product Author / Owner</label>
                <select name="author" id="author" class="form-control ajax-select-2" data-method="get"
                    data-action="{{ route('admin.users.customers.select2-users') }}">
                    @if ($product->getAuthor)
                        <option value="{{ $product->getAuthor->getKey() }}">
                            {{ $product->getAuthor->getFullName() }}
                        </option>
                    @endif
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="select-project">
                    Select Default Project
                </label>
                <select name="project" id="project" class="form-control">
                    @foreach (\App\Models\Project::get() as $project)
                        <option value="{{ $project->getKey() }}" @if ($product->option_project_id == $project->getKey()) selected @endif>
                            {{ $project->title }}
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
                <textarea name="intro_text" class="form-control">{{ $product->intro_text }}</textarea>
            </div>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-md-12 mt-2">
            <div class="form-group">
                <label for="short_description">Short Description</label>
                <textarea name="short_description" class="form-control tiny-mce">{{ $product->short_description }}</textarea>
            </div>
        </div>
        <div class="col-md-12 mt-2">
            <div class="form-group">
                <label for="full_description">Full Description</label>
                <textarea name="full_description" class="form-control tiny-mce">{{ $product->full_description }}</textarea>
            </div>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-md-6">
            <div class="form-group">
                <label for="categories">Select Categories</label>
                <select name="categories[]" id="categories" multiple class="form-control">
                    @foreach (\App\Models\Category::where('category_type', 'books')->get() as $category)
                        <option value="{{ $category->getKey() }}" @if ($product->categories && in_array($category->getKey(), $product->categories)) selected @endif>
                            {{ $category->category_name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label for="status">Publish Status</label>
                <select name="status" id="status" class="form-control">
                    @foreach (\App\Models\Product::STATUS as $key => $status)
                        <option value="{{ $key }}">
                            {{ $status }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label for="product_type">Product Avaibility Type</label>
                <select name="product_type" id="product_type" class="form-control">
                    @foreach (\App\Models\Product::PRODUCT_TYPE as $key => $value)
                        <option value="{{ $key }}" @if ($product->product_type == $key) selected @endif>
                            {{ $value }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

    </div>


    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <div class="form-group d-flex align-items-center mt-1">
                    <div class="m-t-15 m-checkbox-inline">
                        <div class="form-check form-check-inline checkbox checkbox-dark mb-0">
                            <input {{ $product->is_shipping_available ? 'checked' : '' }} class="form-check-input"
                                name="shipping_option" id="shipping_option" type="checkbox" data-bs-original-title=""
                                title="Shipping Option">
                            <label class="form-check-label" for="shipping_option">
                                Product Shipping Option
                            </label>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 text-end">
            <button type="submit" class="btn btn-primary">
                Update Book Information
            </button>
        </div>
    </div>
</form>
