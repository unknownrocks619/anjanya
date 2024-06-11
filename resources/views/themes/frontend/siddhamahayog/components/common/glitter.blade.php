<div class="row my-2">
    <div class="col-md-12">
        <div class="form-group">
            <label for="">Select Glitter</label>
            <select name="glitter_background"  class="form-control component_field no-select2">
                <option value="" selected> -- </option>
                @foreach (\App\Models\GalleryAlbums::where('album_type','glitters')->get() as $glitterAlbum)
                    <option value="{{$glitterAlbum->getKey()}}" @if(isset($componentValue['glitter_background']) && $componentValue['glitter_background'] == $glitterAlbum->getKey()) selected @endif>{{$glitterAlbum->album_name}}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
