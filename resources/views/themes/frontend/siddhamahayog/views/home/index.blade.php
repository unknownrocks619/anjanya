@extends($user_theme->frontend_layout($extends))
@section("page_title")

@endsection

@section('main')
    @include('frontend.components.lister', ['model' => $menu])

@endsection
