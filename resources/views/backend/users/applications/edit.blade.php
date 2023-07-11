@extends('themes.admin.master')

@push('page_title')
    - {{ $user->getFullName() }}
@endpush

@section('main-content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>
                        Applicant - {{ $user->getFullName() }}
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
                            @if ($application->status != 'approved')
                                <div class="col-md-8">
                                    <a href="#" data-confirm="Confirm Application Approval ?"
                                        class="btn btn-success data-confirm" data-method="post"
                                        data-action="{{ route('admin.users.applications.approve', ['application' => $application, 'user' => $user]) }}">
                                        <i class="icon-check"></i>
                                        Approve Application
                                    </a>
                                    <a href="" class="btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#rejectApplication">
                                        <i class="icon-close"></i>
                                        Reject Application
                                    </a>

                                </div>
                            @endif
                            <div
                                class="@if ($application->status != 'approved') col-md-4 @else col-md-12 @endif d-flex justify-content-end">
                                <a href="{{ route('admin.users.applications.list') }}" class="btn btn-warning">
                                    Back
                                </a>

                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-pills nav-danger bg-light p-3" id="pills-danger-tab" role="tablist">
                            @foreach ($tabs as $key => $value)
                                @php
                                    $tabKeyname = isset($value['name']) ? strtolower($value['name']) : $key;
                                @endphp

                                <li class="nav-item mx-3">
                                    <a class="nav-link {{ $tabKeyname == $current_tab ? 'active' : '' }}"
                                        id="pills-danger-{{ $tabKeyname }}-tab" data-bs-toggle="pill"
                                        href="#pills-danger-{{ $tabKeyname }}" role="tab"
                                        aria-controls="pills-danger-home" aria-selected="true">
                                        @if (!isset($value['name']))
                                            {{ __('admin/users/edit.' . $tabKeyname) }}
                                        @else
                                            {{ $value['name'] }}
                                        @endif

                                    </a>
                                </li>
                            @endforeach
                        </ul>

                        <div class="tab-content" id="pills-danger-tabContent">
                            @foreach ($tabs as $key => $content)
                                @php
                                    $tabKeyname = isset($content['name']) ? strtolower($content['name']) : $key;
                                @endphp

                                <div class="mt-4 tab-pane fade {{ $tabKeyname == $current_tab ? 'active show' : '' }}"
                                    id="pills-danger-{{ $tabKeyname }}" role="tabpanel"
                                    aria-labelledby="pills-danger-{{ $tabKeyname }}-tab">

                                    @if (!isset($content['name']))
                                        @include('backend.users.applications.tabs.' . $key, [
                                            'content' => $content,
                                            'user' => $user,
                                        ])
                                    @else
                                        @include($content['view'], [
                                            'model' => $user,
                                            'seo' => $user->getSeo?->seo,
                                        ])
                                    @endif

                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <!-- Zero Configuration  Ends-->
        </div>
    </div>
    <x-modal id='rejectApplication'>
        @include('backend.users.applications.modals.reject', [
            'user' => $user,
            'application' => $application,
        ])
    </x-modal>
@endsection
