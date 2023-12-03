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
<!-- Start Service Card  -->
<div class="col-lg-3 col-md-6 col-sm-6 col-12" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
    <div class="service-card service-card-1 radius-small">
        <div class="inner">
            <div class="thumbnail">
                {!! $user_theme->links('category-link',['slug' => $record->cat_slug,'label' => $imageLink]) !!}
            </div>
            <div class="content">
                <h6 class="title">
                    {!! $user_theme->links('category-link',['slug' => $record->cat_slug,'label' => $record->title]) !!}
                </h6>
                <div class="description">
                    {!! $record->intro_description !!}
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Start Service Card  -->
