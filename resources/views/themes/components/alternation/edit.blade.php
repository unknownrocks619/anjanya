@php
    /** @var App\Models\ComponentBuilder $_loadComponentBuilder */
    $componentValue = $_loadComponentBuilder->values;
@endphp
<div class="row g-0 right alteration-right-original d-none">
    <div data-reset-background="https://images.unsplash.com/photo-1558985590-e84f133009b2?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=1352&amp;q=80" lc-helper="background" class="col-lg-6 order-lg-2 alteration-image-display"
         style="min-height: 45vh; background-size: cover; background-position: center; background-image: url('https://images.unsplash.com/photo-1558985590-e84f133009b2?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=1352&amp;q=80');">
        <input type="hidden" name="image_display_value[]" class="d-none form-control" />
        <input type="file" name="image_upload_file" class="d-none form-control" />
        <button type="button" class="alteration-upload_image_button btn-sm btn-primary">
            <i class="fa fa-image"></i>
            Upload Image
        </button>
        <button type="button" class="alteration-remove_image_button btn-sm btn-danger d-none">
            <i class="fa fa-trash"></i>
            Delete Image
        </button>
    </div>
    <div class="col-lg-6 order-lg-1 my-auto px-5 py-5">
        <button class="btn btn-danger my-3 alteration-remove-section">Remove Section</button>
        <div class="lc-block">
            <div editable="rich">
                <h1 name="heading[]">Your Title goes here</h1>
                <div name="description[]" class="lead">Lorem ipsum dolor sit amet Neque porro quisquam est qui dolorem Lorem int ipsum
                    dolor sit amet when an unknown printer took a galley of type. Vivamus id tempor felis. Cras
                    sagittis mi sit amet malesuada mollis. Mauris porroinit consectetur cursus tortor vel
                    interdum.</div>
            </div>
        </div>
    </div>
</div>
<input type="hidden" name="_component_name" value="alternation" class="component_field  d-none">
<input type="hidden" name="_componentID" value="{{$_loadComponentBuilder->getKey()}}" class="component_field  d-none">
<input type="hidden" name="_action" value="store" class="component_field d-none">

<div class="row g-0 left alteration-left-original d-none">
    <div data-reset-background="https://images.unsplash.com/photo-1491926626787-62db157af940?ixlib=rb-1.2.1&amp;q=80&amp;fm=jpg&amp;crop=entropy&amp;cs=tinysrgb&amp;w=1080&amp;h=768&amp;fit=crop&amp;ixid=eyJhcHBfaWQiOjM3ODR9" lc-helper="background" class="col-lg-6"
         style="min-height: 45vh; background-size: cover;background-position: center; background-image: url('https://images.unsplash.com/photo-1491926626787-62db157af940?ixlib=rb-1.2.1&amp;q=80&amp;fm=jpg&amp;crop=entropy&amp;cs=tinysrgb&amp;w=1080&amp;h=768&amp;fit=crop&amp;ixid=eyJhcHBfaWQiOjM3ODR9');">
        <input type="hidden" name="image_display_value[]" class="d-none form-control" />
        <input type="file" name="image_upload_file" class="d-none form-control" />
        <button type="button" class="alteration-upload_image_button btn-sm btn-primary">
            <i class="fa fa-image"></i>
            Upload Image
        </button>
        <button type="button" class="alteration-remove_image_button btn-sm btn-danger d-none">
            <i class="fa fa-trash"></i>
            Delete Image
        </button>
    </div>
    <div class="col-lg-6 my-auto px-5 py-5">
        <button class="btn btn-danger my-3 alteration-remove-section">Remove Section</button>
        <div class="lc-block">
            <div editable="rich">
                <h1 name="heading[]">Your Title goes here</h1>
                <div name="description[]" class="lead">Lorem ipsum dolor sit amet Neque porro quisquam est qui dolorem Lorem int ipsum
                    dolor sit amet when an unknown printer took a galley of type. Vivamus id tempor felis. Cras
                    sagittis mi sit amet malesuada mollis. Mauris porroinit consectetur cursus tortor vel
                    interdum.</div>
            </div>
        </div>
    </div>
</div>

<div class="alternation-container-wrapper">
    @foreach ($componentValue as $component)
        @if($loop->odd)
            <div class="row g-0 right alteration-row">
                <div data-reset-background="https://images.unsplash.com/photo-1558985590-e84f133009b2?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=1352&amp;q=80" lc-helper="background" class="col-lg-6 order-lg-2 "
                     style="min-height: 45vh; background-size: cover; background-position: center; background-image: @if($component['image']) url({{$component['image']}})@else url('https://images.unsplash.com/photo-1558985590-e84f133009b2?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=1352&amp;q=80');@endif">
                    <input type="hidden" name="image_display_value[]" @if($component['image']) value="{{$component['image']}}" @endif class="d-none form-control component_field" />
                    <input type="file" name="image_upload_file" class="d-none form-control" />
                    <button type="button" class="alteration-upload_image_button btn-sm btn-primary @if($component['image']) d-none @endif">
                        <i class="fa fa-image"></i>
                        Upload Image
                    </button>
                    <button type="button" onclick="resetContainer(this)" class="alteration-remove_image_button btn-sm btn-danger @if( ! $component['image']) d-none @endif">
                        <i class="fa fa-trash"></i>
                        Delete Image
                    </button>
                </div>
                <div class="col-lg-6 order-lg-1 my-auto px-5 py-5">
                    <div class="lc-block">
                        <div editable="rich">
                            <h1 name="heading[]" class="component_field tiny-mce">{!! $component['heading'] !!}</h1>
                            <div class="lead component_field tiny-mce" name="description[]">
                                {!! $component['description'] !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="row g-0 left alteration-row">
                <div lc-helper="background" class="col-lg-6"
                     data-reset-background="https://images.unsplash.com/photo-1491926626787-62db157af940?ixlib=rb-1.2.1&amp;q=80&amp;fm=jpg&amp;crop=entropy&amp;cs=tinysrgb&amp;w=1080&amp;h=768&amp;fit=crop&amp;ixid=eyJhcHBfaWQiOjM3ODR9"
                     style="min-height: 45vh; background-size: cover;background-position: center; background-image: @if($component['image']) url({{$component['image']}}); @else url('https://images.unsplash.com/photo-1491926626787-62db157af940?ixlib=rb-1.2.1&amp;q=80&amp;fm=jpg&amp;crop=entropy&amp;cs=tinysrgb&amp;w=1080&amp;h=768&amp;fit=crop&amp;ixid=eyJhcHBfaWQiOjM3ODR9') @endif">
                    <input type="hidden" name="image_display_value[]" @if($component['image']) value="{{$component['image']}}" @endif class="d-none form-control component_field" />
                    <input type="file" name="image_upload_file" class="d-none form-control" />
                    <button type="button" class="alteration-upload_image_button btn-sm btn-primary @if($component['image']) d-none @endif">
                        <i class="fa fa-image"></i>
                        Upload Image
                    </button>
                    <button type="button"  onclick="resetContainer(this)" class="alteration-remove_image_button btn-sm btn-danger @if ( ! $component['image']) d-none @endif">
                        <i class="fa fa-trash"></i>
                        Delete Image
                    </button>
                </div>
                <div class="col-lg-6 my-auto px-5 py-5">
                    <button class="btn btn-danger my-3 alteration-remove-section">Remove Section</button>
                    <div class="lc-block">
                        <div editable="rich">
                            <h1 class="component_field tiny-mce" name="heading[]">{!! $component['heading'] !!}</h1>
                            <div name="description[]" class="lead component_field tiny-mce">{!! $component['description'] !!}</div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach
</div>
<div class="row mt-2">
    <div class="col-md-12">
        <button type="button" class="btn btn-primary w-100 bg-light add-alternation-content-section">Add More Section</button>
    </div>
</div>
<script type="text/javascript">

    function resetContainer(params) {
        let _closestDiv = $(params).closest('div');
        let _resetUrl = $(_closestDiv).attr('data-reset-background');
        $(_closestDiv).css({"background-image" : "url("+_resetUrl+")"});
        $(_closestDiv).find('button.alteration-upload_image_button').removeClass('d-none')
        $(_closestDiv).find('button.alteration-remove_image_button').addClass('d-none');
        $(_closestDiv).find('input[name="image_display_value[]"]').val('')
    }

    $(document).on('click','button.add-alternation-content-section', function(event) {
        event.preventDefault();
        let _containerWrapper  = $('.alternation-container-wrapper');
        let _lastElement = $(_containerWrapper).find("div.alteration-row:last");
        let _appendContent = '';
        if ($(_lastElement).hasClass('left') )  {
            _appendContent = $('.alteration-right-original').clone();
        } else {
            _appendContent =$('.alteration-left-original').clone();
        }
        $(_appendContent).find('h1[name="heading[]"]').addClass('component_field').addClass('tiny-mce');
        $(_appendContent).find('div[name="description[]"]').addClass('component_field').addClass('tiny-mce')
        $(_appendContent).find('input[name="image_display_value[]"]').addClass('component_field');
        $(_containerWrapper).append(_appendContent);
        $(_appendContent).removeClass('d-none').removeClass('alteration-right-original').removeClass('alteration-left-original').addClass('alteration-row');

        window.setupTinyMceAll();
    });


    $(document).on('click','.alteration-upload_image_button', function (event) {
        event.preventDefault();
        let _parentWrapper = $(this).closest('div');
        $(_parentWrapper).find('input[type=file][name=image_upload_file]').trigger('click');
    })

    $(document).on('click','.alteration-remove-section', function (event) {
        event.preventDefault();
        let _parentWrapper = $(this).closest('div.alteration-row');
        $(_parentWrapper).fadeOut('fast', function (){
            $(this).remove();
        })
    })

    window.setupTinyMceAll();


    $(document).on('change','input[name=image_upload_file]', function(event) {
        console.log('hello world');
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
            formData.append('component','alternation')
            formData.append('_action','uploadImage')
            axios.post('/admin/components/common/upload-image/alternation',formData,{
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }).then(function(response){
                let _response = response.data;
                let _closestDiv = $(_this).closest('div');
                $(_closestDiv).css({"background-image" : "url("+_response.params.image+")"});
                $(_closestDiv).find('button.alteration-upload_image_button').addClass('d-none')
                $(_closestDiv).find('button.alteration-remove_image_button').removeClass('d-none')
                $(_closestDiv).find('button.alteration-remove_image_button').attr('onclick',"resetContainer(this)");
                $(_closestDiv).find('input[name="image_display_value[]"]').val(_response.params.image);
            })
        }
    })
</script>
