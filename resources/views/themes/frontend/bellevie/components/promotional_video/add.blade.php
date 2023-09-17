<button type="button" class="btn-sm btn-primary update-background-image">
    <i class="fa fa-upload"></i>
    Update background Image
</button>
<input type="hidden" name="_component_name" value="promotional_video" class="component_field  d-none">
<input type="hidden" name="_action" value="store" class="component_field d-none">

<div class="jumbotron parallax" id="parallax-static">
    <input type="file" class="d-none upload_image" />
    <input type="hidden" name="background_image" class="form-control d-none component_field" />
    <h4 name="subtitle" class="display-5 tiny-mce text-center component_field">Subtitle</h4>
    <h1 name="heading" class="display-3 tiny-mce component_field">Welcome to the parralax section</h1>
    <div name="description" class="lead tiny-mce component_field">Here is a short description in front of the parralax section. This is a static parallax, where the background doesn't move at all.</div>
    <div class="lead">
        <div class="row d-flex justify-content-center">
            <div class="col-md-5">
                <input type="text" name="promotional_video_link" id="promotional_video_link" class="form-control component_field" placeholder="Promotional Video Link (Only Youtube)" />
            </div>
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
    window.setupTinyMceAll()
</script>
