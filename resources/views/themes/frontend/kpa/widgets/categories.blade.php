<div class="rts-single-wized Categories">
    <div class="wized-header">
        <h5 class="title">
            Categories
        </h5>
    </div>
    <div class="wized-body">
        @foreach (App\Models\Category::blog()->latest()->get() as $category)
            <ul class="single-categories">
                <li>
                    <a href="{{route('frontend.category.detail',['slug' => $category->slug])}}">{{$category->category_name}}
                        <i class="far fa-long-arrow-right"></i>
                    </a>
                </li>
            </ul>
        @endforeach
    </div>
</div>
