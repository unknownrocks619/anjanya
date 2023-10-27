<form class="form-bookmark needs-validation" enctype="multipart/form-data" method="post" action="{{ route('admin.maintenance.create') }}"
      id="bookmark-form" novalidate="">
    @csrf
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title" id="exampleModalLabel">Create New Maintenance Settings
            </h3>
            <button class="btn-close" data-original-title="test" type="button" data-bs-dismiss="modal"
                    aria-label="Close">
            </button>
        </div>
        <div class="modal-body">

            <div class="row g-2">
                <div class="mb-3 col-md-12 mt-0">
                    <label for="name">Maintenance Name</label>
                    <div class="form-group">
                        <input class="form-control" id="name" name="name" type="text" required=""
                               placeholder="Mode Name" autocomplete="off">
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="form-group">
                        <label for="background_color">Background Colour</label>
                        <input type="color" name="background_color" id="background_color" class="form-control" required />
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
