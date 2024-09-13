<iframe id="background_image_add_iframe" sandbox="allow-scripts allow-same-origin"
    src="{{ route('frontend.pages.page', ['slug' => request()->get('param'), 'previewMode' => 1]) }}" height="100vh"
    width="100%" loading='lazy' name="Background Image Preview" style="min-height: 100vh">
</iframe>

<script>
    window.setupTinyMce();
    $('select').select2();
    $(document).on('change', 'select[name="background_type"]', function(event) {
        event.preventDefault();
        $('.layout_type').addClass('d-none')
        $('.' + $(this).find(':selected').val()).removeClass('d-none')
    })

    $(document).on('change', 'input.background_image_upload', function(event) {
        const fileInput = event.target;
        const file = fileInput.files[0];

        if (!file) {
            return;
        }

        if (file) {
            const formData = new FormData();
            formData.append('image', file);
            formData.append('name', $(this).attr('name'))
            formData.append('component', 'background_image')
            formData.append('_action', 'uploadMedia')
            axios.post('/admin/components/common/upload-image/background_image', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }).then(function(response) {
                let _response = response.data;
                $('input[name="background_image"]').val(_response.params.image)
                $('img.background-image-display').attr('src', _response.params.image);
            })
        }
    })


    $(document).on('change', 'input.video-poster', function(event) {
        const fileInput = event.target;
        const file = fileInput.files[0];

        if (!file) {
            return;
        }

        if (file) {
            const formData = new FormData();
            formData.append('image', file);
            formData.append('name', $(this).attr('name'))
            formData.append('component', 'background_image')
            formData.append('_action', 'uploadMedia')
            axios.post('/admin/components/common/upload-image/background_image', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }).then(function(response) {
                let _response = response.data;
                $('input[name="video_image"]').val(_response.params.image)
                $('img.video-poster-display').attr('src', _response.params.image);
            })
        }
    })
</script>
