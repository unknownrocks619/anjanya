@extends('themes.admin.master')

@push('page_title')
    - {{ $event->event_title }}
@endpush

@section('main-content')
    <div class="row">
        <div class="col-md-12">
            <div class="card action-bar align-content-end mt-3 rounded-3" style="background: #e0e0e0">
                <div class="card-body py-0 ps-2">
                    <a href="{{ route('admin.events.edit', ['event' => $event, 'tab' => 'user-registrations']) }}"
                        class="btn btn-danger btn-icon">
                        <i class="fa fa-arrow-left"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="alert alert-info">
                    <div class="alert-heading border-bottom">
                        <h2 class="text-white">
                            Registration for Existing User ?
                        </h2>
                    </div>
                    <div class="fs-5 mt-2">
                        For the user who exists in our system please use their email address or phone number to search.
                        If you want to register new user, Click the button New Registration Option.
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <a href="{{ route('admin.events.registration', ['event' => $event, 'type' => 'old-registration']) }}"
                        class="btn btn-primary fs-5">
                        <i class="fa  fa-plus"></i>
                        New Member Registration
                    </a>
                </div>
            </div>
            <form action="{{ route('admin.events.registration', ['event' => $event]) }}" method="get">
                <!-- Zero Configuration  Starts-->
                <div class="col-sm-12 mt-4 fs-4">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" name="term" id="" class="form-control fs-4"
                            placeholder="Email or Phone Number" style="min-height: 60px;">
                    </div>
                </div>
                <div class="col-md-12 text-end">
                    <button class="btn btn-primary w-100 fs-5">Search User</button>
                </div>
            </form>
        </div>

        @if ($users->count())
            <div class="row mt-2">
                {{-- <div class="col-md-12">
                    <h2>Search Result</h2>
                </div> --}}
                @foreach ($users as $user)
                    <div class="col-6">
                        <div class="card">
                            <div class="card-header py-2 bg-success text-white">
                                <h4 class="card-title mb-1">{{ $user->full_name }} </h4>
                            </div>
                            <div class="card-body fs-6 mt-1 pt-1">
                                <p>
                                    Phone Number: {{ $user->phone_number }} <br />
                                    Email : {{ $user->email }}<br />
                                    Created Date : {{ $user->created_at }}
                                </p>
                            </div>
                            <div class="card-footer py-1 bg-transparent">
                                <div class="row">
                                    <div class="col-md-12 text-end">
                                        <a href="{{ route('admin.events.registration', ['event' => $event, 'type' => 'user-registrations', 'currentUser' => $user]) }}"
                                            class="btn btn-primary">
                                            Select User
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

    </div>
@endsection
