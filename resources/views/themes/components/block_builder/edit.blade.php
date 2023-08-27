@php
    /** @var App\Models\ComponentBuilder $_loadComponentBuilder */
    $componentValue = $_loadComponentBuilder->values;
@endphp
<div class="row align-items-center">
    <div class="col-lg-6 col-md-6 order-2 order-md-1 mt-4 pt-2 mt-sm-0 opt-sm-0">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-6 col-6">
                <input type="hidden" name="_component_name" value="block_builder" class="d-none component_field">
                <input type="hidden" name="_componentID" value="{{$_loadComponentBuilder->getKey()}}" class="d-none component_field">
                <input type="hidden" name="_action" value="update" class="component_field d-none">
                <div class="row">
                    <div class="col-lg-12 col-md-12 mt-4 pt-2">
                        <div class="card work-desk rounded border-0 shadow-lg overflow-hidden">
                            <div class="row d-flex justify-content-center position-absolute image-button">
                                <div class="col-md-12">
                                    <input type="file" name="primary_image" class="d-none upload_image">
                                    <a href="" data-image="primary" class="upload-image btn-primary btn-sm @if ($componentValue['first_image']) d-none @endif">
                                        <i class="fa fa-image"></i>
                                        Upload Image
                                    </a>
                                    <input type="hidden" value="{{$componentValue['first_image']}}" name="primary_image_value"
                                           class="form-control component_field">
                                    <a href="" onclick="clearImage({source:'primary'});event.preventDefault();"
                                       data-image="primary" class="delete-image btn-danger btn-sm @if(! $componentValue['first_image']) d-none @endif">
                                        <i class="fa fa-trash"></i>
                                        Remove Image
                                    </a>
                                </div>
                            </div>
                            <img src="https://www.bootdey.com/image/241x362/FFB6C1/000000"
                                 class="img-fluid primary-placeholder @if($componentValue['first_image']) d-none @endif" alt="Image"/>
                            <img src="{{$componentValue['first_image']}}"
                                 style="height:362px; width:241px;" class="img-fluid primary-display @if ( ! $componentValue['first_image'] ) d-none @endif"
                                 alt="Image"/>
                            <div class="img-overlay bg-dark"></div>
                        </div>
                    </div>
                    <!--end col-->
                </div>
                <!--end row-->
            </div>
            <!--end col-->

            <div class="col-lg-6 col-md-6 col-6">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="card work-desk rounded border-0 shadow-lg overflow-hidden">
                            <div class="row d-flex justify-content-center position-absolute image-button">
                                <div class="col-md-12">
                                    <input type="file" name="secondary_image" class="d-none upload_image">
                                        <a href="" data-image="secondary" class="upload-image btn-primary btn-sm @if ($componentValue['second_image']) d-none @endif">
                                            <i class="fa fa-image"></i>
                                            Upload Image
                                        </a>
                                        <input value="{{$componentValue['second_image']}}" type="hidden" name="secondary_image_value"
                                           class="form-control component_field">

                                        <a href="" data-image="secondary"
                                           onclick="clearImage({source:'secondary'});event.preventDefault();"
                                           class="delete-image btn-danger btn-sm @if ( ! $componentValue['second_image']) d-none @endif">
                                            <i class="fa fa-trash"></i>
                                            Remove Image
                                        </a>

                                </div>
                            </div>
                            <img src="https://www.bootdey.com/image/337x450/87CEFA/000000"
                                 class="img-fluid secondary-placeholder @if($componentValue['second_image']) d-none @endif" alt="Image"/>
                            <img src="{{$componentValue['second_image']}}"
                                 style="width:450px; height:337px" class="img-fluid secondary-display @if( ! $componentValue['second_image']) d-none @endif"
                                 alt="Image"/>

                            <div class="img-overlay bg-dark"></div>
                        </div>
                    </div>
                    <!--end col-->

                    <div class="col-lg-12 col-md-12 mt-4 pt-2">
                        <div class="card work-desk rounded border-0 shadow-lg overflow-hidden">
                            <div class="row d-flex justify-content-center position-absolute image-button">
                                <div class="col-md-12">
                                    <input type="file" name="third_image" class="d-none upload_image">
                                        <a href="" data-image="third" class="upload-image btn-primary btn-sm @if($componentValue['third_image']) d-none @endif">
                                            <i class="fa fa-image"></i>
                                            Upload Image
                                        </a>
                                    <input type="hidden" value="{{$componentValue['third_image']}}" name="third_image_value" class="form-control component_field">
                                    <a href="#" onclick="clearImage({source:'third'});event.preventDefault();"
                                       data-image="third" class="delete-image btn-danger btn-sm @if(!$componentValue['third_image']) d-none @endif">
                                        <i class="fa fa-trash"></i>
                                        Remove Image
                                    </a>

                                </div>
                            </div>
                            <img src="https://www.bootdey.com/image/600x250/FF7F50/000000"
                                 class="img-fluid third-placeholder @if($componentValue['third_image']) d-none @endif " alt="Image"/>
                            <img src="{{$componentValue['third_image']}}"
                                 style="width:600px;height:250px;" class="img-fluid third-display @if(! $componentValue['third_image']) d-none @endif" alt="Image"/>
                            <div class="img-overlay bg-dark"></div>
                        </div>
                    </div>
                    <!--end col-->
                </div>
                <!--end row-->
            </div>
            <!--end col-->
        </div>
        <!--end row-->
    </div>
    <!--end col-->

    <div class="col-lg-6 col-md-6 col-12 order-1 order-md-2">
        <div class="section-title ml-lg-5">
            <h5 name="subtitle" class="text-custom font-weight-normal mb-3 tinymce-subtitle component_field tiny-mce">{!! $componentValue['subtitle'] !!}</h5>
            <h4 name="heading" class="title mb-4 tinymce-heading component_field tiny-mce">{!! $componentValue['heading'] ?? 'No heading Text'!!}</h4>
            <div name="description" class="text-muted mb-0 tinymce-body mt-3 py-3 component_field tiny-mce">{!! $componentValue['description'] ?? 'No Description' !!}</div>
        </div>
    </div>
    <!--end col-->
</div>

<script>
    function enablePreviewImage(params) {
        if ($("img." + params.source + "-placeholder").hasClass('d-none')) {
            $('img.' + params.source + "-display").attr(params.image).removeClass('d-none');
        } else {
            $("img." + params.source + "-placeholder").fadeOut('medium', function () {
                $('img.' + params.source + "-display").attr('src', params.image).removeClass('d-none').fadeIn('fast');
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
            $('img.' + params.source + "-display").fadeOut('fast', function () {
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

    $(document).on('click', '.upload-image', function (event) {
        // find closet file element to trigger.
        event.preventDefault();
        let _this = this;
        $('input[name=' + $(this).data('image') + '_image]').trigger('click');
    })

    $(document).on('change', 'input.upload_image', function (event) {
        const fileInput = event.target;
        const file = fileInput.files[0];

        if (!file) {
            return;
        }

        if (file) {
            const formData = new FormData();
            formData.append('image', file);
            formData.append('name', $(this).attr('name'))
            formData.append('component', 'block_builder')
            formData.append('_action', 'uploadMedia')
            axios.post('/admin/components/common/upload-image/block_builder', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }).then(function (response) {
                let _response = response.data;
                window.handleOKResponse(_response);
            })
        }
    })

    window.setupTinyMceAll()

</script>
