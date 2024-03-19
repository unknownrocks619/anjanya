@php
    /** @var  \App\Models\Post $record */
    $category = 'uncategorized';
    $categoryName = 'Uncategorized';
    $categories = $record->getCategories();

    if ($categories->count() ) {
        $category = ($categories->first())?->slug;
        $categoryName = ($categories->first())?->category_name;
    }

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
@endphp

<!-- Start Single Card  -->
<div class="grid-metro-item cat--1 cat--3">
    <div class="edu-card card-type-3 radius-small">
        <div class="inner">
            <div class="thumbnail">
                {!! $user_theme->links('category-link-detail',['slug' => $category,'post_slug' => $record->slug,'label' => $imageLink]) !!}

                <div class="wishlist-top-right">
                    <button class="wishlist-btn"><i class="icon-Heart"></i></button>
                </div>
                <div class="top-position status-group left-bottom">
                    <span class="eduvibe-status status-03">{{$categoryName}}</span>
                </div>
            </div>

            <div class="content">
                <h6 class="title">
                    {!! $user_theme->links('category-link-detail', ['slug' => $category,'post_slug' => $record->slug,'label' => $record->title])  !!}
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
                    {!! $user_theme->links('category-link-detail',['slug' => $category,'post_slug' =>$record->slug,'label' => $record->title]) !!}
                </h6>

                <div class="description">
                    {!! $record->intro_description !!}
                </div>

                <div class="read-more-btn">
                    {!! $user_theme->links('category-link-detail',
                                        ['class' => 'edu-btn btn-medium btn-white',
                                        'slug' => $category,
                                        'post_slug' => $record->slug,
                                        'label' => 'View Detail <i class="icon-arrow-right-line-right"></i>'
                                        ])
                    !!}
                </div>

            </div>
        </div>
    </div>
</div>
<!-- End Single Card  -->

