@extends($user_theme->frontend_layout($extends))
@section('main')
    <section class="main-content">
        @include('frontend.components.lister', ['model' => $menu])
    </section>
@endsection
