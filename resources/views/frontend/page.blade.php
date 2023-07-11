@extends('themes.frontend.users.auth', ['bodyAttribute' => ['class' => 'bg-white landing-page'], 'isLanding' => $isLanding, 'isFooter' => $isFooter])
@push('title')
    | @if (isset($page) && $page)
        {{ $page->title }}
    @else
        {{ $menu->menu_name }}
    @endif
@endpush

@section('main_content')
    <div class="container pt-5">
        @if ($menu->menu_type == 'book_bundle')
            @include('frontend.bundle.index')
        @endif
    </div>
@endsection
