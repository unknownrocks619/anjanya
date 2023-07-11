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
                            Paragraph
                        </label>
                        <textarea name="paragraph" class="form-control tiny-mce">{{ $values->paragraph }}</textarea>
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
