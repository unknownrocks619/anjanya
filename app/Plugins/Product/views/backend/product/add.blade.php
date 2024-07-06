@extends('themes.admin.master')

@push('page_title')
    - Products - Add New Product
@endpush

@section('main-content')
    <div class="row">
        <div class="col-md-12">
            <div class="card action-bar align-content-end mt-3 rounded-3" style="background: #e0e0e0">
                <div class="card-body py-0 ps-2">
                    <a href="{{route('admin.products.index')}}" class="btn btn-danger">
                        <i class="fa fa-plus"></i>
                        Go Back
                    </a>
                </div>
            </div>
        </div>
    </div>
    <form action="{{route('admin.products.create')}}" method="post" class="ajax-form">
        <div class="row my-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-light">
                        <input type="text" name="name" id="name" placeholder="Product Name" class="form-control" style="font-size: 30px;min-height:80px" />
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="sku" class="form-group">Product SKU Code</label>
                                <input type="text" name="sku" id="sku" placeholder="SKU Code" class="form-control" />
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="0">Inactive</option>
                                        <option value="0">Active</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row my-2">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="stock">Available Stock</label>
                                    <input type="number" min="0" name="stock" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="product_type">Product Type</label>
                                    <select name="product_type" id="product_Type" class="form-control">
                                        @foreach (App\Plugins\Product\Http\Models\StoreProduct::PRODUCT_TYPE as $key => $value)
                                        <option value="{{$key}}">{{$value}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row my-2">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="intro_description">Intro Description</label>
                                    <textarea name="intro_description" id="intro_description" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row my-3">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="short_description">Short Description</label>
                                    <textarea name="short_description" id="short_description" class="form-control tiny-mce"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row my-3">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="full_description">Full Description</label>
                                    <textarea name="full_description" id="full_description" class="form-control tiny-mce"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row my-2">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="category">Select Categories</label>
                                    <select name="categories[]" multiple id="categories" class="form-control ajax-select-2"
                                        data-action="{{ route('admin.ajax-select2.categories',['source' => 'product']) }}">
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="base_price">Base Price</label>
                                    <input type="number" name="base_price" id="base_price" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="price_range">Price Range</label>
                                    <input type="text" name="price_range" id="price_range" class="form-control" />
                                </div>
                            </div>
                        </div>

                        <div class="row my-2">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="youtube_link">Youtube Link to Product</label>
                                    <input type="url" class="form-control" name="youtube_link">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="facebook_url">Facebook Link to Product</label>
                                    <input type="text" class="form-control" name="facebook_link">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="instagram_link">
                                        Instagram Link
                                    </label>
                                    <input type="text" class="form-control" name="instagram_link">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-md-12 text-end">
                                <button class="btn btn-primary">
                                    Save Product Detail
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
