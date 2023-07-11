<form class="form-bookmark needs-validation ajax-form" method="post" action="{{ route('admin.categories.create') }}"
    id="bookmark-form" novalidate="">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title" id="exampleModalLabel">Create New Category
            </h3>
            <button class="btn-close" data-original-title="test" type="button" data-bs-dismiss="modal"
                aria-label="Close">
            </button>
        </div>
        <div class="modal-body">

            <div class="row g-2">
                <div class="mb-3 col-md-12 mt-0">
                    <label for="course_name">Category Name</label>
                    <div class="form-group">
                        <input class="form-control" id="category_name" name="category_name" type="text"
                            required="" placeholder="Category Name" autocomplete="off">
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
                            <option value="{{ $key }}">
                                {{ $value }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">

                </div>

            </div>

            <div class="row g-2">
                <div class="col-md-12">
                    <label for="">Description</label>
                    <textarea name="description" class="form-control tiny-mce"></textarea>
                </div>
            </div>

        </div>
        <div class="modal-footer">
            <div class="row">
                <div class="col-md-12 d-flex justify-content-end">
                    <button class="btn btn-secondary mx-2" type="submit">Save</button>
                    <button class="btn btn-primary mx-2" type="button" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</form>
