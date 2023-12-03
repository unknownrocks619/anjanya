@php
    /** @var App\Models\ComponentBuilder $_loadComponentBuilder */
    $componentValue = $_loadComponentBuilder->values;
@endphp
<input type="hidden" name="_component_name" value="testimonials" class="component_field  d-none">
<input type="hidden" name="_action" value="store" class="component_field d-none">
<input type="hidden" name="_componentID" value="{{$_loadComponentBuilder->getKey()}}" class="component_field d-none">

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>
                Title
            </label>
            <input type="text" value="{{$componentValue['title']}}" name="title" class="form-control component_field" />
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>
                Subtitle
            </label>
            <input type="text"  value="{{$componentValue['subtitle']}}"  name="subtitle" class="form-control component_field" />
        </div>
    </div>
</div>
<div class="row mt-2">
    <div class="col-md-12">
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control tiny-mce component_field">{!! $componentValue['description'] !!}</textarea>
        </div>
    </div>
</div>

<div class="row mt-3">
    <div class="col-md-6">
        <div class="form-group">
            <label for="">Background Type</label>
            <select name="background_type" class="component_field form-control no-select-2">
                <option value="colour" {{$componentValue['background_type'] == 'colour' ? 'selected' : ''}}>Colour</option>
                <option value="image" {{$componentValue['background_type'] == 'image' ? 'selected' : ''}}>Image</option>
            </select>
        </div>
    </div>
</div>
<div class="row my-3">
    <div class="col-md-6 background_type colour  @if($componentValue['background_type'] != 'colour') d-none @endif">
        <div class="form-group">
            <label for="">Background Colour</label>
            <input type="color" name="background_colour" value="{{$componentValue['colour']}}" class="form-control component_field">
        </div>
    </div>
    <div class="col-md-6 background_type image @if($componentValue['background_type'] != 'image') d-none @endif">
        <label for="">
            Select Background Image
        </label>
        <input type="file" name="background_image_upload" class="form-control" />
        <input type="hidden" name="background_image" value="{{$componentValue['background_image']}}" class="form-control component_field" />
    </div>
    <div class="col-md-6 background_type image  @if($componentValue['background_type'] != 'image') d-none @endif">
        <img src="{{$componentValue['background_image']}}" class="background_image_display w-25" alt="" />
    </div>
    <div class="col-md-6">
        @include('themes.frontend.siddhamahayog.components.common.glitter',['componentValue' => $componentValue])
    </div>
</div>

<script>
    window.setupTinyMce();
    $(document).on('change','select[name="background_type"]', function(event){
        event.preventDefault();
        $('.background_type').addClass('d-none')
        $('.'+$(this).find(':selected').val()).removeClass('d-none')
    })

    $(document).on('change','input[name="background_image_upload"]', function(event) {
        const fileInput = event.target;
        const file = fileInput.files[0];

        if ( ! file ) {
            return;
        }

        if ( file ) {
            const formData = new FormData();
            formData.append('image',file);
            formData.append('name',$(this).attr('name'))
            formData.append('component','testimonials')
            formData.append('_action','uploadMedia')
            axios.post('/admin/components/common/upload-image/testimonials',formData,{
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }).then(function(response){
                let _response = response.data;
                $('input[name="background_image"]').val(_response.params.image)
                $('img.background_image_display').attr('src',_response.params.image);
            })
        }
    })
</script>


