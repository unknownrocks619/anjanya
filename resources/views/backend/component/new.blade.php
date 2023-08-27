
@extends('themes.admin.master')

@push('page_title')
    - Common Component Builder
@endpush

@section('main-content')
    <div class="container-fluid">
        <div class="page-title">
        </div>
    </div>

    <div class="container-fluid" id="commonComponentBuilder" data-model="">
        <div class="row">
            <!-- Zero Configuration  Starts-->
            <div class="col-xl-3 box-col-30 pe-0">
                <div class="md-sidebar job-sidebar">
                    <a class="btn btn-primary md-sidebar-toggle" href="javascript:void(0)">Component Builder</a>
                    <div class="md-sidebar-aside custom-scrollbar">
                        <div class="file-sidebar">
                            <div class="card">
                                <div class="card-body" style="max-height:80vh; overflow:scroll">
                                    @include('backend.component.modal.lister')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- Zero Configuration  Ends-->
            <div class="col-xl-9 col-md-12 box-col-70">

                <div class="file-content">
                    <div class="card">
                            <div class="card-body loader-element d-none">
                                <div class="row">
                                    <div class="col-md-12 d-flex justify-content-center align-items-center">
                                        <img src="{{ asset('loading.gif') }}" class="img-fluid"/>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body component-builder-loader">
                                <div class="row h-75">
                                    <div class="col-md-12 d-flex justify-content-center h-75">
                                        <h4 class="text-grey h-75">
                                            Please Select Component from the list.
                                        </h4>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-md-12 text-end">
                                        <button type="button" data-bs-target="#newComponent" data-bs-toggle="modal" class="btn btn-primary">
                                            Save Component
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <x-modal id="newComponent">
                                <input type="hidden" class="form-control component_field d-none" name="_source" value="common-builder">
                                <input type="hidden" class="form-control component_field d-none" name="_source-option" value="__new" />
                                @include('backend.component.modal.component-name')
                            </x-modal>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
