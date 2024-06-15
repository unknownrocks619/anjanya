<form action="{{route('admin.teams.edit',['team' => $team,'tab' => 'general'])}}" class="ajax-form" method="post">
    <div class="card rounded-3">
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="team_name">Team name
                            <sup class="text-danger">*</sup>
                        </label>
                        <input type="text" name="name" value="{{$team->name}}" id="room_name"
                               class="form-control"/>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="room_slug">Slug Name</label>
                        <input type="text" name="slug" id="slug" readonly class="form-control"
                               placeholder="[Auto Generated]" value="{{$team->slug}}"/>
                    </div>
                </div>
            </div>

            <div class="row my-3">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="default">Active Group</label>
                        <select name="default_group" id="default_group" class="form-control">
                            <option value="1" @if($team->default_group)  selected @endif>Yes</option>
                            <option value="0"  @if( ! $team->default_group)  selected @endif>No</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="full_description">
                            Full Description
                            <sup class="text-danger">*</sup>
                        </label>
                        <textarea name="description" id="full_description"
                                  class="form-control tiny-mce">{!! $team->description !!}</textarea>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col-md-12 text-end">
                    <button type="submit" class="btn btn-primary">
                        Save Team
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
