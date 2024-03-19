<?php
/** @var  \App\Models\Page $record */

$image = $record->getImage()->where('type','intro_image')->first();

if ( ! $image) {
    $image = $record->getImage()->where('type','featured_image')->first();
}

if (  $image ) {
    $image = \App\Classes\Helpers\Image::getImageAsSize($image->image->filepath,'m');
} else {
    $image = \App\Classes\Helpers\SystemSetting::logo();
}

$imageLink = '<img class="w-100" src="'.$image.'" alt="'.$record->title.'">';
?>
<!-- Start Single Card  -->
<div class="col-12 col-sm-12 col-xl-4 col-md-6" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
    <div class="edu-card card-type-2 radius-small">
        <div class="inner">
            <div class="thumbnail">
                {!! $user_theme->links('page-link',['slug' => $record->slug,'label' => $imageLink]) !!}
                <div class="wishlist-top-right">
                    <button class="wishlist-btn"><i class="icon-Heart"></i></button>
                </div>
            </div>
            <div class="content">
                <h6 class="title">
                    {!! $user_theme->links('page-link',['slug' => $record->slug,'label' => $record->title]) !!}
                </h6>
                <div class="description">
                    {!! $record->intro_description !!}
                </div>
                <div class="card-bottom">
                    <div class="price-list price-style-01">
                        {!! $user_theme->links('page-link',['slug' => $record->slug,'label' => 'Read More','class' => 'edu-btn']) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Single Card  -->
