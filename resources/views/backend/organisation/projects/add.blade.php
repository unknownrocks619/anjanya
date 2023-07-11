@extends('themes.admin.master')

@push('page_title')
    {{ $org ? ' -' . $org->organisation_name : '' }} - Add New Project
@endpush


@section('main-content')
    <?php
    $goBack = route('admin.org.projects.list');

    if ($org) {
        $goBack = route('admin.org.edit', ['org' => $org->getKey(), 'current_tab' => 'projects']);
    }

    $saveProject = $org ? route('admin.org.projects.add', ['org' => $org->getKey()]) : route('admin.org.projects.add');
    ?>
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>
                        {{ $org?->organisation_name }} - Add New Project
                    </h3>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <form action="{{ $saveProject }}" class="ajax-form" method="post">
            <div class="row">
                <!-- Zero Configuration  Starts-->
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header pb-0 d-flex justify-content-end">

                            <a class="btn btn-warning" href='{{ $goBack }}'>
                                Go Back
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="row g-2">
                                <div class="mb-3 col-md-12 mt-0">
                                    <div class="form-group">
                                        <label for="project_title">Project Title</label>
                                        <input class="form-control" id="project_title" name="project_title" type="text"
                                            required="" placeholder="Project Title" autocomplete="off" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="row g-2">
                                <div class="mb-3 col-md-12 mt-0">
                                    <div class="form-group">
                                        <label for="project_title">Intro Text</label>
                                        <textarea name="intro_text" id="" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-2">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="short_description">
                                            Short Description
                                        </label>
                                        <textarea name="short_description" id="short_description" class="form-control tiny-mce"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-2">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="full_description">
                                            Full Description
                                        </label>
                                        <textarea name="full_description" id="full_description" class="form-control tiny-mce"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-2">
                                <div class="mb-3 col-md-4 mt-2">
                                    <div class="form-group">
                                        <label for="con-mail">Country</label>
                                        <input type="text" name="country" id="country" class="form-control"
                                            placeholder="Country">
                                    </div>
                                </div>
                                <div class="mb-3 col-md-4 mt-2">
                                    <div class="form-group">
                                        <label for="project_type">Project Type</label>
                                        <select name="project_type" id="project_type" class="form-control">
                                            @foreach (\App\Models\Project::PROJECT_TYPES as $project_key => $project_value)
                                                <option value="{{ $project_key }}">
                                                    {{ $project_value }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 col-md-4 mt-4 d-flex align-items-center">
                                    <div class="form-group d-flex align-items-center mt-1">
                                        <div class="m-t-15 m-checkbox-inline">
                                            <div class="form-check form-check-inline checkbox checkbox-dark mb-0">
                                                <input class="form-check-input" name="donation" id="active"
                                                    type="checkbox" data-bs-original-title="" title="Donation">
                                                <label class="form-check-label" for="active">
                                                    Donation
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-2">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="Organisation">Select Organisation </label>
                                        @if(! isset($org))
                                        <select name="project_organisation" id="organisation" class="form-control">
                                            <option value="">Please select Organisation</option>
                                            @foreach (\App\Models\Organisation::get() as $project_org)
                                                <option value="{{$project_org->getKey()}}">
                                                    {{ $project_org->organisation_name}}
                                                </option>
                                            @endforeach
                                        </select>
                                        @elseif(isset($org) && $org)
                                        <div class="form-control readonly disabled">
                                            {{ $org->organisation_name}}
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row g-2">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="category">Category</label>
                                        <input type="text" name="category[]" id="category" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Genre">Genre</label>
                                        <input type="text" name="genre[]" id="genre" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Zero Configuration  Ends-->
            </div>
            <div class="row my-2">
                <div class="col-md-12 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">
                        Save Project Detail
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
