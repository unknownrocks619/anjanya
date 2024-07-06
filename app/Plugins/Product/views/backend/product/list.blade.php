@extends('themes.admin.master')

@push('page_title')
    - Products
@endpush

@section('main-content')
    <div class="row">
        <div class="col-md-12">
            <div class="card action-bar align-content-end mt-3 rounded-3" style="background: #e0e0e0">
                <div class="card-body ">
                    <a href="{{route('admin.products.create')}}" class="btn btn-danger">
                        <i class="fa fa-plus"></i>
                        Add New Product
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-hover table-border">
                            <thead>
                                <tr>
                                    <th>Product Name</th>
                                    <th>
                                        Categories
                                    </th>
                                    <th>
                                        Status
                                    </th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{$product->name}}</td>
                                        <td>
                                            @forelse($product->productCategories as $category)
                                                {!! App\Classes\Helpers\Status::label_text($category->category_name) !!}
                                            @empty
                                                No Category 
                                            @endforelse
                                        </td>
                                        <td>
                                            {!! App\Classes\Helpers\Status::active_label($product->status) !!}
                                        </td>
                                        <td>
                                            <ul class="action">
                                                <li class="edit">
                                                    <a href="{{route('admin.products.edit',['product' => $product])}}">
                                                        <i class="icon-pencil-alt"></i>
                                                    </a>
                                                </li>
                                                <li class="delete">
                                                    <a href="#"
                                                       data-confirm="Are you sure?"
                                                       class="data-confirm"
                                                       data-method="post"
                                                       data-action="{{route('admin.products.delete',['product' => $product])}}">
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
    </div>
    
@endsection
