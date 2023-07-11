@if ($content && count($content))
    <div class="course-section">
        <h3>{{ __('web/dashboard.books') }}</h3>

        <div class="course-grid">
            @foreach ($content as $book)
                @include('frontend.books.tabs.profile-lister', ['book' => $book])
            @endforeach
        </div>

    </div>
@endif
