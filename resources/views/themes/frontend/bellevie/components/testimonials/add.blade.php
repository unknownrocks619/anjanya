<input type="hidden" name="_component_name" value="testimonials" class="component_field  d-none">
<input type="hidden" name="_action" value="store" class="component_field d-none">
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>
                Titles
            </label>
            <input type="text" name="title" class="form-control component_field" />
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>
                Subtitle
            </label>
            <input type="text" name="subtitle" class="form-control component_field" />
        </div>
    </div>
    <div class="col-md-6 mt-3">
        <div class="form-group">
            <label>Background Image</label>
            <input type="file" class="form-control upload_image">
            <input type="hidden" name="background_image" class="component_field">
        </div>
    </div>
</div>

<script>
    $(document).on('change','input.upload_image', function(event) {
        const fileInput = event.target;
        const file = fileInput.files[0];

        if ( ! file ) {
            return;
        }

        if ( file ) {
            const formData = new FormData();
            formData.append('image',file);
            formData.append('name',$(this).attr('name'))
            formData.append('component','block_builder')
            formData.append('_action','uploadMedia')
            axios.post('/admin/components/common/upload-image/testimonials',formData,{
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }).then(function(response){
                let _response = response.data;
                $('input[name="background_image"]').val(_response.params.image);
            })
        }
    })
</script>
