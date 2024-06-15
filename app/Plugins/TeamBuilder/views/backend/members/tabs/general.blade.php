<form action="{{route('admin.teams.edit.member',['member' => $member,'tab' => 'general'])}}" class="ajax-form" method="post">
    <div class="card rounded-3">
        <div class="card-body">
            <div class="row g-2">
                <div class="mb-3 col-md-6 mt-0">
                    <label for="name">Member Name</label>
                    <div class="form-group">
                        <input class="form-control" id="name" value="{{$member->name}}" name="name" type="text" required=""
                            placeholder="Nenver" autocomplete="off">
                    </div>
                </div>
                <div class="mb-3 col-md-6 mt-0">
                    <label for="position">Position Name</label>
                    <div class="form-group">
                        <input class="form-control" id="position" value="{{$member->position}}" name="position" type="text" required=""
                            placeholder="Director" autocomplete="off">
                    </div>
                </div>
            </div>

            <div class="row my-4">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="team">Select Team Group</label>
                        <select name="id_team" id="team" class="form-control">
                            @foreach (App\Plugins\TeamBuilder\Http\Models\TeamGroup::get() as $team)
                                <option @if($team->getKey() == $member->id_team) selected @endif value="{{$team->getKey()}}">{{$team->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="website">Website</label>
                        <input type="url" name="website" value="{{$member->website}}" id="website" class="form-control">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="phone_number">Phone Number</label>
                        <input type="text" name="phone_number" value="{{$member->phone_number}}" id="phone_number" class="form-control">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" value="{{$member->email}}" id="email" class="form-control">
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-4">
                    <div class="form-group"><label for="facebook">Facebook</label><input type="text" name="facebook" value="{{$member->facebook}}" class="form-control"></div>
                </div>
                <div class="col-md-4">
                    <div class="form-group"><label for="youtube">Youtube</label><input type="text" name="youtube" value="{{$member->youtube}}" class="form-control"></div>
                </div>
                <div class="col-md-4">
                    <div class="form-group"><label for="instagram">Instagram</label><input type="text" name="instagram" value="{{$member->instagram}}" class="form-control"></div>
                </div>
            </div>

        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col-md-12 text-end">
                    <button type="submit" class="btn btn-primary">
                        Save Member Info
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
