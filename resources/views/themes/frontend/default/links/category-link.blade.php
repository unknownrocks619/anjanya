@if ($category)
    <a href="{{ route('frontend.category.detail', ['slug' => $category->slug]) }}" class="">
        {{ $category->category_name }}
    </a>
@endif
