@extends($user_theme->frontend_layout($extends))
@section('main')
    <div class="row align-items-center justify-content-center mt-5">
        <div class="col-12 text-center">
            {!! $user_theme->header() !!}
            <h4 class="my-3 mb-5" style="font-family: gnsmfTagline;font-size: 43px">
                Your future in healthcare starts here.
            </h4>
        </div>
        <div class="col-12 text-center d-flex justify-content-center">
            {!! $user_theme->partials('navigation') !!}
        </div>
    </div>
@endsection
