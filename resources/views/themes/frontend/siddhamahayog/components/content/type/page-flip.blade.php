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
<div class="grid-metro-item cat--1 cat--3">
    <div class="edu-card card-type-3 radius-small">
        <div class="inner">
            <div class="thumbnail">
                {!! $user_theme->links('page-link',['slug' => $record->slug,'label' => $imageLink]) !!}

                <div class="wishlist-top-right">
                    <button class="wishlist-btn"><i class="icon-Heart"></i></button>
                </div>
                <div class="top-position status-group left-bottom">
                    <span class="eduvibe-status status-03">{{$record->title}}</span>
                </div>
            </div>

            <div class="content">
                <h6 class="title">
                    {!! $user_theme->links('page-link', ['slug' => $record->slug,'label' => $record->title])  !!}
                </h6>
            </div>
        </div>

        <div class="card-hover-action">
            <div class="hover-content">
                <div class="content-top">
{{--                    <div class="top-status-bar">--}}
{{--                        <span class="eduvibe-status status-03">{{$record->cat_name}}</span>--}}
{{--                    </div>--}}
                    <div class="top-wishlist-bar">
                        <button class="wishlist-btn"><i class="icon-Heart"></i></button>
                    </div>
                </div>
                <h6 class="title">
                    {!! $user_theme->links('page-link',['slug' => $record->slug,'label' => $record->title]) !!}
                </h6>

                <div class="description">
                    {!! $record->intro_text !!}
                </div>

                <div class="read-more-btn">
                    {!! $user_theme->links('page-link',['class' => 'edu-btn btn-medium btn-white','slug' => $record->slug,'label' => 'Read More <i class="icon-arrow-right-line-right"></i>']) !!}
                </div>

            </div>
        </div>
    </div>
</div>
<!-- End Single Card  -->
