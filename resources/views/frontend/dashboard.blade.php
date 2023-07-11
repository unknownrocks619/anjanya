@extends('themes.frontend.users.profile')

@push('title')
    :: Dashboard
@endpush

@section('main_content')
    <div class="container">
        @foreach ($tabs as $key => $content)
            @include('frontend.profile.' . $key, ['content' => $content])
        @endforeach
    </div>
@endsection
