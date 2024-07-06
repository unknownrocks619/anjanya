@php
  // get all products from this 
  $similarCategory = App\Plugins\Product\Http\Models\ProductCategory::where('id_pro',$product->getKey())->pluck('id_cat');
  $similarProductsID = App\Plugins\Product\Http\Models\ProductCategory::whereIn('id_cat',$similarCategory->toArray())
                                                                    // ->where('id_pro','!=',$product->getKey())
                                                                    ->pluck('id_pro');
  $similarProducts =  App\Plugins\Product\Http\Models\StoreProduct::whereIn('id',$similarProductsID->toArray())->where('status',true)->get();
  
@endphp
<div class="card">
  <div class="card-body">
    <h5 class="card-title">Similar items</h5>
    @foreach ($similarProducts as $similarProduct)
      @php

          $featuredImage = $similarProduct->getImage->where('type','featured_image')->first();

          if ( ! $featuredImage ) {
              $featuredImage = $similarProduct->getImage->where('type','product_cover_image')->first();
          }

          if ( ! $featuredImage ) {
              $featuredImage = $similarProduct->getImage->where('type','gallery')->first();
          }

          if ( $featuredImage  && $featuredImage instanceof App\Models\FileRelation ) {
              $featuredImage = \App\Classes\Helpers\Image::getImageAsSize($featuredImage->image->filepath,'m');
          }  else {
              $featuredImage = \App\Classes\Helpers\SystemSetting::logo();
          }
      @endphp
      <div class="d-flex mb-3">
        <a href="{{route('product.detail',['slug' => $product->slug])}}" class="me-3">
          <img src="{{$featuredImage}}" style="min-width: 96px; height: 96px;" class="img-md img-thumbnail" />
        </a>
        <div class="info">
          <a href="{{route('product.detail',['slug' => $product->slug])}}" class="nav-link mb-1 fs-2">
            {{$product->name}}
          </a>
          <strong class="text-dark">
            NRs. 
            @if($product->price_range)
              {{$product->price_range}}
            @else
              {{$product->base_price}}
            @endif
          </strong>
        </div>
      </div>
    @endforeach

  </div>
</div>
