@extends($user_theme->frontend_layout($extends))
@section('main')
    <div class="row vh-100 align-items-center">
        <div class="col-12 text-center">
       {!! $user_theme->header() !!}
            <div class="mt-4">
                <a type="button" class="btn btn-outline-primary py-3 px-5 mx-2 my-2" data-bs-toggle="collapse" data-bs-target="#hospital-service"
                   aria-expanded="false"  aria-controls="multiCollapseExample2">
                    Hospital Service</a>
                <a href="{{route('frontend.pages.menu-list')}}" class="btn btn-outline-primary py-3 px-5 my-2">Education Service</a>
            </div>
        </div>
        <div class="collapse col-12 text-center alert alert-danger" id="hospital-service">
            <h2>Sorry This service is currently unavailable. Please visit later.</h2>
        </div>
    </div>

@endsection
