@if ($product->getImage()->count())
    @php
        // get featured or cover image.
        $image = $product
            ->getImage()
            ->where('type', 'cover_image')
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
    <img src="{{ \App\Classes\Helpers\Image::getImageAsSize($image, 'm') }}" alt="{{ $product->product_name }}">
@else
    <img src="{{ asset('missing-image.png') }}" alt="{{ $product->product_name }}">
@endif
