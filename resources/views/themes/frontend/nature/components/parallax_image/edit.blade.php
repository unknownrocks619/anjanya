@php
    /** @var App\Models\ComponentBuilder $_loadComponentBuilder */
    $componentValue = $_loadComponentBuilder->values;
@endphp
<button type="button" class="btn-sm btn-primary update-background-image">
    <i class="fa fa-upload"></i>
    Update background Image
</button>
<input type="hidden" name="_component_name" value="parallax_image" class="component_field  d-none">
<input type="hidden" name="_componentID" value="{{$_loadComponentBuilder->getKey()}}" class="component_field d-none">
<input type="hidden" name="_action" value="edit" class="component_field d-none">

<div class="jumbotron parallax" id="parallax-static" style="min-height: {{$componentValue['section_height']}}">
    <input type="file" class="d-none upload_image" />
    <input type="hidden" value="{{ $componentValue['background_image'] }}" name="background_image" class="form-control d-none component_field" />
    <h4 name="subtitle" class="display-5 tiny-mce text-center component_field">{{$componentValue['subtitle']}}</h4>
    <h1 name="heading" class="display-3 tiny-mce component_field">{{$componentValue['heading']}}</h1>
    <div name="description" class="lead tiny-mce component_field">
        {!! $componentValue['description'] !!}
    </div>

</div>
<div class="row mt-2">
    <div class="col-md-4">
        <div class="form-group">
            <label>Background Position</label>
            <select name="background_position" class="form-control component_field">
                <option value="center" @if($componentValue['position'] == 'center') selected @endif>Center</option>
                <option value="bottom" @if($componentValue['position'] == 'bottom') selected @endif>Bottom</option>
                <option value="top" @if($componentValue['position'] == 'top') selected @endif>Top</option>
                <option value="left" @if($componentValue['position'] == 'left') selected @endif>Left</option>
                <option value="right" @if($componentValue['position'] == 'right') selected @endif>Right</option>
            </select>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Button Label</label>
            <input type="text" name="button_label" value="{{$componentValue['button_label']}}" class="form-control component_field" />
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Button Label</label>
            <input type="text" name="button_link" value="{{$componentValue['button_link']}}" class="component_field form-control" />
        </div>
    </div>
</div>
<style>
    .inline-element {
        vertical-align: top;
    }
    .jumbotron{margin-bottom: 0; position: relative;}

    .parallax {
        /* Set a specific height */
        height: 500px;

        /* Create the parallax scrolling effect */
        background-attachment: fixed;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
    }

    /* Paragraph for Parallax Section */
    .parallax p {
        font-size: 24px;
        color:#f5f5f5;
        text-align: center;
        line-height: 60px;
    }

    /* Heading for Parallax Section */
    .parallax h1 {
        text-transform: uppercase;
        color: rgb(255, 255, 255);
        font-size: 60px;
        text-align: center;
        line-height: 100px;
    }

    #parallax-static {
        background-image: url("{{$componentValue['background_image']}}");
    }

    #parallax-slightly-moving {
        background-image: url("{{$componentValue['background_image']}}");
    }
    #parallax-slightly-moving::after {
        /* Display and position the pseudo-element */
        content: " ";
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;

        /* Move the pseudo-element back away from the camera,
         * then scale it back up to fill the viewport.
         * Because the pseudo-element is further away, it appears to move more slowly, like in real life. */
        transform: translateZ(-1px) scale(1.5);
        /* Force the background image to fill the whole element. */
        background-size: 100%;
        /* Keep the image from overlapping sibling elements. */
        z-index: -1;
    }
</style>
<script>
    $(document).on('change','select[name=background_position]', function(event) {
        let _currentPosition =$(this).find(':selected').val();
        $('.parallax').css('background-position',_currentPosition);
    })
    $(document).on('click','.update-background-image', function(event) {
        // find closet file element to trigger.
        event.preventDefault();
        let _this = this;
        $('input.upload_image').trigger('click');
    })

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
            axios.post('/admin/components/common/upload-image/parallax_image',formData,{
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }).then(function(response){
                let _response = response.data;

                $("input[name=background_image]").val(_response.params.image)
                $('#parallax-static').css('background-image',"url(" + _response.params.image + ")");
            })
        }
    })
    window.setupTinyMceAll()
</script>
