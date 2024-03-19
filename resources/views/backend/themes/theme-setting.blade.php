@extends('themes.admin.master')

@push('page_title')
    - Theme Setting
@endpush

@section('main-content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>
                        Theme Configuration
                    </h3>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <!-- Zero Configuration  Starts-->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">

                        <ul class="nav nav-pills nav-danger bg-light p-3" id="pills-danger-tab" role="tablist">
                            @foreach ($tabs as $key => $value)
                                <li class="nav-item mx-3">
                                    <a class="nav-link {{ $value == $current_tab ? 'active' : '' }}"
                                       id="pills-danger-{{ $value }}-tab" data-bs-toggle="pill"
                                       href="#pills-danger-{{ $value }}" role="tab"
                                       aria-controls="pills-danger-home" aria-selected="true">
                                            {{ __('admin/settings/themes.' . $value) }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>

                        <div class="tab-content" id="pills-danger-tabContent">
                            @foreach ($tabs as $key => $content)
                                <div class="mt-4 tab-pane fade {{ $content == $current_tab ? 'active show' : '' }}"
                                     id="pills-danger-{{ $content }}" role="tabpanel"
                                     aria-labelledby="pills-danger-{{ $content }}-tab">
                                        @include('backend.themes.settings.tabs.' . $content, [
                                            'content' => $content,
                                            'setting' => $setting
                                        ])
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <!-- Zero Configuration  Ends-->
        </div>
    </div>
@endsection
