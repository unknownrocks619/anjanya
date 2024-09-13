@php
    $icons = [['fa-briefcase', 'fa-compress-arrows-alt', 'fa-expand'], ['fa-certificate', 'fa-sun', 'fa-yin-yang']];
    $iconsColors = [['#a52a2a', '#ff0000', '#000000'], ['#a52a2a', '#ff0000', '#000000']];
@endphp
<div class="bg-light px-2 py-2 text-dark d-none">
    <div class="component-container">
        <input type="hidden" name="_component_name" value="icon_column" class="component_field  d-none">
        <input type="hidden" name="_action" value="store" class="component_field d-none">

        <div class="row mt-2">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="media" class="text-dark">
                        Row
                    </label>
                    <input type="number" name="row" min="1" class="form-control component_field"
                        value="2" />
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
                        <option value="4" selected>Three</option>
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
                    <input type="text" value="Our Product Factor" name="subtitle"
                        class="form-control component_field" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="media" class="text-dark">
                        Heading
                    </label>
                    <input type="text" name="heading" value="Our Benefits" class="form-control component_field" />
                </div>
            </div>
        </div>

        <div class="row mt-2 field_generator bg-white">
            @for ($i = 1; $i <= 3; $i++)
                <div class="col-md-4">
                    <div class="form-group">
                        <input type="text" name="icon[1][{{ $i }}]" value="{{ $icons[0][$i - 1] }}"
                            class="form-control component_field">
                        <input type="text" name="title[1][{{ $i }}]"
                            value="Benefits Title {{ $i }}" class="form-control component_field">
                        <input type="text" name="description[1][{{ $i }}]"
                            value="The quick brown fox jumps over a lazy dog. The quick brown fox"
                            class="form-control component_field">
                    </div>
                </div>
            @endfor
            @for ($i = 1; $i <= 3; $i++)
                <div class="col-md-4">
                    <div class="form-group">
                        <input type="text" name="icon[2][{{ $i }}]" value="{{ $icons[1][$i - 1] }}"
                            class="form-control component_field">
                        <input type="text" name="title[2][{{ $i }}]"
                            value="Benefits Title {{ $i + 3 }}" class="form-control component_field">
                        <input type="text" name="description[2][{{ $i }}]"
                            value="The quick brown fox jumps over a lazy dog. The quick brown fox "
                            class="form-control component_field">

                    </div>
                </div>
            @endfor
        </div>
    </div>
</div>
<script type="text/javascript">
    window.CB.updateComponent()

    // function generateField() {
    //     let _no_row = $('input[name=row]').val();
    //     let _no_column = $('select[name=column]').val();
    //     console.log('kk', _no_row, _no_column);
    //     let _column = ``;
    //     for (let i = 1; i <= _no_row; i++) {
    //         _column += `<div class='row mb-2'>`;
    //         for (let j = 1; j <= (12 / _no_column); j++) {
    //             _column += `<div class='col-md-${_no_column} border my-2'>`;
    //             _column += `<div class='row'>`;
    //             _column += `<div class='col-md-12'>
    //                             <div class='form-group'>
    //                                 <label>Icon Name</label>
    //                                 <input type='text' name="icon[${i}][${j}]" class="form-control ajax-select-2 component_field" />
    //                             </div>
    //                         </div>
    //                     <div class="col-md-12 mt-1">
    //                         <div class="form-group">
    //                             <input type="text" placeholder="Type Your Title" name="title[${i}][${j}]" class="form-control component_field" />
    //                         </div>
    //                     </div>
    //                     <div class="col-md-12 mt-1">
    //                         <div class="form-group">
    //                             <div name="description[${i}][${j}]" placeholder="Type your description here" class="tiny-mce component_field">Type Your Content here</div>
    //                         </div>
    //                     </div>
    //                     `
    //             _column += `</div>`
    //             _column += `</div>`;
    //         }
    //         _column += `</div>`;
    //     }
    //     $('.field_generator').empty().append(_column);
    //     window.setupTinyMceAll()
    // }

    // $(document).on('change', "input[name=row]", function(event) {
    //     generateField();
    // });
    // $(document).on('change', "select[name=column]", function(event) {
    //     generateField();
    // });
</script>
