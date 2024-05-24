@extends($user_theme->frontend_layout($extends))
@section('page_title')-Reference Complete @endsection
@section('main')
    <div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="vh-100 d-flex justify-content-center align-items-center">
                <div class="card col-md-6 bg-white shadow-md p-5">
                    <div class="mb-4 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="text-success" width="75" height="75"
                             fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                            <path
                                d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z" />
                        </svg>
                    </div>
                    <div class="text-center">
                        <h1>{{__('web/registration/events.thank-you')}}</h1>
                        <p>
                            Congratulations! Your registration process is now complete. Please click on the "Go to Dashboard" button to access your Sadhak portal.
                            <br />

                            In your Sadhak portal, you will find a variety of tools and resources tailored to enhance your spiritual journey. Here's a brief overview of what you can expect:

                        </p>
                        <a href="https://jagadguru.siddhamahayog.org/user/dashboard" class="btn btn-success fs-1">{{__('web/registration/events.portal-dashboard')}}</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Row -->
    </div>
</div>
@endsection