@extends('themes.admin.master')

@push('page_title')
    - Product List
@endpush

@section('main-content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>All Product</h3>
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
                        <a class="btn btn-primary" href="{{ route('admin.book.edit') }}">
                            Add More Product
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover display datatable-lister" id='user-list-table'>
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th style="width:150px">Image</th>
                                        <th>Product Name</th>
                                        <th>Price</th>
                                        <th>Status</th>
                                        <th>Categories</th>
                                        <td>

                                        </td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                        <tr>
                                            <td>

                                            </td>
                                            <td>
                                                @if ($product->getImage || empty($product->getImage))
                                                    <img src="{{ asset('missing-image.png') }}" class="img-fluid w-25" />
                                                @else
                                                    @php
                                                        // get featured or cover image.
                                                        $image = $product
                                                            ->getImage()
                                                            ->where('type', 'product_cover_image')
                                                            ->first();
                                                        
                                                        if (!$image) {
                                                            $image = $product
                                                                ->getImage()
                                                                ->where('type', 'featured_image')
                                                                ->first();
                                                        }
                                                        
                                                        if (!$image) {
                                                            $image = $product
                                                                ->getImage()
                                                                ->latest()
                                                                ->first();
                                                        }
                                                        
                                                        $image = $image->image->filepath;
                                                    @endphp
                                                    <img src="{{ \App\Classes\Helpers\Image::getImageAsSize($image, 's') }}"
                                                        class="img-fluid w-25" />
                                                @endif
                                            </td>
                                            <td>
                                                {{ $product->product_name }}
                                            </td>
                                            <td>
                                                {{ \App\Classes\Helpers\Money::AU($product->item_price) }}
                                            </td>
                                            <td>
                                                {!! \App\Classes\Helpers\Status::status_label($product->status) !!}
                                            </td>
                                            <td>
                                                @foreach ($product->getCategories() as $category)
                                                    {!! \App\Classes\Helpers\Status::label_text($category->category_name) !!}
                                                @endforeach
                                            </td>
                                            <td>
                                                <ul class="action">
                                                    <li class="edit"> <a
                                                            href="{{ route('admin.ecom.edit', ['product' => $product]) }}"><i
                                                                class="icon-pencil-alt"></i></a>
                                                    </li>
                                                    <li class="delete"><a href="#" class="data-confirm"
                                                            data-action="{{ route('admin.ecom.delete_product', ['product' => $product]) }}"
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
@endsection
