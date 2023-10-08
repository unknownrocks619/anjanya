<button type="button" class="btn-sm btn-primary update-background-image">
    <i class="fa fa-upload"></i>
    Update background Image
</button>
<input type="hidden" name="_component_name" value="promotional_video" class="component_field  d-none">
<input type="hidden" name="_action" value="store" class="component_field d-none">
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="">
                Title
            </label>
            <input type="text" name="title" id="" class="form-control component_field" />
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="">
                Background Title
            </label>
            <input type="text" name="background_title" id="" class="form-control component_field" />
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <label for="">
            Description
        </label>
        <textarea name="description" class="form-control tiny-mce component_field"></textarea>
    </div>
</div>

<div class="row mt-3">
    <div class="col-md-6">
        <div class="form-group">
            <label for="">Background Type</label>
            <select name="background_type" class="form-control component_field">
                <option value="color">Colour</option>
                <option value="image" selected>Image</option>
            </select>
        </div>
    </div>
    <div class="col-md-6 mt-2">
        <div>
            <label for="">
                Select Image
            </label>
            <input type="file" name="background_image_file" class="form-control">
            <input type="hidden" name="background_image" class="form-control d-none component_field">
        </div>
    </div>
    <div class="col-md-6 mt-2 d-none">
        <div class="form-group">
            <label for="">
                Select background Colour
            </label>
            <input type="color" name="background_color" class="form-control component_field">
        </div>
    </div>
</div>

<style>
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
        background-image: url("https://cdn.pixabay.com/photo/2016/11/29/04/19/beach-1867285_1280.jpg");
    }

    #parallax-slightly-moving {
        background-image: url("https://cdn.pixabay.com/photo/2015/09/09/16/05/forest-931706_1280.jpg");
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
            axios.post('/admin/components/common/upload-image/promotional_video',formData,{
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }).then(function(response){
                let _response = response.data;
                $('input[name="background_image"]').val(_response.image)
                $('#parallax-static').css('background-image',"url(" + _response.params.image + ")");
            })
        }
    })
    window.setupTinyMce()
</script>
