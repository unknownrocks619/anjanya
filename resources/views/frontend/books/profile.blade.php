@extends('themes.frontend.users.profile')

@push('title')
    :: My Books
@endpush

@section('main_content')
    <div class="container">
        <div class="course-nav">
            <nav class="sm-flow">
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    @foreach ($tabs as $key => $content)
                        <button class="nav-link @if ($key == $current_tab) active @endif" id="{{ $key }}_tab"
                            data-bs-toggle="tab" data-bs-target="#{{ $key }}" type="button" role="tab"
                            aria-controls="{{ $key }}" aria-selected="true">
                            {{ __('web/book.' . $key) }}
                            ({{ count($content) }})
                        </button>
                    @endforeach
                </div>
            </nav>
            @foreach ($tabs as $key => $content)
                @include('frontend.books.tabs.' . $key, [$key => $content, 'tab_key' => $key])
            @endforeach
        </div>
    </div>
@endsection
