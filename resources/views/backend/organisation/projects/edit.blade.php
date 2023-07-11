@extends('themes.admin.master')

@push('page_title')
    {{ $org?->organisation_name }} - {{ $project->title }}
@endpush


@section('main-content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>
                        {{ $org ? $org->organisation_name . '-' : '' }} {{ $project->title }}
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
                        <div class="row">
                            <div class="col-md-10">
                                @if ($project->donation && $project->max_donation_amount)
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="progress" style="height: 20px;">
                                                <div class="progress-bar bg-info" role="progressbar"
                                                    style="width:{{ $project->getDonationPercentage() }}%" aria-valuenow="0"
                                                    aria-valuemin="0" aria-valuemax="{{ $project->max_donation_amount }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 d-flex justify-content-between fs-4">
                                            <span class="text-info">
                                                Donation Collection:
                                                {{ \App\Classes\Helpers\Money::AU($project->getProjectTransaction()->sum('transaction_amount')) }}
                                            </span>
                                            <span class="text-info">
                                                Target Amount:
                                                {{ \App\Classes\Helpers\Money::AU($project->max_donation_amount) }}
                                            </span>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-2 d-flex justify-content-end">
                                <?php
                                $goBack = route('admin.org.projects.list', ['current_tab' => 'general']);
                                if ($org) {
                                    $goBack = route('admin.org.edit', ['org' => $org->getKey(), 'current_tab' => 'projects']);
                                }
                                ?>
                                <a href="{{ $goBack }}" class="btn btn-warning">
                                    Back
                                </a>

                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-pills nav-danger bg-light p-3" id="pills-danger-tab" role="tablist">
                            @foreach ($tabs as $key => $value)
                                <li class="nav-item mx-3">
                                    <a class="nav-link {{ $key == $current_tab ? 'active' : '' }}"
                                        id="pills-danger-{{ $key }}-tab" data-bs-toggle="pill"
                                        href="#pills-danger-{{ $key }}" role="tab"
                                        aria-controls="pills-danger-home" aria-selected="true">

                                        {{ __('admin/project/edit.' . $key) }}

                                    </a>
                                </li>
                            @endforeach
                        </ul>

                        <div class="tab-content" id="pills-danger-tabContent">
                            @foreach ($tabs as $key => $content)
                                <div class="mt-4 tab-pane fade {{ $key == $current_tab ? 'active show' : '' }}"
                                    id="pills-danger-{{ $key }}" role="tabpanel"
                                    aria-labelledby="pills-danger-{{ $key }}-tab">
                                    @include('backend.organisation.projects.tabs.' . $key, [
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
