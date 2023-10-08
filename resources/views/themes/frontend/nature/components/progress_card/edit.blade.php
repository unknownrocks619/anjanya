@php
    /** @var App\Models\ComponentBuilder $_loadComponentBuilder */
    $componentValue = $_loadComponentBuilder->values;
@endphp
<div class="row clone-container mt-2 d-none">
    <div class="col-md-10">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="card-title">
                        Card title
                    </label>
                    <input type="text" name="card_title[]" class="form-control" />
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="number_color">
                        Select Number Colour
                    </label>
                    <input type="color" name="number_color[]" class="form-control" />
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="background_colour">Background Color</label>
                    <input type="color" name="background_color[]" class="form-control">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="Card Description">
                        Card Description
                    </label>
                    <textarea name="card_description[]"  class="form-control"></textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-2 d-flex align-item-center">
        <button type="button" class="btn btn-danger remove-card">Remove Card</button>
    </div>
</div>

<input type="hidden" name="_component_name" value="progress_card" class="component_field  d-none">
<input type="hidden" name="_action" value="store" class="component_field d-none">
<input type="hidden" name="_componentID" value="{{$_loadComponentBuilder->getKey()}}" class="component_field d-none">

<section>
    @foreach($componentValue as $values)
        <div class="row">
            <div class="col-md-{{ ! $loop->first ? '10' : 12}}">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="card-title">
                                Card title
                            </label>
                            <input type="text" name="card_title[]" value="{{$values['title']}}"
                                   class="form-control component_field"/>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="number_color">
                                Select Number Colour
                            </label>
                            <input type="color" name="number_color[]" value="{{$values['number_colour']}}"
                                   class="form-control component_field"/>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="background_colour">Background Color</label>
                            <input type="color" name="background_color[]" value="{{$values['background_colour']}}"
                                   class="form-control component_field">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="Card Description">
                                Card Description
                            </label>
                            <textarea name="card_description[]"
                                      class="tiny-mce form-control component_field">{!! $values['description'] !!}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            @if( ! $loop->first)
                <div class="col-md-2 d-flex align-item-center">
                    <button type="button" class="btn btn-danger remove-card">Remove Card</button>
                </div>
            @endif
        </div>
    @endforeach
</section>
<div class="row">
    <div class="col-md-12">
        <button type="button" class="btn btn-info add-more-card">
            Add More Card
        </button>
    </div>
</div>
<script>
    window.setupTinyMce()
    $(document).on('click','.add-more-card',function(event) {
        event.preventDefault();
        let _cloneContainer = $('.clone-container').clone();
        $(_cloneContainer).find('input, textarea').addClass('component_field');
        $('section').append(_cloneContainer);
        $(_cloneContainer).removeClass('clone-container').removeClass('d-none');
        $(_cloneContainer).find('textarea').addClass('tiny-mce');
        window.setupTinyMce();
    })
    $(document).on('click','.remove-card',function(event) {
        event.preventDefault() ;
        $(this).closest('div.row').remove();
    })
</script>
