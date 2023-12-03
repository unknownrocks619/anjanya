<a href="{{ route('frontend.category.post', ['slug' => $slug,'post_slug' => $post_slug]) }}" class="@isset($class) {{$class}} @endisset">
    {!! $label !!}
</a>
