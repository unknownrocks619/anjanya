@php
    /** @var App\Models\ComponentBuilder $_loadComponentBuilder */
    $componentValue = $_loadComponentBuilder->values;
@endphp
<input type="hidden" name="_component_name" value="background_image" class="component_field  d-none">
<input type="hidden" name="_action" value="store" class="component_field d-none">
<input type="hidden" name="_componentID" value="{{$_loadComponentBuilder->getKey()}}" class="component_field d-none">
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="layout_type">Layout Type</label>
                            <select name="layout_type" class="form-control component_field">
                                <option value="opening" selected>Opening (Center Content)</option>
                                <option value="footer">Footer (Content and Button Side)</option>
                                <option value="overlay">Overlay (Four Element Overlay)</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="background_type">Background Type</label>
                            <select name="background_type" class="form-control component_field">
                                <option value="background_image" @if($componentValue['background_type'] == 'background_image') selected @endif>Background Image</option>
                                <option value="background_colour"  @if($componentValue['background_type'] == 'background_colour') selected @endif>Background Colour</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 my-2 background_image background_type  @if($componentValue['background_type'] != 'background_image') d-none @endif ">
                        <div class="required">
                            <label for="background_image">Background Image</label>
                            <input type="file" name="background_image_upload"
                                   class="form-control background_image_upload"/>
                        </div>
                    </div>
                    <div class="col-md-12 my-2 background_colour background_type  @if($componentValue['background_type'] != 'background_colour') d-none @endif "">
                        <div class="required">
                            <label for="background_image">Background Colour</label>
                            <input type="color" value="{{$componentValue['background_colour']}}" name="background_image_color"
                                   class="form-control"/>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Image Preview Tab -->
            <div class="col-lg-4">
                <img src="{{$componentValue['background-image']}}" class="background-image-display img-fluid"/>
                <br />
                <img src="{{$componentValue['video_poster']}}" class="video-poster-display img-fluid mt-3" />
                <br />
                <img src="{{$componentValue['front_image']}}" class="front-image-display img-fluid mt-3" />

                <input type="hidden" name="background_image" value="{{$componentValue['background-image']}}" class="component_field">
                <input type="hidden" name="video_image" value="{{$componentValue['video_poster']}}" class="component_field">
                <input type="hidden" name="front_image" value="{{$componentValue['front_image']}}" class="component_field">

            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    <label for="">Title</label>
                    <input type="text" name="title" value="{{$componentValue['title']}}" class="form-control component_field">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="background_text">Background Text</label>
                    <input type="text" name="background_text" value="{{$componentValue['background-text']}}" class="form-control component_field"/>
                </div>
            </div>
            <div class="col-md-12 my-3">
                <div class="form-group">
                    <label for="underline-text">Underline Text</label>
                    <input type="text" name="underline_world" class="form-control component_field" value="{{$componentValue['underline_text']}}">
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
            <div class="col-md-6">
                <div class="form-group">
                    <label>Button One Label</label>
                    <input type="text" name="first_button_label" value="{{$componentValue['button_one']['label']}}" class="form-control component_field">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <div class="form-group">
                        <label>Button One Link</label>
                        <input type="text" name="first_button_link" value="{{$componentValue['button_one']['link']}}" class="form-control component_field">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Button two Label</label>
                    <input type="text" name="second_button_label" value="{{$componentValue['button_two']['label']}}" class="form-control component_field">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <div class="form-group">
                        <label>Button two Link</label>
                        <input type="text" name="second_button_link" value="{{$componentValue['button_two']['link']}}" class="form-control component_field">
                    </div>
                </div>
            </div>
        </div>

        <div class="row my-3">
            <div class="col-md-6">
                <label>Display Front Image</label>
                <input type="file" name="front_image_upload"
                       class="form-control front_image_upload"/>
            </div>
            <div class="col-md-6">
                <label>Glitter Background</label>
                <select name="glitter_background"  class="form-control component_field">
                    <option value="" @if(! $componentValue['glitter_background']) selected @endif>--</option>
                    @foreach (\App\Models\GalleryAlbums::where('album_type','glitters')->get() as $glitterAlbum)
                        <option value="{{$glitterAlbum->getKey()}}" @if($componentValue['glitter_background'] == $glitterAlbum->getKey()) selected @endif>{{$glitterAlbum->album_name}}</option>
                    @endforeach
                </select>
            </div>
        </div>


    <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="video_link">Video Link</label>
                    <input type="text" name="video_link" value="{{$componentValue['video_link']}}" class="form-control component_field" />
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
                        <option value="1" @if($componentValue['enquiry_form']) selected @endif>Yes</option>
                        <option value="0" @if( ! $componentValue['enquiry_form']) selected @endif>No</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="connect_component">Connect Component</label>
                    <select multiple name="connector_component[]" id="connector_component" class="form-control component_field">
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
    $('select').select2();
    $(document).on('change','select[name="background_type"]', function(event){
        event.preventDefault();
        $('.layout_type').addClass('d-none')
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

    $(document).on('change','input.front_image_upload', function(event) {
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
                $('input[name="front_image"]').val(_response.params.image)
                $('img.front-image-display').attr('src',_response.params.image);
            })
        }
    })


</script>
