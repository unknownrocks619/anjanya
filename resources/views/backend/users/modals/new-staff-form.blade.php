<form class="form-bookmark needs-validation ajax-form" method="post"
    action="{{ route('admin.admin-account.new-admin-user') }}" id="bookmark-form" novalidate="">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title" id="exampleModalLabel">Create new User
            </h3>
            <button class="btn-close" data-original-title="test" type="button" data-bs-dismiss="modal"
                aria-label="Close">
            </button>
        </div>
        <div class="modal-body">

            <div class="row g-2">
                <div class="mb-3 col-md-12 mt-0">
                    <label for="con-name">First Name</label>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input class="form-control" id="con-name" name="firstname" type="text"
                                    required="" placeholder="First Name" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input class="form-control" name="lastname" id="con-last" type="text" required=""
                                    placeholder="Last Name" autocomplete="off">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-2">
                <div class="mb-3 col-md-6 mt-2">
                    <div class="form-group">
                        <label for="con-mail">Email Address</label>
                        <input class="form-control" name="email" id="con-mail" type="text" required=""
                            autocomplete="off">
                    </div>
                </div>
            </div>

            <div class="row g-2">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="con-phone">Password</label>
                        <input class="form-control" name="password" id="con-phone" type="password" required=""
                            autocomplete="off" />
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="con-phone">Confirm Password</label>
                        <input class="form-control" name="password_confirmation" id="con-phone" type="password"
                            required="" autocomplete="off" />
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
