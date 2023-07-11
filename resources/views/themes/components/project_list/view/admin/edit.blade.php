<?php
$courses = \App\Models\Course::where('active', true)
    ->orderBy('sort_by', 'asc')
    ->get();
$values = json_decode($component->values);
$bundledBooks = \App\Models\BookBundle::where('active', true)->get();

?>
<form action="{{ route('admin.components.update', ['componentBuilder' => $component]) }}" method="post"
    class="ajax-component-form">
    <input type="hidden" name="component" value="{{ $component->component_type }}">
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="" class="text-dark">
                    Select Column
                </label>
                <select name="column" id="" class="form-control no-select-2">
                    <option value="12" @if ($values->column == '12') selected @endif>12/12</option>
                    <option value="6" @if ($values->column == '6') selected @endif>6/12</option>
                    <option value="3" @if ($values->column == '3') selected @endif>3/12</option>
                    <option value="4" @if ($values->column == '4') selected @endif>4/12</option>
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="" class="text-dark">
                    Display Option
                </label>
                <select name="layout_option" id="" class="form-control no-select-2">
                    <option @if (isset($values->display_layout) && $values->display_layout == 'default') selected @endif value="default">Default Card</option>
                    <option @if (isset($values->display_layout) && $values->display_layout == 'flip_card') selected @endif value="flip_card">Flip Card</option>
                    <option @if (isset($values->display_layout) && $values->display_layout == 'clean_card') selected @endif value="3">Clean Card</option>
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="" class="text-dark">
                    Select Type
                </label>
                <select name="type" id="" class="form-control no-select-2">
                    <option value="course" @if ($values->layout == 'course') selected @endif>Courses</option>
                    <option value="book" disabled @if ($values->layout == 'course') selected @endif>Books</option>
                    <option value="bundled_book" @if ($values->layout == 'bundled_book') selected @endif>Bundled Book</option>
                    <option value="project" @if ($values->layout == 'course') selected @endif>Projects
                    </option>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="title">Title Text</label>
                <input type="text" name="intro_title" class="form-control" value="{{ $values->intro_title }}">
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="title">Intro Description</label>
                <textarea name="intro_text" class="form-control">{{ $values->intro_text }}</textarea>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-control">
                <label for="">
                    Short Description
                </label>
                <textarea name="short_description" class="form-control tiny-mce">{{ $values->short_description }}</textarea>
            </div>
        </div>

    </div>
    <div class="row type_selector_div courses @if ($values->layout !== 'course') d-none @endif ">
        <div class="col-md-12">
            <div class="form-group">
                <label for="" class="text-dark">
                    Select Course
                </label>
                <select name="courses[]" multiple class="form-control">
                    @foreach ($courses as $course)
                        <option value="{{ $course->getKey() }}" @if (in_array($course->getKey(), $values->courses)) selected @endif>
                            {{ $course->course_name }} </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="row type_selector_div book @if ($values->layout !== 'book') d-none @endif">
        <div class="col-md-10">
            <div class="form-group">
                <label for="" class="text-dark">
                    Select Book
                </label>
                <select name="books_bundle[]" multiple class="form-control">
                    @foreach ($bundledBooks as $bundle_book)
                        <option @if (in_array($bundle_book->getKey(), $values->books_bundle)) selected @endif
                            value="{{ $bundle_book->getKey() }}">{{ $bundle_book->bundle_title }} </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-12">

        </div>
    </div>


    <div class="row bundled_book @if ($values->layout !== 'bundled_book') d-none @endif type_selector_div mt-5">
        <div class="col-md-10">
            <div class="form-group">
                <label for="" class="text-dark">
                    Select Bundle
                </label>
                <select name="books_bundle[]" multiple class="form-control">
                    @foreach ($bundledBooks as $bundle_book)
                        <option @if (in_array($bundle_book->getKey(), $values->books_bundle)) selected @endif
                            value="{{ $bundle_book->getKey() }}">{{ $bundle_book->bundle_title }} </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>


    <div class="row type_selector_div @if ($values->layout !== 'project') d-none @endif project">
        <div class="col-md-10">
            <div class="form-group">
                <label for="" class="text-dark">
                    Select Project
                </label>
                <select name="projects[]" multiple class="form-control">
                    <option value=""></option>
                </select>
            </div>
        </div>
        <div class="col-md-12">

        </div>
    </div>


    <div class="row">
        <div class="col-md-12 d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">
                Update Component
            </button>
        </div>
    </div>
</form>
