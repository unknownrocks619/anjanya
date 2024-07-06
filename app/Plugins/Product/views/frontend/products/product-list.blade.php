<div class="row">
    @foreach ($products as $product)
        @php
            if ($product instanceof App\Plugins\Product\Http\Models\ProductCategory) {
                $product  = $product->product;
            }
            if ( ! $product ) continue;
            
        @endphp
        <div class="col-lg-4 col-md-12 col-sm-12">
            @include('Product::frontend.products.partials.lister-item',['product' => $product])
        </div>
    @endforeach
</div>