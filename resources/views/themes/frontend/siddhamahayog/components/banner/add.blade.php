<input type="hidden" name="_component_name" value="banner" class="component_field  d-none">
<input type="hidden" name="_action" value="store" class="component_field d-none">
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="title"  class="component_field form-control">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Subtitle</label>
                    <input type="text" name="subtitle"  class="component_field form-control" />
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Background Type</label>
                    <select name="background_type" class="component_field form-control">
                        <option value="colour" selected>Colour</option>
                        <option value="image">Image</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 my-2 background_type colour">
                <div class="required">
                    <label>Background Colour</label>
                    <input type="color" name="background_colour"
                           class="component_field form-control"/>
                </div>
            </div>
            <div class="col-md-6 my-2 background_type image d-none">
                <div class="required">
                    <label>Background Image</label>
                    <input type="file" name="background_image_upload" class="form-control">
                    <input type="hidden" name="background_image" class="component_field d-none form-control">
                </div>
            </div>
            <div class="col-md-6 my-2 background_type image d-none">
                <img src="" class="background_image_display img-fluid w-25" />
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description"
                              class="tiny-mce form-control component_field"></textarea>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Button Label</label>
                    <input type="text" name="button_label" class="form-control component_field" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Button Link</label>
                    <input type="text" name="button_link" class="form-control component_field" />
                </div>
            </div>
        </div>
    </div>
</div>
<script>

    $(document).on('change','select[name="background_type"]', function(event){
        event.preventDefault();
        $('.background_type').addClass('d-none')
        $('.'+$(this).find(':selected').val()).removeClass('d-none')
    })

    $(document).on('change','input[name="background_image_upload"]', function(event) {
        let _this = this;
        const fileInput = event.target;
        const file = fileInput.files[0];

        if ( file ) {
            const formData = new FormData();
            formData.append('image',file);
            formData.append('name',$(this).attr('name'))
            formData.append('component','banner')
            formData.append('_action','uploadMedia')
            axios.post('/admin/components/common/upload-image/banner',formData,{
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }).then(function(response){
                let _response = response.data;
                $('input[name="background_image"]').val(_response.params.image);
                $('img.background_image_display').attr('src',_response.params.image).attr('srcset',_response.params.image);
            })
        }
    })

    $(document).on('change','input[name="video_poster_upload"]', function(event) {
        let _this = this;
        const fileInput = event.target;
        const file = fileInput.files[0];

        if ( file ) {
            const formData = new FormData();
            formData.append('image',file);
            formData.append('name',$(this).attr('name'))
            formData.append('component','banner')
            formData.append('_action','uploadMedia')

            axios.post('/admin/components/common/upload-image/banner',formData,{
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }).then(function(response){
                let _response = response.data;
                $('input[name="video_poster"]').val(_response.params.image);
                $('img.video_poster_image_display').attr('src',_response.params.image).attr('srcset',_response.params.image);
            })
        }
    })

    window.setupTinyMce();
</script>
