@php
    /** @var App\Models\ComponentBuilder $_loadComponentBuilder */
    $componentValue = $_loadComponentBuilder->values;
@endphp
<div class="bg-light px-2 py-2 text-dark">
    <div class="component-container">
        <input type="hidden" name="_component_name" value="icon_column" class="component_field  d-none">
        <input type="hidden" name="_componentID" value="{{ $_loadComponentBuilder->getKey() }}"
            class="component_field d-none">
        <input type="hidden" name="_action" value="store" class="component_field d-none">

        <div class="row my-2">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Builder Source</label>
                    <select name="builder_source" class="form-control">
                        <option value="custom">Custom</option>
                        <option value="post">Post</option>
                        <option value="category">Category</option>
                        <option value="page">Page</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row my-2">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Layout Type</label>
                    <select name="layout_type" class="form-control">
                        <option value="default">Default</option>
                        <option value="circular">Circular</option>
                        <option value="icon">Icon Only</option>
                        <option value="featured_team">Featured Team</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row mt-2 ">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="media" class="text-dark">
                        Row
                    </label>
                    <input type="number" onchange="generateField()" value="{{ $componentValue['row'] }}" name="row"
                        min="1" class="form-control component_field" value="0" />
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="media" class="text-dark">
                        Column
                    </label>
                    <select name="column" onchange="generateColumn()" class="form-control component_field">
                        <option value="12" @if ($componentValue['column'] == '12') selected @endif>One</option>
                        <option value="6" @if ($componentValue['column'] == '6') selected @endif>Two</option>
                        <option value="4" @if ($componentValue['column'] == '4') selected @endif>Three</option>
                        <option value="3" @if ($componentValue['column'] == '3') selected @endif>Four</option>
                        <option value="2" @if ($componentValue['column'] == '2') selected @endif>Six</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row mt-2 ">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="media" class="text-dark">
                        Subtitle
                    </label>
                    <input type="text" name="subtitle" value="{{ $componentValue['subtitle'] }}"
                        class="form-control component_field" />
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="media" class="text-dark">
                        Heading
                    </label>
                    <input type="text" name="heading" value="{{ $componentValue['heading'] }}"
                        class="form-control component_field" />
                </div>
            </div>
        </div>

        <div class="row post builder_source">
            <div class="alert alert-primary text-bold fs-6">
                <h5 class="alert-header alert-title fs-5 border-bottom pb-2">
                    Select Your Post More Wisely
                </h5>
                E.G: Row = 2, Column 3, Max Post displayed will be 6. 3 on First Row and 3 on Second Row
            </div>

            <div class="col-md-12 post-append-to">
                <div class="row align-items-center">
                    <div class="col-md-10">
                        <div class="form-group">
                            <label>Select Post</label>
                            <select name="posts[]" class="form-control select2">
                                <option value="1">Post one</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2 pt-2 remove-icon d-none">
                        <button class="btn btn-icon btn-danger btn-sm p-2" type="button" onclick="removeSection(this)">
                            <i class="icon-trash fs-5"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <button class="btn btn-primary" onclick="addSection('.post-append-to')" type="button">Add More
                    Post</button>
            </div>
        </div>

        <div class="row category builder_source">
            <div class="alert alert-primary text-bold fs-6">
                <h5 class="alert-header alert-title fs-5 border-bottom pb-2">
                    Select Your Category More Wisely
                </h5>
                E.G: Row = 2, Column 3, Max Category displayed will be 6. 3 on First Row and 3 on Second Row
            </div>

            <div class="col-md-12 category-append-to">
                <div class="row align-items-center">
                    <div class="col-md-10">
                        <div class="form-group">
                            <label>Select Category</label>
                            <select name="category[]" class="form-control select2">
                                <option value="1">Post one</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2 pt-2 remove-icon d-none">
                        <button class="btn btn-icon btn-danger btn-sm p-2" type="button" onclick="removeSection(this)">
                            <i class="icon-trash fs-5"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <button class="btn btn-primary" onclick="addSection('.category-append-to')" type="button">Add More
                    Category</button>
            </div>
        </div>

        <div class="row page builder_source">
            <div class="alert alert-primary text-bold fs-6">
                <h5 class="alert-header alert-title fs-5 border-bottom pb-2">
                    Select Your Page More Wisely
                </h5>
                E.G: Row = 2, Column 3, Max Page displayed will be 6. 3 on First Row and 3 on Second Row
            </div>

            <div class="col-md-12 page-append-to">
                <div class="row align-items-center">
                    <div class="col-md-10">
                        <div class="form-group">
                            <label>Select Page</label>
                            <select name="page[]" class="form-control select2">
                                <option value="1">Post one</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2 pt-2 remove-icon d-none">
                        <button class="btn btn-icon btn-danger btn-sm p-2" type="button" onclick="removeSection(this)">
                            <i class="icon-trash fs-5"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <button class="btn btn-primary" onclick="addSection('.page-append-to')" type="button">Add More
                    Page</button>
            </div>
        </div>

        <div class="row layout_type circular">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Circle Background</label>
                    <input type="color" name="circle_background" class="form-control" />
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label>First Line </label>
                    <input type="text" name="circle_first_line" class="form-control" />
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label>Second Line</label>
                    <input type="text" name="circle_second_line" class="form-control" />
                </div>
            </div>

        </div>
        <div class="row layout_type featured_team"></div>

        <div class="row mt-2 bg-white builder_source custom">
            @php
                $data = $componentValue['data'];
            @endphp
            <div class="col-md-12 field_generator">
                @foreach ($data as $rowKey => $row)
                    <div class="row mt-2">

                        @foreach ($row as $column_key => $column_value)
                            <div class="col-md-12 border my-1 column">
                                <div style="position: relative">
                                    <span class="badge bg-danger text-white fs-6"
                                        style="position: absolute; right:0; top: -10px;">
                                        Row: {{ $rowKey + 1 }} - Column: {{ $column_key + 1 }}
                                    </span>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 pt-2">
                                        <div class="form-group">
                                            <label>Select Icon</label>
                                            <input value="{{ $column_value['icon'] }}"
                                                name="icon[{{ $rowKey }}][{{ $column_key }}]"
                                                class="form-control component_field" />
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="text"
                                                name="title[{{ $rowKey }}][{{ $column_key }}]"
                                                placeholder="Type your title" value="{{ $column_value['title'] }}"
                                                class="component_field form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div name="description[{{ $rowKey }}][{{ $column_key }}]"
                                                class="tiny-mce component_field">{!! $column_value['description'] !!}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    window.setupTinyMce();

    function addMore() {

    }

    function generateField() {
        let _no_row = $('input[name=row]').val();
        let _loop_row = _no_row;
        let _no_column = $('select[name=column]').val();

        let _column = ``;
        for (let i = 1; i <= _no_row; i++) {
            _column += `<div class='row mb-2'>`;
            for (let j = 1; j <= (12 / _no_column); j++) {
                _column += `<div class='col-md-12 border my-2 column'>`;
                _column += `<div style="position: relative">
                                <span data-row='${i}' data-column='${j}' class="badge bg-danger text-white fs-6 append-row-count"
                                    style="position: absolute; right:10px; top: -10px;">
                                    Row: ${i} - Column: ${j}
                                </span>
                            </div>`;
                _column += `<div class='row'>`;
                _column += `<div class='col-md-12'>
                                <div class='form-group'>
                                    <label>Icon Name</label>
                                    <input type='text' name="icon[${i}][${j}]" class="form-control ajax-select-2 component_field" />
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


        if (_no_row == $('.field_generator').children().length) {
            // just update the column
        }

        if (_no_row > $('.field_generator').children().length) {
            let _startRowFrom = $('.field_generator').children().length + 1;

            $.each($(_column), function(index, elm) {

                if (_startRowFrom > _no_row) {
                    $(elm).remove()
                    return;
                }

                let _updateField = $(elm).find('.append-row-count');

                $.each(_updateField, function(countIndex, countElm) {
                    $(countElm).text('Row: ' + _startRowFrom + ' - Column: ' + $(countElm).attr(
                        'data-column'))
                });

                _startRowFrom++;

                $('.field_generator').append(elm);
            });


        } else {
            $.each($('.field_generator').children(), function(index, elm) {
                if ((index + 1) > _no_row) {
                    $(elm).remove();
                }
            })
        }

    }


    function generateColumn() {
        let _no_row = $('input[name=row]').val();
        let _loop_row = _no_row;
        let _no_column = $('select[name=column]').val();
        let _columnReverse = {
            12: 1,
            6: 2,
            4: 3,
            3: 4,
            2: 6
        }
        $.each($('.field_generator').children(), function(index, item) {
            // we are inside row
            let _currentColumns = $(item).children().length;
            console.log('current column: ', _currentColumns, _columnReverse[_no_column]);
            if (_currentColumns > _columnReverse[_no_column]) {
                // remove column from last.
                let _removeAfter = _columnReverse[_no_column];
                $.each($(item).children(), function(columnIndex, columnItem) {
                    if ((columnIndex + 1) > _removeAfter) {
                        $(columnItem).remove();
                    }
                })
            } else {
                let insertCount = _columnReverse[_no_column] - _currentColumns;
                let _startNumber = _currentColumns + 1;
                for (let i = 1; i <= insertCount; i++) {
                    let _column = ``;
                    _column += `<div class='col-md-12 border my-2 column'>`;
                    _column += `<div style="position: relative">
                                <span  class="badge bg-danger text-white fs-6 append-row-count"
                                    style="position: absolute; right:10px; top: -10px;">
                                    Row: ${index+1} - Column: ${_startNumber}
                                </span>
                            </div>`;
                    _column += `<div class='row'>`;
                    _column += `<div class='col-md-12'>
                                <div class='form-group'>
                                    <label>Icon Name</label>
                                    <input type='text' name="icon[${index+1}][${_startNumber}]" class="form-control ajax-select-2 component_field" />
                                </div>
                            </div>
                        <div class="col-md-12 mt-1">
                            <div class="form-group">
                                <input type="text" placeholder="Type Your Title" name="title[${index+1}][${_startNumber}]" class="form-control component_field" />
                            </div>
                        </div>
                        <div class="col-md-12 mt-1">
                            <div class="form-group">
                                <div name="description[${index+1}][${_startNumber}]" placeholder="Type your description here" class="tiny-mce component_field">Type Your Content here</div>
                            </div>
                        </div>
                        `
                    _column += `</div>`
                    _column += `</div>`;

                    $(item).append(_column);
                    _startNumber++;
                }
            }
        })



    }

    function addSection(targetWrapper) {
        let _wrapper = $(targetWrapper);
        let _clone = _wrapper.children().first().clone();
        $($(_clone).find('select').first()).select2('destroy');
        $(_wrapper).append(_clone);
        $(_clone).find('span.select2').remove();
        $(_clone).find('.remove-icon').removeClass('d-none').removeClass('.remove-icon')
        window.initSelect2();
    }

    function removeSection(elm) {
        $(elm).closest('div.row').remove();
    }
    window.initSelect2()
</script>
