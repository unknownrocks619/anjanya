@extends('themes.admin.master')

@push('page_title')- {{ $member->name }} @endpush

@section('main-content')
    <div class="row">
        <div class="col-md-12">
            <div class="card action-bar align-content-end mt-3 rounded-3" style="background: #e0e0e0">
                <div class="card-body py-0 ps-2">
                    <a href="{{route('admin.teams.index')}}" class="btn btn-danger">
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
                                    $tabKeyname = !(is_array($value)) ?  $key : strtolower($value['name']);
                                @endphp

                                <li class="nav-item mx-3">
                                    <a class="nav-link {{ $tabKeyname == $current_tab ? 'active' : '' }}"
                                       id="pills-danger-{{ $tabKeyname }}-tab" data-bs-toggle="pill"
                                       href="#pills-danger-{{ $tabKeyname }}" role="tab"
                                       aria-controls="pills-danger-home" aria-selected="true">
                                        @if (!isset($value['name']))
                                            {{ __('admin/posts/edit.' . $tabKeyname) }}
                                        @else
                                            {{ is_array($value['name']) ? $value['name'] : ucwords($tabKeyname) }}
                                        @endif

                                    </a>
                                </li>
                            @endforeach
                        </ul>

                        <div class="tab-content" id="pills-danger-tabContent">
                            @foreach ($tabs as $key => $content)
                                @php
                                    $tabKeyname = !(is_array($content)) ?  $key : strtolower($content['name']);
                                @endphp

                                <div class="mt-4 tab-pane fade {{ $tabKeyname == $current_tab ? 'active show' : '' }}"
                                     id="pills-danger-{{ $tabKeyname }}" role="tabpanel"
                                     aria-labelledby="pills-danger-{{ $tabKeyname }}-tab">

                                    @if (! is_array($content))
                                        {{-- @dd('he'); --}}
                                        @include('TeamBuilder::backend.members.tabs.' . $key, [
                                            'content' => $content,
                                            'team' => $member,
                                        ])
                                    @else

                                        @include($content['view'], [
                                            'model' => $member,
                                            'seo' => $member->getSeo?->seo,
                                            'content' => $member->getImage,
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
