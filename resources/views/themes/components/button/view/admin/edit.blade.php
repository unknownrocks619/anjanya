@php
    $values = json_decode($component->values);
@endphp
<form action="{{ route('admin.components.update', ['componentBuilder' => $component]) }}" method="post"
    class="ajax-component-form">
    <input type="hidden" name="component" value="{{ $component->component_type }}">

    <div class="bg-light px-2 py-2">
        <div class="component-container">
            @foreach ($values as $button)
                <div class="row mt-2 clone_element">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="media" class="text-dark">
                                Button Label
                            </label>
                            <input type="text" name="label[]" id="" value="{{ $button->label }}"
                                class="form-control" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="media" class="text-dark">
                                Button Link
                            </label>
                            <input type="text" name="link[]" value="{{ $button->link }}" class='form-control'>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="text-dark">
                                Size
                            </label>
                            <select name="display_size[]" class="form-control no-select-2">
                                <option value="4" @if ($button->size == 4) selected @endif>4/12</option>
                                <option value="6" @if ($button->size == 6) selected @endif>6/12</option>
                                <option value="8" @if ($button->size == 8) selected @endif>8/12</option>
                                <option value="12" @if ($button->size == 12) selected @endif>12/12</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2 d-flex justify-content-center align-items-center">
                        @if ($loop->iteration == 1)
                            <a class="btn btn-info clone-component">
                                <i class="fa fa-copy"></i>
                            </a>
                        @endif
                        <a
                            class="btn btn-danger @if ($loop->iteration == 1) d-none @endif remove-clone-component">
                            <i class="fa fa-trash"></i>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col-md-12 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">
                    Update Component
                </button>
            </div>
        </div>
    </div>
</form>
