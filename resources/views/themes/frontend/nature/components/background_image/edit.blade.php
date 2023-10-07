@php
    /** @var App\Models\ComponentBuilder $_loadComponentBuilder */
    $componentValue = $_loadComponentBuilder->values;
@endphp
<input type="hidden" name="_component_name" value="background_image" class="component_field  d-none">
<input type="hidden" name="_action" value="store" class="component_field d-none">
<input type="hidden" name="_componentID" value="{{$_loadComponentBuilder->getKey()}}" class="component_field d-none">

<section class="home-banner">
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-12 my-2">
                                <div class="required">
                                    <label for="background_image">Background Image</label>
                                    <input type="file" name="background_image_upload"
                                           class="form-control background_image_upload"/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="background_text">Background Text</label>
                                    <input type="text" name="background_text" value="{{$componentValue['background-text']}}" class="form-control component_field"/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Title</label>
                                    <input type="text" name="title" value="{{$componentValue['title']}}" class="form-control component_field">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea name="description"
                                              class="tiny-mce form-control component_field">{!! $componentValue['description'] !!}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="underline-text">Underline Text</label>
                                    <input type="text" name="underline_world" value="{{$componentValue['underline_text']}}" class="form-control component_field">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Button One Label</label>
                                    <input type="text" value="{{$componentValue['button_one']['label']}}" name="first_button_label" class="form-control component_field">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label>Button One Link</label>
                                        <input type="text"  value="{{$componentValue['button_one']['link']}}"  name="first_button_link" class="form-control component_field">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Button two Label</label>
                                    <input type="text"  value="{{$componentValue['button_two']['label']}}"  name="second_button_label" class="form-control component_field">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label>Button two Link</label>
                                        <input type="text" name="second_button_link" value="{{$componentValue['button_two']['link']}}"  class="form-control component_field">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <img src="{{$componentValue['background-image']}}" class="background-image-display img-fluid"/>
                        <input type="hidden" name="background_image" value="{{$componentValue['background-image']}}" class="component_field">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    window.setupTinyMce();
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
</script>
