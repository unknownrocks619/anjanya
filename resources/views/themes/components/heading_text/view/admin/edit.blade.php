<?php
$values = json_decode($component->values);
?>
<form action="{{ route('admin.components.update', ['componentBuilder' => $component]) }}" method="post"
    class="ajax-component-form">
    <input type="hidden" name="component" value="{{ $component->component_type }}">

    <div class="bg-light px-2 py-2">
        <div class="component-container">
            <div class="row mt-2 clone_element">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="media" class="text-dark">
                            Heading Title
                        </label>
                        <input type="text" name="heading" value="{{ $values->title }}" class="form-control" />
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="media" class="text-dark">
                            Heading Size
                        </label>
                        <select name="size" id="size" class="form-control">
                            <option value="h1" @if ($values->title_size == 'h1') selected @endif>Heading One
                            </option>
                            <option value="h2" @if ($values->title_size == 'h2') selected @endif>Heading Two
                            </option>
                            <option value="h3" @if ($values->title_size == 'h3') selected @endif>Heading Three
                            </option>
                            <option value="h4" @if ($values->title_size == 'h4') selected @endif>Heading Four
                            </option>
                            <option value="h5" @if ($values->title_size == 'h5') selected @endif>Heading Five
                            </option>
                        </select>
                    </div>
                </div>
            </div>
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
