@if ($category)
    <a href="{{ route('frontend.category.detail', ['slug' =>  $category->cat_slug ?? $category->slug ]) }}" class="@if(isset($class)) {{$class}} @endif">
        {{ $category->category_name ?? $category->cat_name }}
    </a>
@endif
