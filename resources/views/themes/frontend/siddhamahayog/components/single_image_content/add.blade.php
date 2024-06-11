<input type="hidden" name="_component_name" value="single_image_content" class="component_field  d-none">
<input type="hidden" name="_action" value="store" class="component_field d-none">
<div class=" d-flex lc-block justify-content-between bullets-copy d-none">
    <div class="inner-bullet-wrapper d-block">
        <div  name="bullets[0][]" class=" bullets bullet-tiny-mce">
            <b>Bullet point</b>
        </div>
        <div  name="bullet_description[0][]" class="bullet-tiny-mce bullets-description my-2">
            The quick brown fox jumps over a lazy dog.
        </div>
    </div>

    <div class="align-self-center">
        <button class="btn-xs btn-danger image-content-remove-bullet">
            <i class="fa fa-trash"></i>
        </button>
    </div>
</div>


<div class="row image-content-wrapper">
    <div class="row mb-4 align-items-center left-image-content main-content-wrapper" data-count="0">
        <div class="col-lg-6 mb-4 mb-lg-0 image-button-wrapper">
            <div class="lc-block text-center">
                <img class="img-fluid w-50" src="https://cdn.livecanvas.com/media/svg/isometric/app_development_SVG.svg" srcset="" sizes="" width="" height="">
                <input type="file" name="image_upload_file" class="image_content_upload d-none">
                <input type="hidden" name="image[]" class="component_field form-control">
            </div><!-- /lc-block -->
            <button type="button" class="btn-xs btn-primary  upload_image_button">
                <i class="fas fa-cloud-upload-alt"></i>
                Upload Image
            </button>
            <button type="button" class="btn-xs btn-danger remove_image_button d-none">
                <i class="fas fa-trash"></i>
                Reset Image
            </button>
        </div><!-- /col -->
        <div class="col-lg-6 p-lg-6">
            <div class="lc-block mb-5">
                <div editable="rich">
                    <h5 name="markup_heading" class="tiny-mce component_field" >Markup Hading</h5>
                    <h1 name="heading[]" class="display-6 fw-bold text-dark tiny-mce component_field">Boost your Creativity</h1>
                    <div name="description[]" class="lead component_field tiny-mce">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse a lacus est. Etiam diam metus.</div>
                </div>
            </div><!-- /lc-block -->
            <!-- /lc-block -->
            <div class="bullets-wrapper">
                <div class=" d-flex lc-block justify-content-between">
                    <div class="inner-bullet-wrapper d-block">
                        <div  name="bullets[0][]" class=" bullets component_field tiny-mce">
                            <b>Bullet point one</b>
                        </div>
                        <div  name="bullet_description[0][]" class=" bullets-description component_field  tiny-mce my-2">
                            The quick brown fox jumps over a lazy dog.
                        </div>
                    </div>

                    <div class="align-self-center">
                        <button class="btn-xs btn-danger image-content-remove-bullet">
                            <i class="fa fa-trash"></i>
                        </button>
                    </div>
                </div>
                <button type="button" class="btn-sm btn-primary add_more_bullets mt-2">
                    <i class="fa fa-plus"></i> Bullets
                </button>
            </div>
        </div><!-- /col -->
    </div>
    <div class="col-md-12 my-3">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Layout type</label>
                    <select name="layout_type" class="form-control component_field">
                        <option value="default" selected>Default</option>
                        <option value="entrance">Entrance</option>
                        <option value="full-width">Full Width</option>
                        <option value="circular">Circular</option>
                        <option value="quotes">Quote</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Background Type</label>
                    <select name="background_type"  class="form-control component_field">
                        <option value="colour" selected> Colour </option>
                        <option value="image">Image</option>
                    </select>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 background_type colour">
                <div class="form-group">
                    <label for="">Colour</label>
                    <input type="color" name="colour" class="form-control component_field">
                </div>
            </div>
            <div class="col-md-6 background_type image d-none">
                <label for="">Image</label>
                <input type="file" name="background_image_upload" id="" class="form-control background_image_upload">
                <input type="hidden" name="background_image" class="component_field">
            </div>
            <div class="col-md-6 background_type image d-none">
                <img src="" alt="" class="background_image_display" style="max-height:100px;">
            </div>
        </div>

        @include('themes.frontend.siddhamahayog.components.common.glitter')


    </div>
</div>

<script>
    $(document).on('click','button.add_more_bullets', function (event) {
        event.preventDefault();
        let _parent= $(this).closest('div.main-content-wrapper');
        let _bulletsCopy = $('div.bullets-copy').clone();
        $(_bulletsCopy).removeClass('bullets-copy')
        $(_bulletsCopy).find('.bullets').addClass('component_field').attr('name','bullets['+$(_parent).attr('data-count')+'][]')
        $(_bulletsCopy).find('.bullets-description').addClass('component_field').attr('name','bullet_description['+$(_parent).attr('data-count')+'][]')

        $(_bulletsCopy).find('.bullet-tiny-mce').removeClass('bullet-tiny-mce').addClass('tiny-mce')
        $(this).before(_bulletsCopy)
        $(_bulletsCopy).removeClass('d-none')
        window.setupTinyMceAll();

    })

    $(document).on('click','button.image-content-remove-bullet', function(event){
        event.preventDefault();
        $(this).closest('div.lc-block').remove();
    })
    $(document).on('click','.upload_image_button', function (event) {
        event.preventDefault();
        console.log('button upl')
        let _parentWrapper = $(this).closest('div');
        console.log('parent div: ', $(_parentWrapper))
        console.log($(_parentWrapper).find('input[name=image_upload_file]'));
        $(_parentWrapper).find('input[name=image_upload_file]').trigger('click');
    })

    function resetImage(elm) {
        let _img = $(elm).closest('div').find('img');
        $(_img).attr('src', $(_img).attr('data-original-image'))
        $(elm).closest('div').find('input[name=image[]]').val('')
    }

    $(document).on('change','input[name=image_upload_file]', function(event) {
        event.preventDefault();
        const fileInput = event.target;
        const file = fileInput.files[0];
        if ( ! file ) {
            return;
        }
        let _this = this;

        if ( file ) {
            const formData = new FormData();
            formData.append('image',file);
            formData.append('name',$(this).attr('name'))
            formData.append('component','single_image_content')
            formData.append('_action','uploadImage')
            axios.post('/admin/components/common/upload-image/single_image_content',formData,{
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }).then(function(response){
                let _response = response.data;
                let _closestDiv = $(_this).closest('div.image-button-wrapper');
                $(_closestDiv).find('img').attr('src',_response.params.image);
                $(_closestDiv).find('button.upload_image_button').addClass('d-none')
                $(_closestDiv).find('button.remove_image_button').removeClass('d-none')
                $(_closestDiv).find('input[name="image[]"]').val(_response.params.image);
            })
        }
    })

    $(document).on('change','input[name=background_image_upload]', function(event) {
        event.preventDefault();
        const fileInput = event.target;
        const file = fileInput.files[0];
        if ( ! file ) {
            return;
        }
        let _this = this;

        if ( file ) {
            const formData = new FormData();
            formData.append('image',file);
            formData.append('name',$(this).attr('name'))
            formData.append('component','single_image_content')
            formData.append('_action','uploadImage')
            axios.post('/admin/components/common/upload-image/single_image_content',formData,{
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }).then(function(response){
                let _response = response.data;
                let _closestDiv = $(_this).closest('div.image-button-wrapper');
                $('input[name="background_image"]').attr('value',_response.params.image);
                $('.background_image_display').attr('src',_response.params.image);

            })
        }
    })

    $(document).on('change','select[name="background_type"]', function (event) {
        $('.background_type').addClass('d-none');
        $("."+$(this).find(':selected').val()).removeClass('d-none');
    })
    window.setupTinyMceAll();
</script>
