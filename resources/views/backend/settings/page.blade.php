@extends('themes.admin.master')

@push('page_title')
    - Page Settings
@endpush

@section('main-content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>Page Settings</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                @if (!$configs)
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="alert alert-danger">
                                        Configuration File Seems to be missing. Please hit Rebuild Configuration button.
                                    </div>
                                    <button class="btn btn-primary data-confirm"
                                        data-confirm="Do you really want to rebuild configuration file ?"
                                        data-action="{{ route('admin.settings.page-setting', ['configuration' => true]) }}"
                                        data-method="post">
                                        Rebuild Configuration
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="card">
                        <div class="card-body">
                            <ul class="nav nav-pills nav-danger bg-light p-3" id="pills-danger-tab" role="tablist">
                                <li class="nav-item mx-3">
                                    <a class="nav-link {{ 'general' == $current_tab ? 'active' : '' }}"
                                        id="pills-danger-general-tab" data-bs-toggle="pill" href="#pills-danger-general"
                                        role="tab" aria-controls="pills-danger-home" aria-selected="true">
                                        General
                                    </a>
                                </li>
                                @if ($home_page && $home_page->additional_text['sidebar'])
                                    {{-- <li class="nav-item mx-3">
                                        <a class="nav-link {{ 'home_page' == $current_tab ? 'active' : '' }}"
                                            id="pills-danger-home_page-tab" data-bs-toggle="pill"
                                            href="#pills-danger-home_page" role="tab" aria-controls="pills-danger-home"
                                            aria-selected="true">
                                            Home Page Component
                                        </a>
                                    </li> --}}
                                    <li class="nav-item mx-3">
                                        <a class="nav-link {{ 'home_page' == $current_tab ? 'active' : '' }}"
                                            id="pills-danger-home_page-tab" data-bs-toggle="pill"
                                            href="#pills-danger-home_page_management" role="tab"
                                            aria-controls="pills-danger-home" aria-selected="true">
                                            Home Widget
                                        </a>
                                    </li>
                                @endif
                                @if ($about_page && $about_page->additional_text['sidebar'])
                                    {{-- <li class="nav-item mx-3">
                                        <a class="nav-link {{ 'about_us' == $current_tab ? 'active' : '' }}"
                                            id="pills-danger-about_us-tab" data-bs-toggle="pill"
                                            href="#pills-danger-about_us" role="tab" aria-controls="pills-danger-home"
                                            aria-selected="true">
                                            About Us Component
                                        </a>
                                    </li> --}}
                                    <li class="nav-item mx-3">
                                        <a class="nav-link {{ 'about_us' == $current_tab ? 'active' : '' }}"
                                            id="pills-danger-about_us_management-tab" data-bs-toggle="pill"
                                            href="#pills-danger-about_us_management" role="tab"
                                            aria-controls="pills-danger-home" aria-selected="true">
                                            About Us Widget Management
                                        </a>
                                    </li>
                                @endif
                                @if ($category_page && $category_page->additional_text['sidebar'])
                                    {{-- <li class="nav-item mx-3">
                                        <a class="nav-link {{ 'category_page' == $current_tab ? 'active' : '' }}"
                                            id="pills-danger-category_page-tab" data-bs-toggle="pill"
                                            href="#pills-danger-category_page" role="tab"
                                            aria-controls="pills-danger-home" aria-selected="true">
                                            Category Page Component
                                        </a>
                                    </li> --}}
                                    <li class="nav-item mx-3">
                                        <a class="nav-link {{ 'category_page' == $current_tab ? 'active' : '' }}"
                                            id="pills-danger-category_page_management-tab" data-bs-toggle="pill"
                                            href="#pills-danger-category_page_management" role="tab"
                                            aria-controls="pills-danger-home" aria-selected="true">
                                            Category Page Widget Management
                                        </a>
                                    </li>
                                @endif
                            </ul>

                            <div class="tab-content" id="pills-danger-tabContent">
                                <div class="mt-4 tab-pane fade {{ 'general' == $current_tab ? 'active show' : '' }}"
                                    id="pills-danger-general" role="tabpanel"
                                    aria-labelledby="pills-danger-{{ 'general' }}-tab">
                                    @include('backend.settings.tabs.' . 'general', [
                                        'configs' => $configs,
                                    ])
                                </div>
                                @if ($home_page && $home_page->additional_text['sidebar'])
                                    {{-- <div class="mt-4 tab-pane fade {{ 'home_page' == $current_tab ? 'active show' : '' }}"
                                        id="pills-danger-{{ 'home_page' }}" role="tabpanel"
                                        aria-labelledby="pills-danger-{{ 'home_page' }}-tab">
                                        @include('themes.components.choices', [
                                            'content' => $home_page,
                                            'model' => $home_page,
                                        ])
                                    </div> --}}
                                    <div class="mt-4 tab-pane fade {{ 'home_page' == $current_tab ? 'active show' : '' }}"
                                        id="pills-danger-{{ 'home_page_management' }}" role="tabpanel"
                                        aria-labelledby="pills-danger-{{ 'home_page_management' }}-tab">
                                        @include('backend.settings.tabs.home', [
                                            'content' => $home_page,
                                            'model' => $home_page,
                                        ])
                                    </div>
                                @endif
                                @if ($about_page && $about_page->additional_text['sidebar'])
                                    {{-- <div class="mt-4 tab-pane fade {{ 'about_us' == $current_tab ? 'active show' : '' }}"
                                        id="pills-danger-{{ 'about_us' }}" role="tabpanel"
                                        aria-labelledby="pills-danger-{{ 'about_us' }}-tab">
                                        @include('themes.components.choices', [
                                            'content' => $about_page,
                                            'model' => $about_page,
                                        ])
                                    </div> --}}
                                    <div class="mt-4 tab-pane fade {{ 'home_page' == $current_tab ? 'active show' : '' }}"
                                        id="pills-danger-{{ 'about_us_management' }}" role="tabpanel"
                                        aria-labelledby="pills-danger-{{ 'about_us_management' }}-tab">
                                        @include('backend.settings.tabs.about', [
                                            'about_page' => $about_page,
                                            'model' => $about_page,
                                        ])
                                    </div>
                                @endif
                                @if ($category_page && $category_page->additional_text['sidebar'])
                                    {{-- <div class="mt-4 tab-pane fade {{ 'category_page' == $current_tab ? 'active show' : '' }}"
                                        id="pills-danger-{{ 'category_page' }}" role="tabpanel"
                                        aria-labelledby="pills-danger-{{ 'category_page' }}-tab">
                                        @include('themes.components.choices', [
                                            'content' => $category_page,
                                            'model' => $category_page,
                                        ])
                                    </div> --}}
                                    <div class="mt-4 tab-pane fade {{ 'home_page' == $current_tab ? 'active show' : '' }}"
                                        id="pills-danger-{{ 'category_page_management' }}" role="tabpanel"
                                        aria-labelledby="pills-danger-{{ 'category_page_management' }}-tab">
                                        @include('backend.settings.tabs.category', [
                                            'category_page' => $category_page,
                                            'model' => $about_page,
                                        ])
                                    </div>
                                @endif
                            </div>
                        </div>

                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
