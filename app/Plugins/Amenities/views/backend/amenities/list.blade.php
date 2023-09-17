@extends('themes.admin.master')

@push('page_title')
    - Amenities
@endpush

@section('main-content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>Amenities</h3>
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
                        <button class="btn btn-primary" data-bs-target='#new-post' data-bs-toggle='modal'>
                            New Amenities
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover display datatable-lister" id='user-list-table'>
                                <thead>
                                <tr>
                                    <th>Amenities Name</th>
                                    <th>Icon / Image</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($amenities as $amenity)
                                    <tr>
                                        <td>
                                            {{ $amenity->amenities }}
                                        </td>
                                        <td>
                                            @if($amenity->amenities_type == 'icon')
                                                <i class="{{$amenity->icon_name}}" />
                                            @else
                                                <img src="{{$amenity->image}}" style="max-width: 25px; max-height: 25px;" />
                                            @endif
                                        </td>
                                        <td>
                                            {!! \App\Classes\Helpers\Status::active_label($amenity->active) !!}
                                        </td>
                                        <td>
                                            <ul class="action">
                                                <li class="edit"> <a
                                                        href="{{ route('admin.amenities.edit', ['amenity' => $amenity]) }}"><i
                                                            class="icon-pencil-alt"></i></a>
                                                </li>
                                                <li class="delete">
                                                    <a href="#" class="data-confirm"
                                                       data-confirm="Are you Sure ? " data-method="post"
                                                       data-action="{{ route('admin.amenities.delete', ['amenity' =>$amenity]) }}">
                                                        <i class="icon-trash"></i>
                                                    </a>
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
    <x-modal id='new-post'>
        @include('Amenities::backend.amenities.modals.new')
    </x-modal>
@endsection
