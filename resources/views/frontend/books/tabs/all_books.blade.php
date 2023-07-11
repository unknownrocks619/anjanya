<div class="tab-pane fade @if ($tab_key == $current_tab) active show @endif" id="{{ $tab_key }}" role="tabpanel"
    aria-labelledby="{{ $tab_key }}_tab" tabindex="0">
    <div class="course-section">
        <div class="course-grid">
            @foreach ($$tab_key as $book)
                @include('frontend.books.tabs.profile-lister', [
                    'book' => $book,
                ])
            @endforeach
        </div>
    </div>
</div>
