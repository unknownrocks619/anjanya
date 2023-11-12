@php /** @var \App\Models\Category $category */@endphp
@php
    $featuredImage = $category->getImage()->where('type','featured')->first();
    if ( $featuredImage ) {
        $featuredImage = \App\Classes\Helpers\Image::getImageAsSize($featuredImage->image->filepath,'m');
    } else {
        $featuredImage = \App\Classes\Helpers\SystemSetting::logo();
    }
@endphp
<div class="grid-item col-md-6">

    <article class="post">
        <figure class="feature-image">
            <a href="blog-single.html">
                <img src="{{$featuredImage}}" alt="{{$category->category_name}}">
            </a>
        </figure>
        <div class="entry-content">
            <h4>
                {!! $user_theme->links('category-link',['category' => $category]) !!}
            </h4>
            <div>
                {!! $category->full_description !!}
            </div>
        </div>
        <div class="entry-meta">
            <span class="byline">
                {!!  $user_theme->links('category-link',[
                                                'category' => $category,
                                                'label' => count($category::getPosts([$category->getKey()],null)) .' Post'] ) !!}
            </span>
            <span class="posted-on">
                    {!! $user_theme->links('category-link',['category' => $category,'label' => date('F d, Y',strtotime($category->created_at))]) !!}
            </span>
        </div>
    </article>
</div>
