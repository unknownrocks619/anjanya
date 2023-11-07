@php
    $galleryAlbums = \App\Models\GalleryAlbums::withCount(['items'])->get();
@endphp
<input type="hidden" name="_component_name" value="gallery" class="component_field  d-none">
<input type="hidden" name="_action" value="store" class="component_field d-none">

<div class="bg-light px-2 py-2">
    <div class="component-container">
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    <label class="text-dark">Section Title</label>
                    <input type="text" name="title" class="form-control component_field" />
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="text-dark">Hightlight Text</label>
                    <input type="text" name="highlight" class="form-control component_field" />
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label class="text-dark">Section Intro Text</label>
                    <textarea name="description"  class="form-control tiny-mce component_field"></textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="text-dark">Layout</label>
                <select name="layout"  class="form-control component_field">
                    <option value="grid">Grid</option>
                    <option value="mansonry">Mansori </option>
                    <option value="card">Card</option>
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="text-dark">Select Image Album</label>
                <select name="albums[]"  class="form-control select2 component_field" multiple>
                    @foreach ($galleryAlbums as $albums)
                        <option value="{{$albums->getKey()}}">{{$albums->album_name}} ({{$albums->items_count}} {{ \Illuminate\Support\Str::plural('Image',$albums->items_count)  }})</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</div>
<script>
    window.setupTinyMce()
    $('.select2').select2();
</script>
