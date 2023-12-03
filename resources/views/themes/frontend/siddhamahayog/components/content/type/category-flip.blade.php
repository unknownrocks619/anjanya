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
    $imageLink = '<img class="w-100" src="'.$featuredImage.'" alt="'.$record->title.'" style="max-height:245px;">';

?>
<!-- Start Single Card  -->
<div class="grid-metro-item cat--1 cat--3">
    <div class="edu-card card-type-3 radius-small">
        <div class="inner">
            <div class="thumbnail">
                {!! $user_theme->links('category-link',['slug' => $record->cat_slug,'label' => $imageLink]) !!}

                <div class="wishlist-top-right">
                    <button class="wishlist-btn"><i class="icon-Heart"></i></button>
                </div>
                <div class="top-position status-group left-bottom">
                    <span class="eduvibe-status status-03">
                        {!!  $user_theme->links('category-link',['slug' => $record->cat_slug,'label' => $record->cat_name]) !!}
                    </span>
                </div>
            </div>

            <div class="content">
                <h6 class="title">
                    {!! $user_theme->links('category-link-detail', ['slug' => $record->cat_slug,'post_slug' => $record->slug,'label' => $record->title])  !!}
                </h6>
            </div>
        </div>

        <div class="card-hover-action">
            <div class="hover-content">
                <div class="content-top">
                    <div class="top-status-bar">
                        <span class="eduvibe-status status-03">{{$record->cat_name}}</span>
                    </div>
                    <div class="top-wishlist-bar">
                        <button class="wishlist-btn"><i class="icon-Heart"></i></button>
                    </div>
                </div>
                <h6 class="title">
                    {!! $user_theme->links('category-link-detail',['slug' => $record->cat_slug,'post_slug' => $record->slug,'label' => $record->title]) !!}
                </h6>

                <div class="description">
                    {!! $record->intro_description !!}
                </div>

                <div class="read-more-btn">
                    {!! $user_theme->links('category-link',['class' => 'edu-btn btn-medium btn-white','slug' => $record->cat_slug,'label' => 'View Detail <i class="icon-arrow-right-line-right"></i>']) !!}
                </div>

            </div>
        </div>
    </div>
</div>
<!-- End Single Card  -->
