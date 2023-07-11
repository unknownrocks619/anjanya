<div class="course-card">
    <div class="img">
        @if ($book->getImage()->count())
            @php
                // get featured or cover image.
                $image = $book
                    ->getImage()
                    ->where('type', 'cover_image')
                    ->first();
                
                if (!$image) {
                    $image = $book
                        ->getImage()
                        ->where('type', 'featured_image')
                        ->first();
                }
                
                if (!$image) {
                    $image = $book
                        ->getImage()
                        ->latest()
                        ->first();
                }
                
                $image = $image->image->filepath;
            @endphp
            <img src="{{ \App\Classes\Helpers\Image::getImageAsSize($image, 'm') }}" alt="{{ $book->book_title }}">
        @else
            <img src="{{ asset('missing-image.png') }}" alt="{{ $book->book_title }}">
        @endif
    </div>
    <div class="course-name">
        {{ $book->book_title }}
    </div>
    <div class="status-badge review">
        {{ __('web/book.' . $book->status) }}
    </div>
    <div>
        @if ($book->status == 'draft')
            <a href="{{ route('frontend.books.upload_user', ['book' => $book, 'current_tab' => $book::DB_DISPLAY_STAGE[$book->upload_stage]]) }}"
                class="course-btn">{{ __('web/dashboard.continue_edit') }}</a>
            <button class="course-btn btn btn-danger data-confirm" data-confirm="Are you sure?" data-method="POST"
                data-action="{{ route('frontend.books.delete_book', ['book' => $book, '_ref' => 'dashboard']) }}"
                style="background: red;border:red">{{ __('Delete') }}</button>
        @else
            <a href="#" class="course-btn disable">{{ __('web/dashboard.view_book') }}</a>
        @endif

    </div>
</div>
