<div class="bg-light px-2 py-2 text-dark">
    <div class="component-container">
        <input type="hidden" name="_component_name" value="icon_column" class="component_field  d-none">
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
            <div class="col-md-4">
                <div class="form-group">
                    <label for="media" class="text-dark">
                        Icon Position
                    </label>
                    <select name="column_position" class="form-control component_field">
                        <option value="top">top</option>
                        <option value="left">Left</option>
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
                _column += `<div class='col-md-12 d-none'>
                                <div class='form-group'>
                                    <label>Select Icon</label>
                                    <select name="icon[${i}][${j}]" class="form-control ajax-select-2 component_field" data-action=""></select>
                                </div>
                            </div>
                            <div class='col-md-12'>
                                <div class='form-group'>
                                    <label>Upload Icon</label>
                                    <input type="file" name="upload_iconFile" class="form-control upload_iconFile">
                                    <input type="hidden" name="icon_image[${i}][${j}]" class="component_field d-none">
                                </div>
                            </div>
                        <div class="col-md-12 mt-1">
                            <div class="form-group">
                                <input type="text" placeholder="Type Your Title" name="title[${i}][${j}]" class="form-control component_field" />
                            </div>
                        </div>
                        <div class="col-md-12 mt-1">
                            <div class="form-group">
                                <div name="description[${i}][${j}]" placeholder="Type your description here" class="tiny-mce component_field">Type Your Content here</div>
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

    $(document).on('change','.upload_iconFile', function(event) {
        let _this = this;
        const fileInput = event.target;
        const file = fileInput.files[0];

        if ( ! file ) {
            return;
        }

        if ( file ) {
            const formData = new FormData();
            formData.append('image',file);
            formData.append('name',$(this).attr('name'))
            formData.append('component','icon_column')
            formData.append('_action','uploadMedia')
            axios.post('/admin/components/common/upload-image/icon_column',formData,{
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }).then(function(response){
                let _response = response.data;
                console.log("target element: ", $(_this).closest('div').find('.component_field'));
                console.log('content: ',_response.image, _response);
                $(_this).closest('div').find('.component_field').val(_response.params.image);
            })
        }
    })
</script>
