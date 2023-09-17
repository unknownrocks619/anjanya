<form class="form-bookmark needs-validation" enctype="multipart/form-data" method="post" action="{{ route('admin.clients.store') }}"
      id="bookmark-form" novalidate="">
    @csrf
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title" id="exampleModalLabel">Create New Clients
            </h3>
            <button class="btn-close" data-original-title="test" type="button" data-bs-dismiss="modal"
                    aria-label="Close">
            </button>
        </div>
        <div class="modal-body">

            <div class="row g-2">
                <div class="mb-3 col-md-12 mt-0">
                    <label for="con-name">Client Name</label>
                    <div class="form-group">
                        <input class="form-control" id="con-name" name="client_name" type="text" required=""
                               placeholder="Client Name" autocomplete="off">
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="form-group">
                        <label for="client_image">Client Image</label>
                        <input type="file" name="image" id="client_image" class="form-control" required />
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
