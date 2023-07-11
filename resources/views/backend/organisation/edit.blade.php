@extends('themes.admin.master')

@push('page_title')
    - Organisation - {{ $org->organisation_name }}
@endpush


@section('main-content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>
                        {{ $org->organisation_name }}
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
                    <div class="card-header pb-0">
                        <button class="btn btn-primary" data-bs-target='#new-organisation' data-bs-toggle='modal'>
                            Back
                        </button>
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-pills nav-danger bg-light p-3" id="pills-danger-tab" role="tablist">
                            @foreach ($tabs as $key => $value)
                                <li class="nav-item mx-3">
                                    <a class="nav-link {{ $key == $current_tab ? 'active' : '' }}"
                                        id="pills-danger-{{ $key }}-tab" data-bs-toggle="pill"
                                        href="#pills-danger-{{ $key }}" role="tab"
                                        aria-controls="pills-danger-home" aria-selected="true">

                                        {{ __('admin/organisation/edit.' . $key) }}

                                    </a>
                                </li>
                            @endforeach
                        </ul>

                        <div class="tab-content" id="pills-danger-tabContent">
                            @foreach ($tabs as $key => $content)
                                <div class="mt-4 tab-pane fade {{ $key == $current_tab ? 'active show' : '' }}"
                                    id="pills-danger-{{ $key }}" role="tabpanel"
                                    aria-labelledby="pills-danger-{{ $key }}-tab">
                                    @include('backend.organisation.tabs.' . $key, [
                                        'content' => $content,
                                        'org' => $org,
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
