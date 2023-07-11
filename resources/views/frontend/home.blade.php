@extends('themes.frontend.users.auth', ['bodyAttribute' => ['class' => 'bg-white'], 'isLanding' => true, 'isFooter' => true])
@push('title')
    |
    {{ $menu->menu_name }}
@endpush

@section('main_content')
    <div class="container-fluid px-0 pt-5">
        @include('frontend.components.lister', ['model' => $menu])
    </div>
@endsection
