<input type="hidden" name="_component_name" value="content" class="component_field  d-none">
<input type="hidden" name="_action" value="store" class="component_field d-none">
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Title</label>
                    <input type="text" name="title" class="form-control component_field">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Subtitle</label>
                    <input type="text" name="subtitle"  class="form-control component_field" />
                </div>
            </div>
        </div>
        <div class="row my-4">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="">Description</label>
                    <textarea name="description"  class="form-control component_field tiny-mce"></textarea>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Layout Type</label>
                    <select name="layout_type" class="form-control component_field">
                        <option value="flip" selected>Flip</option>
                        <option value="zoom">Zoom</option>
                        <option value="progress">Progress</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Content Type</label>
                    <select name="content_type" class="form-control component_field no-select-2">
                        <option value="category" selected>Category</option>
                        <option value="post">Post</option>
                        <option value="page">Page</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Background Type</label>
                    <select name="background_type" class="component_field form-control no-select-2">
                        <option value="colour" selected>Colour</option>
                        <option value="image">Image</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row content-type category my-3">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Select Category</label>
                    <select name="category[]" multiple class="form-control component_field ajax-select-2"  data-action="{{route('admin.ajax-select2.categories')}}"></select>
                </div>
            </div>
        </div>

        <div class="row content-type post my-3">
            <div class="col-md-8">
                <div class="form-group">
                    <label>Select post</label>
                    <select name="post[]" multiple class="form-control component_field ajax-select-2"  data-action="{{route('admin.ajax-select2.posts')}}"></select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group d-flex align-items-center mt-1">
                    <div class="m-t-15 m-checkbox-inline">
                        <div class="form-check form-check-inline checkbox checkbox-dark mb-0">
                            <input checked="" class="form-check-input component_field" name="latest_post" id="latest_post" type="checkbox" data-bs-original-title="" title="Active">
                            <label class="form-check-label" for="latest_post">
                                Use Latest 8 post
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row content-type page my-3">
            <div class="col-md-8">
                <div class="form-group">
                    <label>Select page</label>
                    <select name="page[]" multiple class="form-control component_field ajax-select-2" data-action="{{route('admin.ajax-select2.pages')}}"></select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group d-flex align-items-center mt-1">
                    <div class="m-t-15 m-checkbox-inline">
                        <div class="form-check form-check-inline checkbox checkbox-dark mb-0">
                            <input checked="" class="form-check-input component_field" name="latest_page" id="latest_page" type="checkbox" data-bs-original-title="" title="Active">
                            <label class="form-check-label" for="latest_page">
                                Use Latest 6 Page
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row my-3">
            <div class="col-md-6 background_type colour">
                <div class="form-group">
                    <label for="">Background Colour</label>
                    <input type="color" name="background_colour" class="form-control component_field">
                </div>
            </div>
            <div class="col-md-6 background_type image d-none">
                <label for="">
                    Select Background Image
                </label>
                <input type="file" name="background_image_upload" class="background_image_upload form-control" />
                <input type="hidden" name="background_image" class="form-control component_field" />
            </div>
            <div class="col-md-6 background_type image d-none">
                <img src="" class="background_image_display" alt="" />
            </div>
        </div>

        <div class="row my-3">
            <div class="col-md-6">
                @include('themes.frontend.siddhamahayog.components.common.glitter')
            </div>
            <div class="col-md-6">
                @include('themes.frontend.siddhamahayog.components.common.connect-component')
            </div>
        </div>
    </div>
</div>

<script>
    $.each($('select'), function (index, element) {
        if (!$(element).hasClass('no-select-2')) {
            window.ajaxReinitalize(element);
        }
    });
    window.setupTinyMce();
    contentType();
    function contentType() {
        $('.content-type').addClass('d-none');
        let _selectedContent = $('select[name="content_type"]').find(':selected').val();
        $('.' + _selectedContent).removeClass('d-none');
    }

    $(document).on('change',$('select[name="content_type"]'), function() {
        contentType();
    })

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
            formData.append('component','content')
            formData.append('_action','uploadMedia')
            axios.post('/admin/components/common/upload-image/content',formData,{
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
