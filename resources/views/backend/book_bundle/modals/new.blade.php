<form class="form-bookmark needs-validation ajax-form" method="post" action="{{ route('admin.book.bundle.store') }}"
    id="bookmark-form" novalidate="">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title" id="exampleModalLabel">Create new Book Bundle
            </h3>
            <button class="btn-close" data-original-title="test" type="button" data-bs-dismiss="modal"
                aria-label="Close">
            </button>
        </div>
        <div class="modal-body">

            <div class="row g-2">
                <div class="mb-3 col-md-12 mt-0">
                    <label for="bundle_name">Bundle Name</label>
                    <div class="form-group">
                        <input class="form-control" id="bundle_name" name="bundle_name" type="text" required=""
                            placeholder="Course name" autocomplete="off">
                    </div>
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
