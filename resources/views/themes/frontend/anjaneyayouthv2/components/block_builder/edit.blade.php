@php
    /** @var App\Models\ComponentBuilder $_loadComponentBuilder */
    $componentValue = $_loadComponentBuilder->values;
@endphp
<input type="hidden" name="_component_name" value="block_builder" class="component_field d-none">
<input type="hidden" name="_action" value="update" class="component_field d-none">
<input type="hidden" name="_componentID" class="component_field d-none" value="{{ $_loadComponentBuilder->getKey() }}" />

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="subtitle">Sub Heading</label>
            <input type="text" name="subtitle" value="{{ trim($componentValue['subtitle']) ?? '' }}"
                class="form-control component_field">
        </div>
    </div>
</div>

<div class="row mt-2">
    <div class="col-md-12">
        <div class="form-group">
            <label for="heading">Heading</label>
            <input type="text" name="heading" value="{{ $componentValue['heading'] ?? 'No heading Text' }}"
                class="form-control component_field" />
        </div>
    </div>
</div>

<div class="row mt-2">
    <div class="col-md-12">
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control component_field tiny-mce">{!! $componentValue['description'] ?? 'No Description' !!}</textarea>
        </div>
    </div>
</div>

<div class="row border-top border-2">

    <div class="col-md-12 mt-3">
        <div class="form-group">
            <h5 class="fs-6">First Image</h5>
            <img src="{{ $componentValue['first_image'] }}"
                class="img-fluid primary-display @if (!$componentValue['first_image']) d-none @endif" alt="Image" />
            <img src="https://images.unsplash.com/photo-1525296143957-b62256c593bf?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1000&q=80"
                class="img-fluid primary-placeholder @if ($componentValue['first_image']) d-none @endif" alt="Image" />
            <div class="d-block mt-3">
                <a href="" data-image="primary" onclick="uploadImageTrigger(this);event.preventDefault()"
                    class="upload-image btn-primary btn-sm @if ($componentValue['first_image']) d-none @endif">
                    <i class="fa fa-image"></i>
                    Upload Image
                </a>
                <a href="" onclick="clearImage({source:'primary'});event.preventDefault();" data-image="primary"
                    class="delete-image btn-danger btn-sm @if (!$componentValue['first_image']) d-none @endif">
                    <i class="fa fa-trash"></i>
                    Remove Image
                </a>

            </div>

            <input type="file" onchange="uploadImageToServer(this)" name="primary_image" class="d-none upload_image">
            <input type="hidden" value="{{ $componentValue['first_image'] }}" name="primary_image_value"
                class="form-control component_field" />
        </div>
    </div>

    <div class="col-md-12 mt-3">
        <div class="form-group">
            <h5 class="fs-6">Second Image</h5>
            <img src="{{ $componentValue['second_image'] }}"
                class="img-fluid secondary-display @if (!$componentValue['second_image']) d-none @endif" alt="Image" />
            <img src="https://images.unsplash.com/photo-1507831228884-93d43e81a99d?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=632&q=80"
                class="img-fluid secondary-placeholder @if ($componentValue['second_image']) d-none @endif"
                alt="Image" />
            <div class="d-block mt-3">
                <a href="" data-image="secondary" onclick="uploadImageTrigger(this);event.preventDefault()"
                    class="upload-image btn-secondary btn-sm @if ($componentValue['second_image']) d-none @endif">
                    <i class="fa fa-image"></i>
                    Upload Image
                </a>
                <a href="" onclick="clearImage({source:'secondary'});event.preventDefault();"
                    data-image="secondary"
                    class="delete-image btn-danger btn-sm @if (!$componentValue['second_image']) d-none @endif">
                    <i class="fa fa-trash"></i>
                    Remove Image
                </a>

            </div>

            <input type="file" onchange="uploadImageToServer(this)" name="secondary_image"
                class="d-none upload_image">
            <input type="hidden" value="{{ $componentValue['second_image'] }}" name="secondary_image_value"
                class="form-control component_field" />
        </div>
    </div>

    <div class="col-md-12 mt-3">
        <div class="form-group">
            <h5 class="fs-6">Third Image</h5>
            <img src="{{ $componentValue['third_image'] }}"
                class="img-fluid third-display @if (!$componentValue['third_image']) d-none @endif" alt="Image" />
            <img src="https://images.unsplash.com/photo-1536060316316-2466bda904f1?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1000&q=80"
                class="img-fluid third-placeholder @if ($componentValue['third_image']) d-none @endif" alt="Image" />
            <div class="d-block mt-3">
                <a href="" data-image="third" onclick="uploadImageTrigger(this);event.preventDefault()"
                    class="upload-image btn-secondary btn-sm @if ($componentValue['third_image']) d-none @endif">
                    <i class="fa fa-image"></i>
                    Upload Image
                </a>
                <a href="" onclick="clearImage({source:'third'});event.preventDefault();" data-image="third"
                    class="delete-image btn-danger btn-sm @if (!$componentValue['third_image']) d-none @endif">
                    <i class="fa fa-trash"></i>
                    Remove Image
                </a>

            </div>

            <input type="file" onchange="uploadImageToServer(this)" name="third_image"
                class="d-none upload_image">
            <input type="hidden" value="{{ $componentValue['third_image'] }}" name="third_image_value"
                class="form-control component_field" />
        </div>
    </div>
</div>

<script>
    $(() => {
        window.setupTinyMce();
    })

    function enablePreviewImage(params) {
        if ($("img." + params.source + "-placeholder").hasClass('d-none')) {
            $('img.' + params.source + "-display").attr(params.image).removeClass('d-none');
        } else {
            $("img." + params.source + "-placeholder").fadeOut('medium', function() {
                $('img.' + params.source + "-display").attr('src', params.image).removeClass('d-none').fadeIn(
                    'fast');
                $(this).addClass('d-none');
                $('a.upload-image[data-image="' + params.source + '"]').addClass('d-none')
                $('a.delete-image[data-image="' + params.source + '"]').removeClass('d-none')
            })
        }
        $('input[name=' + params.source + '_image_value]').val(params.image);
    }

    function clearImage(params) {

        $("input[name=" + params.source + "_image]").val('');

        if (!$('img.' + params.source + "-display").hasClass('d-none')) {
            $('img.' + params.source + "-display").fadeOut('fast', function() {
                $(this).addClass('d-none');
                $('img.' + params.source + "-placeholder").fadeIn('fast').removeClass('d-none')
            })
        }
        if ($('img.' + params.source + "-placeholder").hasClass('d-none')) {
            $('img.' + params.source + "-placeholder").removeClass('d-none');
        }

        $('input[name=' + params.source + '_image_value]').val('');
        $('a.upload-image[data-image="' + params.source + '"]').removeClass('d-none')
        $('a.delete-image[data-image="' + params.source + '"]').addClass('d-none')
    }

    var uploadImageTrigger = function(elm) {
        $('input[name=' + $(elm).data('image') + '_image]').trigger('click');
    }

    // $(document).on('click', '.upload-image', function(event) {
    //     // find closet file element to trigger.
    //     event.preventDefault();
    //     let _this = this;
    //     $('input[name=' + $(this).data('image') + '_image]').trigger('click');
    // })

    var uploadImageToServer = function(elm) {
        // const fileInput = event.target;
        const file = elm.files[0];

        if (!file) {
            return;
        }

        if (file) {
            const formData = new FormData();
            formData.append('image', file);
            formData.append('name', $(elm).attr('name'))
            formData.append('component', 'block_builder')
            formData.append('_action', 'uploadMedia')
            axios.post('/admin/components/common/upload-image/block_builder', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }).then(function(response) {
                let _response = response.data;
                window.handleOKResponse(_response);
            })
        }
    }

    // $(document).on('change', 'input.upload_image', function(event) {
    //     const fileInput = event.target;
    //     const file = fileInput.files[0];

    //     if (!file) {
    //         return;
    //     }

    //     if (file) {
    //         const formData = new FormData();
    //         formData.append('image', file);
    //         formData.append('name', $(this).attr('name'))
    //         formData.append('component', 'block_builder')
    //         formData.append('_action', 'uploadMedia')
    //         axios.post('/admin/components/common/upload-image/block_builder', formData, {
    //             headers: {
    //                 'Content-Type': 'multipart/form-data'
    //             }
    //         }).then(function(response) {
    //             let _response = response.data;
    //             window.handleOKResponse(_response);
    //         })
    //     }
    // })
</script>
