@php /** @var \App\Models\Category $category */@endphp
@php /** @var string $label */ @endphp
@if ($category)
    <a href="{{ route('frontend.category.detail', ['slug' => $category->slug]) }}" class="">
        @if(isset($label))
            {{$label}}
        @else
            {{ $category->category_name }}
        @endif
    </a>
@endif
