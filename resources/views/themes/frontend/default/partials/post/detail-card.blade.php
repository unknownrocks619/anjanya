@php
    $defaultCardSize = isset($card_size) ? 'col-sm-' . $card_size : 'col-sm-6';
@endphp
<div class="{{ $defaultCardSize }}">
    <!-- post -->
    <div class="post post-grid rounded bordered">
        <div class="thumb top-rounded">
            @if (!isset($category))
                @php
                    $post_category = $post->getCategories();
                    $post_category = !is_array($post_category) ? $post_category->last() : null;
                @endphp
                {!! $user_theme->links('category', ['category' => $post_category]) !!}
            @else
                @php $post_category = $category @endphp
            @endif
            {!! $post->getPostTypeIcon() !!}

            <a
                href="{{ route('frontend.category.post', ['slug' => $post_category?->slug ?? 'uncategorized', 'post_slug' => $post->slug]) }}">
                {!! $post->getPostTypeIcon() !!}
                <div class="inner">
                    @php
                        $introImage = \App\Classes\Helpers\SystemSetting::logo();
                        $linkedImage = $post
                            ->getImage()
                            ->where('type', 'intro_image')
                            ->first();
                        
                        if ($linkedImage) {
                            $introImage = \App\Classes\Helpers\Image::getImageAsSize($linkedImage->image->filepath, 'm');
                        } else {
                            $linkedImage = $post
                                ->getImage()
                                ->where('type', 'featured_image')
                                ->first();
                        
                            if ($linkedImage) {
                                $introImage = \App\Classes\Helpers\Image::getImageAsSize($linkedImage->image->filepath, 'm');
                            }
                        }
                    @endphp
                    <img src="{{ $introImage }}" alt="{{ $post->title }}" />
                </div>
            </a>
        </div>
        <div class="details">
            <ul class="meta list-inline mb-0">
                <li class="list-inline-item"><a href="#">
                        <img src="{{ \App\Classes\Helpers\SystemSetting::logo() }}" class="author" style="width:25px;"
                            alt="{{ \App\Classes\Helpers\SystemSetting::basic_configuration('site_name') }}" />{{ \App\Classes\Helpers\SystemSetting::basic_configuration('site_name') }}</a>
                </li>
                <li class="list-inline-item">{{ date('M d Y', strtotime('updated_at')) }}</li>
            </ul>
            <h5 class="post-title mb-3 mt-3">
                {!! $user_theme->links('post', ['category' => $post_category, 'post' => $post]) !!}
            </h5>
            <p class="excerpt mb-0">
                {{ $post->intro_description }}
            </p>
        </div>
        <div class="post-bottom clearfix d-flex align-items-center">
            <div class="social-share me-auto">
                <button class="toggle-button icon-share"></button>
                <ul class="icons list-unstyled list-inline mb-0">
                    <li class="list-inline-item"><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                    <li class="list-inline-item"><a href="#"><i class="fab fa-twitter"></i></a></li>
                    <li class="list-inline-item"><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                    <li class="list-inline-item"><a href="#"><i class="fab fa-pinterest"></i></a></li>
                    <li class="list-inline-item"><a href="#"><i class="fab fa-telegram-plane"></i></a></li>
                    <li class="list-inline-item"><a href="#"><i class="far fa-envelope"></i></a></li>
                </ul>
            </div>
            <div class="more-button float-end">
                {!! $user_theme->links('post', [
                    'category' => $post_category,
                    'post' => $post,
                    'linkText' => '<span class="icon-options"></span>',
                ]) !!}
            </div>
        </div>
    </div>
</div>
