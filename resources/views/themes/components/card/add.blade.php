<div class="bg-light px-2 py-2 text-dark">
    <div class="component-container">
        <input type="hidden" name="_component_name" value="card" class="component_field  d-none">
        <input type="hidden" name="_action" value="store" class="component_field d-none">

        <div class="row mt-2">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="media" class="text-dark">
                        Row
                    </label>
                    <input type="number" name="row" min="1" class="form-control component_field" value="0" />
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="media" class="text-dark">
                        Column
                    </label>
                    <select name="column" class="form-control component_field">
                        <option value="12">One</option>
                        <option value="6">Two</option>
                        <option value="4">Three</option>
                        <option value="3">Four</option>
                        <option value="2">Six</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="media" class="text-dark">
                        Subtitle
                    </label>
                    <input type="text" name="subtitle" class="form-control component_field" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="media" class="text-dark">
                        Heading
                    </label>
                    <input type="text" name="heading" class="form-control component_field" />
                </div>
            </div>
        </div>

        <div class="row mt-2 field_generator bg-white">

        </div>
    </div>
</div>
<script type="text/javascript">
    function generateField() {
        let _no_row = $('input[name=row]').val();
        let _no_column = $('select[name=column]').val();
        let _column = ``;
        for (let i = 1; i <= _no_row; i++) {
             _column += `<div class='row mb-2'>`;
            for ( let j= 1 ; j <= (12/_no_column); j++) {
                _column += `<div class='col-md-${_no_column} border my-2'>`;
                _column += `<div class='row'>`;
                _column += `<div class='col-md-12'>
                                <div class="card shadow mx-auto">
                                    <div class="card-body">
                                            <button class="btn btn-sm btn-primary upload-image-button">
                                                <i class="fa fa-upload"></i>
                                                Upload Gallery
                                            </button>
                                            <input type="file" class="upload_image_trigger d-none">
                                            <input type="hidden" name="image[${i}][${j}]" class="component_field image_holder">
                                            <img  class=" img-fluid" src="https://images.unsplash.com/photo-1617886903355-9354bb57b5d4?crop=entropy&amp;cs=tinysrgb&amp;fit=crop&amp;fm=jpg&amp;ixid=M3wzNzg0fDB8MXxzZWFyY2h8NHx8ZnVybml0dXJlJTIwcmVkfGVufDB8Mnx8fDE2OTE0ODcxMjF8MA&amp;ixlib=rb-4.0.3&amp;q=80&amp;w=1080&amp;h=1080" srcset="https://images.unsplash.com/photo-1617886903355-9354bb57b5d4?crop=entropy&amp;cs=tinysrgb&amp;fit=crop&amp;fm=jpg&amp;ixid=M3wzNzg0fDB8MXxzZWFyY2h8NHx8ZnVybml0dXJlJTIwcmVkfGVufDB8Mnx8fDE2OTE0ODcxMjF8MA&amp;ixlib=rb-4.0.3&amp;q=80&amp;w=1080&amp;h=1080 1080w, https://images.unsplash.com/photo-1617886903355-9354bb57b5d4??crop=entropy&amp;cs=tinysrgb&amp;fit=crop&amp;fm=jpg&amp;ixid=M3wzNzg0fDB8MXxzZWFyY2h8NHx8ZnVybml0dXJlJTIwcmVkfGVufDB8Mnx8fDE2OTE0ODcxMjF8MA&amp;ixlib=rb-4.0.3&amp;q=80&amp;w=150 150w, https://images.unsplash.com/photo-1617886903355-9354bb57b5d4??crop=entropy&amp;cs=tinysrgb&amp;fit=crop&amp;fm=jpg&amp;ixid=M3wzNzg0fDB8MXxzZWFyY2h8NHx8ZnVybml0dXJlJTIwcmVkfGVufDB8Mnx8fDE2OTE0ODcxMjF8MA&amp;ixlib=rb-4.0.3&amp;q=80&amp;w=300 300w, https://images.unsplash.com/photo-1617886903355-9354bb57b5d4??crop=entropy&amp;cs=tinysrgb&amp;fit=crop&amp;fm=jpg&amp;ixid=M3wzNzg0fDB8MXxzZWFyY2h8NHx8ZnVybml0dXJlJTIwcmVkfGVufDB8Mnx8fDE2OTE0ODcxMjF8MA&amp;ixlib=rb-4.0.3&amp;q=80&amp;w=768 768w, https://images.unsplash.com/photo-1617886903355-9354bb57b5d4??crop=entropy&amp;cs=tinysrgb&amp;fit=crop&amp;fm=jpg&amp;ixid=M3wzNzg0fDB8MXxzZWFyY2h8NHx8ZnVybml0dXJlJTIwcmVkfGVufDB8Mnx8fDE2OTE0ODcxMjF8MA&amp;ixlib=rb-4.0.3&amp;q=80&amp;w=1024 1024w" sizes="(max-width: 1080px) 100vw, 1080px" width="1080" height="1080" alt="Photo by Jon Tyson" loading="lazy">
                                    </div>
                                    <div class="card-body">
                                        <div class="lc-block mb-3">
                                            <div>

                                                <input class="h5 component_field form-control" name="title[${i}][${j}]" placeholder="Title"  />

                                                <textarea class="component_field tiny-mce form-control" name="description[${i}][${j}]">Some quick example text to build on the card title and make up the bulk of the card's content..</textarea>
                                            </div>
                                        </div>
                                        <div class="lc-block">
                                            <input type="text" name="button[${i}][${j}]" class="component_field" placeholder="button_link">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `
                _column += `</div>`
                _column += `</div>`;
            }
            _column += `</div>`;
        }
        $('.field_generator').empty().append(_column);

        window.setupTinyMceAll()
    }

    $(document).on('change',"input[name=row]", function(event){
        generateField();
    });
    $(document).on('change',"select[name=column]", function(event){
        generateField();
    });

    $(document).on('click','.upload-image-button', function(event) {
        event.preventDefault();
        $(this).closest('div.card-body').find('input.upload_image_trigger').trigger('click');
    });

    $(document).on('change','.upload_image_trigger', function(event) {
        let _this = this;
        const fileInput = event.target;
        const file = fileInput.files[0];

        if ( file ) {
            const formData = new FormData();
            formData.append('image',file);
            formData.append('name',$(this).attr('name'))
            formData.append('component','icon_column')
            formData.append('_action','uploadMedia')
            axios.post('/admin/components/common/upload-image/card',formData,{
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }).then(function(response){
                let _response = response.data;
                console.log('params: ', _response.params.image);
                $(_this).closest('div').find('.component_field').val(_response.params.image);
                $(_this).closest('div').find('img').attr('src',_response.params.image).attr('srcset',_response.params.image);
            })
        }
    })
</script>
