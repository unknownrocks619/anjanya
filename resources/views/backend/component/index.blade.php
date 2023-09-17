@extends('themes.admin.master')

@push('page_title')
    - Slider Album
@endpush

@section('main-content')
    <div class="container-fluid">
        <div class="page-title">
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <!-- Zero Configuration  Starts-->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <a class="btn btn-primary" href="{{route('admin.components.common.create')}}">
                            <i class="fa fa-plus"></i>
                            Build Component
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover display datatable-lister" id='common-component-list'>
                                <thead>
                                <tr>
                                    <th>Component Name</th>
                                    <th>Status</th>
                                    <th>
                                        Components
                                    </th>
                                    <td>

                                    </td>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($commonComponents as $component)
                                    <tr>
                                        <td>
                                            {{$component->component_name}}
                                        </td>
                                        <td>
                                            {!! \App\Classes\Helpers\Status::active_label($component->active) !!}
                                        </td>
                                        <td>
                                            @forelse($component->getComponents as $componentBuilder)
                                                {!!  \App\Classes\Helpers\Status::label_text(__('components.'.$componentBuilder->component_type),'success') !!}
                                                <span class="mx-1">&nbsp;</span>
                                            @empty
                                                {!!  \App\Classes\Helpers\Status::label_text('No Component Associated','danger') !!}
                                            @endforelse
                                        </td>
                                        <td>
                                            <ul class="action">
                                                <li class="edit">
                                                    <a href="{{route('admin.components.common.edit',['webcomponent' => $component])}}">
                                                        <i class="icon-pencil-alt"></i>
                                                    </a>
                                                </li>
                                                <li class="delete">
                                                    <a href="#" data-confirm="Are you sure?" class="data-confirm" data-method="post" data-action="{{route('admin.components.common.delete-common-component',['webComponent' => $component->getKey()])}}"><i class="icon-trash"></i></a>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>

                </div>
            </div>
            <!-- Zero Configuration  Ends-->
        </div>
    </div>
@endsection
