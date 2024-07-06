<form action="{{route('admin.products.edit',['product' => $product])}}" method="post" class="ajax-form">
    <div class="row my-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-light">
                    <input type="text" value="{{$product->name}}" name="name" id="name" placeholder="Product Name" class="form-control" style="font-size: 30px;min-height:80px" />
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="sku" class="form-group">Product SKU Code</label>
                            <input type="text" name="sku" value="{{$product->sku}}" id="sku" placeholder="SKU Code" class="form-control" />
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="0" @if(! $product->status) selected @endif>Inactive</option>
                                    <option value="1" @if($product->status) selected @endif >Active</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row my-2">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="stock">Available Stock</label>
                                <input type="number" value="{{$product->stock}}" min="0" name="stock" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="product_type">Product Type</label>
                                <select name="product_type" id="product_Type" class="form-control">
                                    @foreach (App\Plugins\Product\Http\Models\StoreProduct::PRODUCT_TYPE as $key => $value)
                                    <option @if($key == $product->product_type) selected @endif value="{{$key}}">{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row my-2">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="intro_description">Intro Description</label>
                                <textarea name="intro_description" id="intro_description" class="form-control">{{$product->intro_description}}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row my-3">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="short_description">Short Description</label>
                                <textarea name="short_description" id="short_description" class="form-control tiny-mce">{!! $product->short_description !!}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row my-3">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="full_description">Full Description</label>
                                <textarea name="full_description" id="full_description" class="form-control tiny-mce">{!! $product->full_description !!}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row my-2">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="category">Select Categories</label>
                                <select name="categories[]" multiple id="categories" class="form-control ajax-select-2"
                                    data-action="{{ route('admin.ajax-select2.categories',['source' => 'product']) }}">
                                    @foreach ($product->productCategories as $category)
                                        <option value="{{$category->getKey()}}" selected>{{$category->category_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="base_price">Base Price</label>
                                <input type="number" name="base_price" value="{{$product->base_price}}" id="base_price" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="price_range">Price Range</label>
                                <input type="text" name="price_range" id="price_range" value="{{$product->price_range}}" class="form-control" />
                            </div>
                        </div>
                    </div>

                    <div class="row my-2">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="youtube_link">Youtube Link to Product</label>
                                <input type="url" class="form-control" value="{{$product->youtube_link}}" name="youtube_link">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="facebook_url">Facebook Link to Product</label>
                                <input type="text" class="form-control" value="{{$product->facebook_link}}" name="facebook_link">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="instagram_link">
                                    Instagram Link
                                </label>
                                <input type="text" class="form-control" value="{{$product->instagram_link}}" name="instagram_link">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-12 text-end">
                            <button class="btn btn-primary">
                                Update Product Detail
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
