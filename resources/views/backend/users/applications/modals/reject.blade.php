<form class="form-bookmark needs-validation ajax-form" method="post" action="{{ route('admin.users.applications.reject',['application' => $application,'user' => $user]) }}"
    id="application-reject" novalidate="">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title" id="exampleModalLabel">Reject Confirmation
            </h3>
            <button class="btn-close" data-original-title="test" type="button" data-bs-dismiss="modal"
                aria-label="Close">
            </button>
        </div>
        <div class="modal-body">

            <div class="row g-2">
                <div class="mb-3 col-md-12 mt-0">
                    <label for="con-name">Please provide reason for rejection.</label>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <textarea name="reject_message" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="User Group">
                            Re Submission Tab
                        </label>
                        <select name="resubmission_tab" id="resubmission" class="form-control">
                            @foreach (\App\Models\User::REGISTRATION_STEPS as $key => $value)
                                <option value="{{ $key }}">{{ ucwords(str_replace('_', ' ', $value)) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

        </div>
        <div class="modal-footer">
            <div class="row">
                <div class="col-md-12 d-flex justify-content-end">
                    <button class="btn btn-secondary mx-2" type="submit">Confirm Reject</button>
                    <button class="btn btn-primary mx-2" type="button" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</form>
