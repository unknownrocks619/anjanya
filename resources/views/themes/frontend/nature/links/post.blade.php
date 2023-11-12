@php
    if (!isset($category) || !$category) {
        $category = 'uncategorized';
    } else {
        $category = $category->slug;
    }
@endphp
<a href="{{ route('frontend.category.post', ['slug' => $category, 'post_slug' => $post->slug]) }}">
    @if (isset($linkText))
        {!! $linkText !!}
    @else
        {{ $post->title }}
    @endif
</a>
