@extends('themes.admin.master')

@push('page_title')
    - {{ $mode->mode_name }}
@endpush

@section('main-content')
    <div class="row">
        <div class="col-md-12">
            <div class="card action-bar align-content-end mt-3 rounded-3" style="background: #e0e0e0">
                <div class="card-body py-0 ps-2">
                    <a href="{{route('admin.maintenance.list')}}" class="btn btn-danger">
                        <i class="fa fa-arrow-left"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <!-- Zero Configuration  Starts-->
            <div class="col-sm-12">
                <div class="card rounded-3">
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
                                            {{ __('admin/posts/edit.' . $tabKeyname) }}
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
                                        @include('Maintanance::backend.maintenance-mode.tabs.' . $key, [
                                            'content' => $content,
                                            'mode' => $mode,
                                        ])
                                    @else
                                        @include($content['view'], [
                                            'model' => $mode,
                                            'seo' => $mode->getSeo?->seo,
                                            'content' => $mode->getImage,
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
@endsection
