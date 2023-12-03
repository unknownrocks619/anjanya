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
    <!-- Start Service Card  -->
<div class="col-lg-3 col-md-6 col-sm-6 col-12" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
    <div class="service-card service-card-1 radius-small">
        <div class="inner">
            <div class="thumbnail">
                {!! $user_theme->links('page-link',['slug' => $record->slug,'label' => $imageLink]) !!}
            </div>
            <div class="content">
                <h6 class="title">
                    {!! $user_theme->links('page-link',['slug' => $record->slug,'label' => $record->title]) !!}
                </h6>
                <div class="description">
                    {!! $record->intro_text !!}
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Start Service Card  -->
