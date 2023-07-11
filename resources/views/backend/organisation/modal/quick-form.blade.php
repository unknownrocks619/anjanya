<form class="form-bookmark needs-validation ajax-form" method="post" action="{{ route('admin.org.list') }}"
    id="bookmark-form" novalidate="">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title" id="exampleModalLabel">Create New Organisation
            </h3>
            <button class="btn-close" data-original-title="test" type="button" data-bs-dismiss="modal"
                aria-label="Close">
            </button>
        </div>
        <div class="modal-body">

            <div class="row g-2">
                <div class="mb-3 col-md-12 mt-0">
                    <div class="form-group">
                        <label for="con-name">Organisation Name</label>
                        <input class="form-control" id="org_name" name="org_name" type="text" required=""
                            placeholder="Organisation Name" autocomplete="off">
                    </div>
                </div>
            </div>

            <div class="row g-2">
                <div class="mb-3 col-md-12 mt-2">
                    <div class="form-group">
                        <label for="con-mail">Type</label>
                        <select name="type" id="type" class="form-control">
                            @foreach (App\Models\Organisation::ORG_TYPES as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

        </div>
        <div class="modal-footer">
            <div class="row">
                <div class="col-md-12 d-flex justify-content-end">
                    <button class="btn btn-secondary mx-2" type="submit" onclick="submitContact()">Save</button>
                    <button class="btn btn-primary mx-2" type="button" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</form>
