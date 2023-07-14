<div class="widget rounded">
    <div class="widget-header text-center">
        <h3 class="widget-title">Explore Topics</h3>
        <img src="{{ asset('images/wave.svg') }}" class="wave" alt="wave" />
    </div>
    <div class="widget-content">
        <ul class="list">
            @foreach (\App\Models\Category::limit(6)->orderBy('updated_at')->get() as $category)
                <li>
                    {!! $user_theme->links('category-link', ['category' => $category]) !!}
                </li>
            @endforeach
        </ul>
    </div>

</div>
