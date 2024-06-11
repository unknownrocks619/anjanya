<form class="form-bookmark needs-validation ajax-append ajax-form" method="post" action="{{route('admin.gallery-album.store')}}"
      id="bookmark-form" novalidate="">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title" id="exampleModalLabel">Create New Album
            </h3>
            <button class="btn-close" data-original-title="test" type="button" data-bs-dismiss="modal"
                    aria-label="Close">
            </button>
        </div>
        <div class="modal-body">

            <div class="row g-2">
                <div class="mb-3 col-md-8 mt-0">
                    <label for="course_name">Album Name</label>
                    <div class="form-group">
                        <input class="form-control" id="album_name" name="album_name" type="text"
                               required="" placeholder="Album name" autocomplete="off">
                    </div>
                </div>
                <div class="mb-3 col-md-4 mt-0">
                    <label for="course_name">Album Type</label>
                    <div class="form-group">
                        <select name="album_type" id="album_type" class="form-control">
                            <option value="general" selected>Gallery</option>
                            <option value="glitters">Glitters</option>
                        </select>
                    </div>
                </div>

            </div>

            <div class="row g-2">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Description</label>
                        <textarea name="description" class="form-control tiny-mce"></textarea>
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
