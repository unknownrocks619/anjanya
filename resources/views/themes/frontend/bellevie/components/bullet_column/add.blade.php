@php
    $rooms = \App\Plugins\Rooms\Http\Models\Rooms::where('status','active')->get();
@endphp
<div id="column-clone-wrapper" class="d-none">
    <h2 class="tiny-mce">Column Title</h2>
    <div class="description">
        <ul class="points" data-column-index="0">
            <li>
                Point One
            </li>
            <li class="points[0][]">
                Point Two
            </li>
            <li class="points[0][]">
                Point Three
            </li>
        </ul>
        <button class="btn-sm btn-primary add_column">
            Add New points
        </button>
    </div>
</div>
<input type="hidden" name="_component_name" value="bullet_column" class="component_field  d-none">
<input type="hidden" name="_action" value="store" class="component_field d-none">
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="column">Select Column</label>
            <select name="column" id="column" class="form-control component_field">
                <option value="2" data-index="6">Six Column</option>
                <option value="3"  data-index="4">Four Column</option>
                <option value="4" data-index="3">Three Column</option>
                <option value="6" data-index="2" selected>Two Column</option>
            </select>
        </div>
    </div>
</div>
<div class="row points-wrapper">
    <div class="col-md-6 column_wrapper" data-index="0">
        <h2 name="title[]" class="tiny-mce component_field">Column Title</h2>
        <div class="description">
            <ul class="points">
                <li class="points[0][]">
                    <span  name="points[0][]" class="tiny-mce component_field">Point One</span>
                    <a href="#" class="text-danger ms-1 remove-points"><i class='fa fa-trash'></i></a>
                </li>
                <li class="points[0][]">
                    <span  name="points[0][]" class="tiny-mce component_field">Point Two</span>
                    <a href="#" class="text-danger ms-1 remove-points"><i class='fa fa-trash'></i></a>
                </li>
                <li class="points[0][]">
                    <span  name="points[0][]" class="tiny-mce component_field">Point Three</span>
                    <a href="#" class="text-danger ms-1 remove-points"><i class='fa fa-trash'></i></a>
                </li>
            </ul>
            <button class="btn-sm btn-primary add_column mt-2">
                Add New points
            </button>
        </div>
    </div>
    <div class="col-md-6 column_wrapper" data-index="1">
        <h2 name="title[]" class="tiny-mce component_field">Column Title</h2>
        <div class="description">
            <ul class="points">
                <li name="points[2][]">
                    <span  name="points[1][]" class="tiny-mce component_field">Point One</span>
                    <a href="#" class="text-danger ms-1 remove-points"><i class='fa fa-trash'></i></a>
                </li>
                <li name="points[2][]">
                    <span  name="points[1][]" class="tiny-mce component_field">Point Two</span>
                    <a href="#" class="text-danger ms-1 remove-points"><i class='fa fa-trash'></i></a>
                </li>
                <li>
                    <span  name="points[1][]" class="tiny-mce component_field">Point Three</span>
                    <a href="#" class="text-danger ms-1 remove-points"><i class='fa fa-trash'></i></a>
                </li>
            </ul>
            <button class="btn-sm btn-primary add_column mt-2">
                Add New points
            </button>
        </div>
    </div>
</div>


<script>
    $(document).on('change','#column', function(event){
        event.preventDefault();
        let _currentIndex = $('div.points-wrapper').children('div.column_wrapper').length;
        let _currentColumn = $(this).find(':selected').val();
        let _currentLoopIndex = $(this).find(':selected').attr('data-index');

        if (_currentIndex  > _currentLoopIndex) {
            let childrenCount = 1;
            $.each($('div.points-wrapper').children('div.column_wrapper'), function(index, item) {
                if (childrenCount > _currentLoopIndex) {
                    $(item).remove();
                } else {
                    $(item).removeAttr('class')
                            .addClass('col-md-'+_currentColumn)
                            .addClass('column_wrapper')
                            .attr('data-index',index)
                }
                childrenCount++;
            })
        }

        if (_currentIndex < _currentLoopIndex) {
            let childrenCount = 1;
            $.each($('div.points-wrapper').children('div.column_wrapper'), function(index, item) {
                $(item).removeAttr('class')
                    .removeAttr('class')
                    .addClass('col-md-'+_currentColumn)
                    .addClass('column_wrapper')
                    .attr('data-index',index)
                childrenCount++;
            })
            for(let i = _currentIndex; i < _currentLoopIndex; i++)  {
                let _column = `<div class='col-md-${_currentColumn} column_wrapper' data-index='${i}'>
                                    <h2 name="title[]" class="tiny-mce component_field">Column Title</h2>
                                    <div class="description">
                                    <ul class="points">
                                        <li>
                                            <span name="points[${i}][]" class="tiny-mce component_field">Point One</span>
                                            <a href="#" class="text-danger ms-1 remove-points"><i class='fa fa-trash'></i></a>
                                        </li>
                                        <li>
                                            <span  name="points[${i}][]" class="tiny-mce component_field">Point Two</span>
                                            <a href="#" class="text-danger ms-1 remove-points"><i class='fa fa-trash'></i></a>
                                        </li>
                                        <li>
                                            <span  name="points[${i}][]" class="tiny-mce component_field">Point Three</span>
                                            <a href="#" class="text-danger ms-1 remove-points"><i class='fa fa-trash'></i></a>
                                        </li>
                                    </ul>
                                    <button class="btn-sm btn-primary add_column mt-2">
                                        Add New points
                                    </button>
                                </div>
                            </div>`;
                $('div.points-wrapper').append(_column);
            }
        }
        window.setupTinyMceAll();

    })
    $(document).on('click','.add_column', function (event){
        event.preventDefault();
        let _ulWrapper = $(this).closest('div.description').find('ul');
        let _currentIndex = $(this).closest('div.column_wrapper').attr('data-index');
        console.log('ul wrapper: ', _ulWrapper, _currentIndex);
        let _li = `<li><span name="points[${_currentIndex}][]" class="component_field tiny-mce">Bullet Point</span><a href="#" class="text-danger remove-points ms-1"><i class='fa fa-trash'></i></a></li>`
        $(_ulWrapper).append(_li);
        window.setupTinyMceAll();

    })
    $(document).on('click','.remove-points', function(event) {
        event.preventDefault();
       $(this).closest('li').remove();
    });
    window.setupTinyMceAll();
</script>
