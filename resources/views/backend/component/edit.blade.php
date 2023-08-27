
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
        <div class="row mb-2">
            <!-- Zero Configuration  Starts-->
            <div class="col-xl-3 box-col-30 pe-0">
                <button class="btn btn-primary" data-bs-target="#componentList" data-bs-toggle="modal">
                    Add Component
                </button>
            </div>
        </div>
        <div class="row">
            <!-- Zero Configuration  Starts-->
            <div class="col-xl-3 box-col-30 pe-0">
                <div class="md-sidebar job-sidebar">
                    <a class="btn btn-primary md-sidebar-toggle" href="javascript:void(0)">Component Builder</a>
                    <div class="md-sidebar-aside custom-scrollbar">
                        <div class="file-sidebar">
                            <div class="card">
                                <div data-method="post" class="card-body datatable-sortable-component component-parent" style="min-height:80vh;max-height:80vh; overflow:scroll" data-action="{{ route('admin.sort.re-order-column', ['model_name' => 'ComponentBuilder']) }}">
                                    <ul>
                                        @foreach($webcomponent->getComponents as $component)
                                            <li data-sort-id="{{$component->getKey()}}" class="common-component-selector"  data-component-name="{{$component->component_type}}">
                                                <div class="d-flex justify-content-between btn btn-primary align-items-center">
                                                    <div class="">
                                                        <i class="fa fa-ellipsis-v fs-4 me-3 sortable-handle"
                                                           style="cursor:grab"></i>
                                                        <a href="#"  onclick="CB.selectComponent(this)" class="text-white" data-url="{{route('admin.components.common.edit',['webcomponent' => $webcomponent,'component_name' => $component->component_type,'componentID' => $component->getKey()])}}">
                                                            {{ $component->component_name }}</a>
                                                    </div>
                                                    <div class="text-end">
                                                        <a href="#" onclick="CB.removeComponent(this)" data-component-name="{{$component->component_type}}" data-component-id="{{$component->getKey()}}"><i class="fa fa-trash text-danger fs-5"></i></a>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
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
                                        <button type="button" class="btn btn-primary action-button" onclick="window.CB.updateComponent()" disabled>
                                            Update Component
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <x-modal id="newComponent">
                                <input type="hidden" class="form-control component_field d-none" name="_source" value="common-builder">
                                <input type="hidden" class="form-control component_field d-none" name="_source-option" value="__update" />
                                <input type="hidden" class="form-control component_field d-none" name="_source-option-id" value="{{$webcomponent->getKey()}}" />
                            </x-modal>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-modal id="componentList">
        @include('backend.component.modal.component-lister')
    </x-modal>
@endsection
