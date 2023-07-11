<?php
$values = json_decode($component->values);
?>
<form action="{{ route('admin.components.update', ['componentBuilder' => $component]) }}" method="post"
    class="ajax-component-form">
    <input type="hidden" name="component" value="{{ $component->component_type }}">
    <div class="row">
        <div class="col-md-12 text-dark">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Video Position</label>
                        <select name="video_position" class="form-control">
                            <option value="left" @if ($values->video_position == 'left') selected @endif>Left</option>
                            <option value="right" @if ($values->video_position == 'right') selected @endif>Right</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for=""> Video Source</label>
                        <select name="video_type" class="form-control component_video_checklist_source">
                            <option value="vimeo" @if ($values->video_type == 'vimeo') selected @endif>Vimeo</option>
                            <option value="youtube" @if ($values->video_type == 'youtube') selected @endif>Youtube</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 component_video_checklist_source_vimeo">
                    <div class="form-group">
                        <label for="">
                            Video Source
                        </label>
                        <input type="url" name="video_url" value="{{ $values->video->link }}"
                            class="form-control component_video_checklist_source_vimeo">
                    </div>
                </div>
            </div>


        </div>

        <div class="col-md-12 text-dark">
            @foreach ($values->items as $checklistItem)
                <div class="row @if ($loop->iteration == 1) clone_element @endif">
                    <div class="col-md-11">
                        <div class="form-group">
                            <label for="">
                                Checklist Item
                            </label>
                            <input type="text" name="checklist[]" value="{{ $checklistItem->items }}"
                                class="form-control">
                        </div>
                    </div>
                    <div class="col-md-1">
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
