{{-- @dd(\App\Classes\Components\ComponentService::allComponents(), get_defined_vars(), $theme_config['components']); --}}
@extends('themes.admin.master', ['closeMenu' => true, 'builder' => true])

@push('page_title')
    - Common Component Builder
@endpush

@section('main-content')
    <div class="container-fluid" id="commonComponentBuilder" data-model="">
        <div class="card" style="background: transparent !important">
            <div class="card-body" style="background:transparent !important">
                <div class="row">
                    <div class="col-3 bg-white px-0 componentLister border-end border-1">
                        <ul data-method="post" class="component-parent datatable-sortable-component"
                            style="min-height:100vh;max-height:100vh; overflow:scroll"
                            data-action="{{ route('admin.sort.re-order-column', ['model_name' => 'ComponentBuilder']) }}">
                            @foreach (\App\Classes\Components\ComponentService::allComponents() as $componenyKey => $componentValue)
                                <li class="mx-2 my-2 border-bottom border-2">
                                    <a href="#" class="text-center" onclick="CB.selectComponent(this)"
                                        class="common-component-selector select-component"
                                        data-url="{{ route('admin.components.common.create', ['component_name' => $componentValue, 'type' => 'page', 'param' => $webcomponent->getRelationModel()->slug]) }}"
                                        data-component-name="{{ $componentValue }}">

                                        @isset($theme_config['components'][$componentValue]['thumb'])
                                            <div style="position: relative">
                                                <img class="img-responsive img-thumbnail"
                                                    src="{{ asset('frontend/' . $user_theme->theme_name() . '/assets/components/' . $componentValue . '/' . $theme_config['components'][$componentValue]['thumb']) }}" />
                                                <span class="component-with-thumb animate"
                                                    style="position: absolute;top:30%;left:0px">{{ __('components.' . $componentValue) }}</span>
                                            </div>
                                        @else
                                            {{ __('components.' . $componentValue) }}
                                        @endisset

                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-3 bg-white px-0 component-edit-holder-wrapper d-none" style="position: relative">
                        <div class="row">
                            <div class="col-md-12">

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 component-edit-options"
                                style="min-height:100vh;max-height:100vh; overflow:scroll">

                            </div>
                            <div class="col-md-12 px-0" style="position: absolute;bottom:0px;">
                                <div class="row">
                                    <div class="col-md-12 text-end px-0">
                                        <button type="button" onclick="window.CB.removeComponent(this)"
                                            class="btn btn-icon btn-danger px-2 py-1 rounded-0 component-remove">
                                            <i class="fa fa-trash"></i>
                                        </button>

                                        <button type="button" onclick="window.CB.updateComponent(this)"
                                            class="btn btn-icon btn-primary px-2 py-1 rounded-0 component-save"><i
                                                class="fa fa-save"></i></button>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-9" style="min-height: 100vh;">
                        <input type="hidden" class="form-control component_field d-none" name="_source"
                            value="common-builder">
                        <input type="hidden" class="form-control component_field d-none" name="_source-option"
                            value="__update" />
                        <input type="hidden" class="form-control component_field d-none" name="_source-option-id"
                            value="{{ $webcomponent->getKey() }}" />

                        <div class="component-builder-loader" style="min-height: 100vh">
                            {!! $user_theme->components('slider.preview', [
                                'slug' => $webcomponent->getRelationModel()->slug,
                                'type' => 'page',
                            ]) !!}

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
