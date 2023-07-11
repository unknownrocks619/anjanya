@extends('themes.admin.master')

@push('page_title')
    - Book Bundle
@endpush

@section('main-content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>All Book Bundle</h3>
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
                        <a class="btn btn-primary" data-bs-target="#newBookBundle" data-bs-toggle='modal'
                            href="{{ route('admin.book.edit') }}">
                            Create New Bundle
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover display datatable-lister" id='user-list-table'>
                                <thead>
                                    <tr>
                                        <th>Bundle Name</th>
                                        <th>Products</th>
                                        <th>Categories</th>
                                        <th>Status</th>
                                        <td>

                                        </td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($bundles as $bundle)
                                        <tr>
                                            <td>
                                                {{ $bundle->bundle_title }}
                                            </td>
                                            <td>
                                                @foreach ($bundle->getBundleProducts() as $product)
                                                    {!! \App\Classes\Helpers\Status::label_text($product->product_name, 'warning px-3 py-2') !!}
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach ($bundle->getBundleCategories() as $category)
                                                    {!! \App\Classes\Helpers\Status::label_text($category->category_name, 'warning px-3 py-2') !!}
                                                @endforeach
                                            </td>
                                            <td>
                                                {!! \App\Classes\Helpers\Status::active_label($bundle->active) !!}
                                            </td>

                                            <td>
                                                <ul class="action">
                                                    <li class="edit"> <a
                                                            href="{{ route('admin.book.bundle.edit', ['bundle' => $bundle]) }}"><i
                                                                class="icon-pencil-alt"></i></a>
                                                    </li>

                                                    <li class="delete"><a href="#" class="data-confirm"
                                                            data-action="{{ route('admin.book.bundle.delete', ['bundle' => $bundle]) }}"
                                                            data-method="post"><i class="icon-trash"></i></a></li>
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
    <x-modal id="newBookBundle">
        @include('backend.book_bundle.modals.new')
    </x-modal>
@endsection
