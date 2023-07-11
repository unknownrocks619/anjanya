<?php
$values = json_decode($component->values);
?>
<form action="{{ route('admin.components.update', ['componentBuilder' => $component]) }}" method="post" class="ajax-form">
    <input type="hidden" name="component" value="{{ $component->component_type }}">
    <div class="row bg-light p-2">
        <div class="col-md-12">

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="" class="text-dark">
                            Display title
                        </label>
                        <input type="text" name="display_title" value="{{ $values->display_title }}" id=""
                            class="form-control" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class='text-dark'>
                            Select Layout
                        </label>
                        <select name="layout" class="form-control no-select-2">
                            <option value="course_layout">Course Layout</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="" class="text-dark">Display Type</label>
                        <select name="display_type" id="display_type" class="form-control">
                            <option value="container">Compact</option>
                            <option value="container-fluid">Fluid</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label class='text-dark'>
                        Background
                    </label>
                    <input type="color" name="background_color" value='{{ $values->background_color }}' />
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12">
                        <label for="" class="text-dark">Enable Registration Button</label>
                        <input type="text" name="registration_button"class="form-control"
                            value="{{ strip_tags(htmlspecialchars_decode($values->registration_button)) }}">
                    </div>
                    <div class="col-md-12 mt-2">
                        <label for="" class="text-dark">
                            TagLine below button
                        </label>
                        <input type="text" class="form-control" name="registration_tagline"
                            value="{{ $values->registration_tagline }}" />
                    </div>
                </div>
            </div>
        </div>
        <div>
            @foreach ($values->faqs as $faq)
                <div class="row @if ($loop->iteration == 1) first_accordian @endif">
                    <div class="col-md-10">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="" class="text-dark">
                                        Question Text
                                    </label>
                                    <input type="text" name="question_text[]" value="{{ $faq->title }}"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="text-dark">Faq Description</label>
                                    <textarea name="faq_description[]" class="form-control tiny-mce">{{ $faq->description }}</textarea>
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


        <div class="row mt-2">
            <div class="row">
                <div class="col-md-12 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">
                        Update Component
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
