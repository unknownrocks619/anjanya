
<form class="form-bookmark needs-validation ajax-form" method="post" action="{{route('admin.teams.store.member')}}"
    id="bookmark-form" novalidate="">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title" id="exampleModalLabel">New Team Member
            </h3>
            <button class="btn-close" data-original-title="test" type="button" data-bs-dismiss="modal"
                aria-label="Close">
            </button>
        </div>
        <div class="modal-body">
            <div class="row g-2">
                <div class="mb-3 col-md-6 mt-0">
                    <label for="name">Member Name</label>
                    <div class="form-group">
                        <input class="form-control" id="name" name="name" type="text" required=""
                            placeholder="Nenver" autocomplete="off">
                    </div>
                </div>
                <div class="mb-3 col-md-6 mt-0">
                    <label for="position">Position Name</label>
                    <div class="form-group">
                        <input class="form-control" id="position" name="position" type="text" required=""
                            placeholder="Director" autocomplete="off">
                    </div>
                </div>
            </div>

            @if(isset($team))
                <input type="hidden" name="id_team" value="{{$team->getKey()}}">
                <input type="hidden" name="callback" value='redirect'>
            @else
                <div class="row my-4">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="team">Select Team Group</label>
                            <select name="id_team" id="team" class="form-control">
                                @foreach (App\Plugins\TeamBuilder\Http\Models\TeamGroup::get() as $team)
                                    <option value="{{$team->getKey()}}">{{$team->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            @endif

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="website">Website</label>
                        <input type="url" name="website" id="website" class="form-control">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="phone_number">Phone Number</label>
                        <input type="text" name="phone_number" id="phone_number" class="form-control">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control">
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-4">
                    <div class="form-group"><label for="facebook">Facebook</label><input type="text" name="facebook" class="form-control"></div>
                </div>
                <div class="col-md-4">
                    <div class="form-group"><label for="youtube">Youtube</label><input type="text" name="youtube" class="form-control"></div>
                </div>
                <div class="col-md-4">
                    <div class="form-group"><label for="instagram">Instagram</label><input type="text" name="instagram" class="form-control"></div>
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
