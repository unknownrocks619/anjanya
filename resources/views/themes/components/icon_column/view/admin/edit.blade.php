<?php
$values = json_decode($component->values);
?>
<form action="{{ route('admin.components.update', ['componentBuilder' => $component]) }}" method="post"
    class="ajax-component-form">
    <input type="hidden" name="component" value="{{ $component->component_type }}">
    <div class="bg-light px-2 py-2">
        <div class="component-container">
            <div class="row mt-2">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="media" class="text-dark">
                            Layout
                        </label>
                        <select name="layout" class="form-control no-select-2">
                            <option value="home_theme" @if ($values->layout == 'home_theme') selected @endif>Home Theme
                            </option>
                            <option value="course_theme" @if ($values->layout == 'course_theme') selected @endif>Course Theme
                            </option>
                        </select>
                    </div>
                </div>
            </div>
            <div>
                @foreach ($values->contents as $column_content)
                    <div class="row @if ($loop->iteration == 1) first_accordian @endif">
                        <div class="col-md-11">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="text-dark">Column Title</label>
                                        <input type="text" name="column_title[]" value="{{ $column_content->title }}"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="text-dark">Icon Name</label>
                                        <input type="text" name="icon[]" value="{{ $column_content->icon }}"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="text-dark">Icon Background</label>
                                        <input type="text" name="color[]" value="{{ $column_content->background }}"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="column_description" class="text-dark">Content</label>
                                        <textarea name="content[]" class="form-control tiny-mce">{{ $column_content->content }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-1 d-flex justify-content-center align-items-center">
                            @if ($loop->iteration == 1)
                                <a class="btn btn-info clone_accordian_component">
                                    <i class="fa fa-copy"></i>
                                </a>
                            @endif
                            <a
                                class="btn btn-danger @if ($loop->iteration == 1) d-none @endif remove_accordian_component">
                                <i class="fa fa-trash"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
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
