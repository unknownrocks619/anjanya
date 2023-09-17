<form class="form-bookmark needs-validation ajax-form" method="post" action="{{ route('admin.amenities.store') }}"
      id="bookmark-form" novalidate="">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title" id="exampleModalLabel">Create New Amenities
            </h3>
            <button class="btn-close" data-original-title="test" type="button" data-bs-dismiss="modal"
                    aria-label="Close">
            </button>
        </div>
        <div class="modal-body">

            <div class="row g-2">
                <div class="mb-3 col-md-4 mt-0">
                    <div class="form-group">
                        <label for="con-name">Amenity Name</label>
                        <input type="text" name="amenities_name" id="amenities_name" class="form-control" value="" />
                    </div>
                </div>
                <div class="mb-3 col-md-4 mt-0">
                    <div class="form-group">
                        <label for="con-name">Amenity Type</label>
                        <input type="text" name="amenity_type" id="amenity_type" value="icon" class="form-control" readonly />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Icon</label>
                        <input type="text" name="amenity_icon" id="amenity_icon" class="form-control">
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
