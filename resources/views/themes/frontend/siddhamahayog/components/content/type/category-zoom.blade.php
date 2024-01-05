<?php
/** @var  \App\Models\Category $record */
$featuredImage = $record->post_featured_image;

if ( ! $record->post_featured_image) {
    $featuredImage = ( ! $record->post_intro_image)  ? $record->category_featured_image : $record->post_intro_image;
}

if ( ! $featuredImage ) {
    $featuredImage = \App\Classes\Helpers\SystemSetting::logo();
} else {
    $featuredImage = \App\Classes\Helpers\Image::getImageAsSize($featuredImage,'m');
}

$imageLink = '<img src="'.$featuredImage.'" alt="'.$record->title.'">';
?>
<!-- Start Single Card  -->
<div class="col-12 col-sm-12 col-xl-4 col-md-6" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
    <div class="edu-card card-type-2 radius-small">
        <div class="inner">
            <div class="thumbnail">
                {!! $user_theme->links('category-link',['slug' => $record->cat_slug,'label' => $imageLink]) !!}
                <div class="wishlist-top-right">
                    <button class="wishlist-btn"><i class="icon-Heart"></i></button>
                </div>
            </div>
            <div class="content">
                <h6 class="title">
                    {!! $user_theme->links('category-link',['slug' => $record->cat_slug,'label' => $record->title]) !!}
                </h6>
                <div class="description">
                    {!! $record->intro_description !!}
                </div>
                <div class="card-bottom">
                    <div class="price-list price-style-01">
                            {!! $user_theme->links('category-link-detail',['slug' => $record->cat_slug,'label' => 'Read More','class' => 'edu-btn']) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Single Card  -->
