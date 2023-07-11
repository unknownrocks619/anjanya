<?php
$courses = \App\Models\Course::where('active', true)
    ->orderBy('sort_by', 'asc')
    ->get();
$bundledBooks = \App\Models\BookBundle::where('active', true)->get();
$projects = \App\Models\Project::where('active', true)->get();
?>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="" class="text-dark">
                Select Column
            </label>
            <select name="column" id="" class="form-control no-select-2">
                <option value="12">12/12</option>
                <option value="6">6/12</option>
                <option value="3">3/12</option>
                <option value="4">4/12</option>
            </select>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="" class="text-dark">
                Display Option
            </label>
            <select name="layout_option" id="" class="form-control no-select-2">
                <option value="default">Default Card</option>
                <option value="flip_card">Flip Card</option>
                <option value="clean_card">Clean Card</option>
            </select>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="" class="text-dark">
                Select Type
            </label>
            <select name="type" class="form-control no-select-2 project-list-type-selector">
                <option value="course">Courses</option>
                <option value="book" disabled>Books</option>
                <option value="bundled_book">Bundled Book</option>
                <option value="project">Projects</option>
            </select>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="title">Title Text</label>
            <input type="text" name="intro_title" class="form-control">
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label for="title">Intro Description</label>
            <textarea name="intro_text" class="form-control"></textarea>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-control">
            <label for="">
                Short Description
            </label>
            <textarea name="short_description" class="form-control tiny-mce"></textarea>
        </div>
    </div>

</div>
<div class="row courses type_selector_div">
    <div class="col-md-12">
        <div class="form-group">
            <label for="" class="text-dark">
                Select Course
            </label>
            <select name="courses[]" multiple class="form-control">
                @foreach ($courses as $course)
                    <option value="{{ $course->getKey() }}">{{ $course->course_name }} </option>
                @endforeach
            </select>
        </div>
    </div>
</div>

<div class="row book d-none type_selector_div">
    <div class="col-md-10">
        <div class="form-group">
            <label for="" class="text-dark">
                Select Book
            </label>
            <select name="books[]" multiple class="form-control">
                @foreach ($courses as $course)
                    <option value="{{ $course->getKey() }}">{{ $course->course_name }} </option>
                @endforeach
            </select>
        </div>
    </div>
</div>
<div class="row bundled_book d-none type_selector_div mt-5">
    <div class="col-md-10">
        <div class="form-group">
            <label for="" class="text-dark">
                Select Bundle
            </label>
            <select name="books_bundle[]" multiple class="form-control">
                @foreach ($bundledBooks as $bundle_book)
                    <option value="{{ $bundle_book->getKey() }}">{{ $bundle_book->bundle_title }} </option>
                @endforeach
            </select>
        </div>
    </div>
</div>

<div class="row project d-none type_selector_div">
    <div class="col-md-10">
        <div class="form-group">
            <label for="" class="text-dark">
                Select Project
            </label>
            <select name="projects[]" multiple class="form-control">
                @foreach ($projects as $project)
                    <option value="{{ $project->getKey() }}">{{ $project->title }} </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-12">

    </div>
</div>


<div class="row">
    <div class="col-md-12 d-flex justify-content-end">
        <button type="submit" class="btn btn-primary">
            Save Component
        </button>
    </div>
</div>
