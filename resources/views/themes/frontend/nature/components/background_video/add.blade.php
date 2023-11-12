<input type="hidden" name="_component_name" value="background_video" class="component_field  d-none">
<input type="hidden" name="_action" value="store" class="component_field d-none">
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="background_type">Background Type</label>
                            <select name="background_type" class="form-control component_field">
                                <option value="background_image" selected>Background Image</option>
                                <option value="background_colour">Background Colour</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="layout_type">Layout Type</label>
                        <select name="layout_type" id="layout_type" class="form-control component_field">
                            <option value="boxed">Boxed</option>
                            <option value="full-width">Full Width</option>
                            <option value="general">General</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 my-2 background_image background_type">
                        <div class="required">
                            <label for="background_image">Background Image</label>
                            <input type="file" name="background_image_upload"
                                   class="form-control background_image_upload"/>
                        </div>
                    </div>
                    <div class="col-md-12 my-2 background_colour d-none background_type">
                        <div class="required">
                            <label for="background_image">Background Colour</label>
                            <input type="color" name="background_image_color"
                                   class="form-control component_field"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <img src="" class="background-image-display img-fluid"/>
                <br />
                <img src="" class="video-poster-display img-fluid mt-3" />

                <input type="hidden" name="background_image" class="component_field">
                <input type="hidden" name="video_image" class="component_field">
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    <label for="">Title</label>
                    <input type="text" name="title" class="form-control component_field">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="background_text">Background Text</label>
                    <input type="text" name="background_text" class="form-control component_field"/>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="underline-text">Underline Text</label>
                    <input type="text" name="underline_world" class="form-control component_field">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description"
                              class="tiny-mce form-control component_field"></textarea>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Button One Label</label>
                    <input type="text" name="first_button_label" class="form-control component_field">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <div class="form-group">
                        <label>Button One Link</label>
                        <input type="text" name="first_button_link" class="form-control component_field">
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="video_link">Video Link</label>
                    <input type="text" name="video_link" class="form-control component_field" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="">
                    <label for="Video Poster">Video Poster</label>
                    <input type="file" name="video_poster" class="video-poster component_field form-control">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="layout_type">Enable Enquiry Form</label>
                    <select name="enquiry_form" class="form-control component_field">
                        <option value="1">Yes</option>
                        <option value="0" selected>No</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="connect_component">Connect Component</label>
                    <select name="connector_component" id="connector_component" class="form-control component_field">
                        <option value="">Select Component</option>
                        @foreach (\App\Models\WebComponents::where('active',true)->get() as $component)
                            <option value="{{$component->getKey()}}">{{$component->component_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

    </div>
</div>
<script>
    window.setupTinyMce();

    $(document).on('change','select[name="background_type"]', function(event){
        event.preventDefault();
        $('.background_type').addClass('d-none')
        $('.'+$(this).find(':selected').val()).removeClass('d-none')
    })

    $(document).on('change','input.background_image_upload', function(event) {
        const fileInput = event.target;
        const file = fileInput.files[0];

        if ( ! file ) {
            return;
        }

        if ( file ) {
            const formData = new FormData();
            formData.append('image',file);
            formData.append('name',$(this).attr('name'))
            formData.append('component','background_image')
            formData.append('_action','uploadMedia')
            axios.post('/admin/components/common/upload-image/background_image',formData,{
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }).then(function(response){
                let _response = response.data;
                $('input[name="background_image"]').val(_response.params.image)
                $('img.background-image-display').attr('src',_response.params.image);
            })
        }
    })


    $(document).on('change','input.video-poster', function(event) {
        const fileInput = event.target;
        const file = fileInput.files[0];

        if ( ! file ) {
            return;
        }

        if ( file ) {
            const formData = new FormData();
            formData.append('image',file);
            formData.append('name',$(this).attr('name'))
            formData.append('component','background_image')
            formData.append('_action','uploadMedia')
            axios.post('/admin/components/common/upload-image/background_image',formData,{
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }).then(function(response){
                let _response = response.data;
                $('input[name="video_image"]').val(_response.params.image)
                $('img.video-poster-display').attr('src',_response.params.image);
            })
        }
    })

</script>
