
@php
    // get product featured image.
    $featuredImage = null;

    $featuredImage = $product->getImage->where('type','featured_image')->first();

    if ( ! $featuredImage ) {
        $featuredImage = $product->getImage->where('type','product_cover_image')->first();
    }

    if ( ! $featuredImage ) {
        $featuredImage = $product->getImage->where('type','gallery')->first();
    }

    if ( $featuredImage  && $featuredImage instanceof App\Models\FileRelation ) {
        $featuredImage = \App\Classes\Helpers\Image::getImageAsSize($featuredImage->image->filepath,'m');
    }  else {
        $featuredImage = \App\Classes\Helpers\SystemSetting::logo();
    }
@endphp
<div class="blog-grid-inner">
    <div class="blog-header">
        <a class="thumbnail" href="{{route('product.detail',['slug' => $product->slug])}}">
            <img src="{{$featuredImage}}" alt="{{$product->name}}">
        </a>
    </div>
    <div class="blog-body">
        <a href="{{route('product.detail',['slug' => $product->slug])}}">
            <h5 class="title">
                {{$product->name}}
            </h5>
        </a>
        <p>
            {{$product->intro_description}}
        </p>
    </div>
</div>