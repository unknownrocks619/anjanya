<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="vh-100 d-flex justify-content-center align-items-center">
                <div class="card col-md-4 bg-white shadow-md p-5">
                    <div class="mb-4 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="text-danger" width="75" height="75" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                            <path d="M4.177 4.177a.75.75 0 0 1 1.06 0L8 6.94l2.763-2.763a.75.75 0 0 1 1.06 1.06L9.06 8l2.763 2.763a.75.75 0 0 1-1.06 1.06L8 9.06l-2.763 2.763a.75.75 0 0 1-1.06-1.06L6.94 8 4.177 5.237a.75.75 0 0 1 0-1.06z"/>
                        </svg>
                    </div>
                    <div class="text-center">
                        <h1>{{__('web/registration/events.error')}}</h1>
                        <p>{{__('web/registration/events.error-paragraph')}}</p>
                        <a href="{{route('frontend.event.event-registration',['slug' => $event->event_slug])}}" class="btn btn-success fs-1">{{__('web/registration/events.try-again')}}</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Row -->
    </div>
</div>
@php session()->forget('current_step') @endphp
