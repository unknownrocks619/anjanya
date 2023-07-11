@if ($category)
    <a href="{{ route('frontend.category.detail', ['slug' => $category->slug]) }}"
        class="category-badge position-absolute">
        {{ $category->category_name }}
    </a>
@endif
