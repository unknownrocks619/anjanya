<form class="form-bookmark needs-validation ajax-form" method="post" action="{{ route('admin.slider.album.store') }}"
    id="bookmark-form" novalidate="">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title" id="exampleModalLabel">Create new Album
            </h3>
            <button class="btn-close" data-original-title="test" type="button" data-bs-dismiss="modal"
                aria-label="Close">
            </button>
        </div>
        <div class="modal-body">

            <div class="row g-2">
                <div class="mb-3 col-md-6 mt-0">
                    <label for="album_name">Album Name</label>
                    <div class="form-group">
                        <input class="form-control" id="album_name" name="album_name" type="text" required=""
                            placeholder="Album Name" autocomplete="off">
                    </div>
                </div>
                <div class="mb-3 col-md-6 mt-0 d-none">
                    <label for="slider_type">Slider Type</label>
                    <div class="form-group">
                        <input class="form-control" id="slider_type" name="slider_type" type="text" value="bootstrap"
                            placeholder="Slider Type" autocomplete="off">
                    </div>
                </div>
                <div class="mb-3 col-md-6 mt-0">
                    <label for="con-name">Album Status</label>
                    <div class="form-group">
                        <div class="m-t-15 m-checkbox-inline custom-radio-ml">
                            <div class="form-check form-check-inline radio radio-primary">
                                <input class="form-check-input" id="active" type="radio" name="status"
                                    value="1" data-bs-original-title="" title="">
                                <label class="form-check-label mb-0" for="active">Active</label>
                            </div>
                            <div class="form-check form-check-inline radio radio-primary">
                                <input class="form-check-input" id="inactive" type="radio" name="status"
                                    value="0" data-bs-original-title="" title="Inactive">
                                <label class="form-check-label mb-0" for="inactive">Inactive</label>
                            </div>
                        </div>
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
