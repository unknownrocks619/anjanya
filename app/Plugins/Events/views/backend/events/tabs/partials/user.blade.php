<div class="card mb-1 border-bottom border-1 " style="border-radius: 3px">
    <div class="card-body p-3">
        <div class="row align-items-center">
            <div class="col-md-10">
                <h4 class="mb-0">
                    {{$user->full_name}} <small>&lt;{{$user->email}}&gt;</small>
                </h4>
                <small>
                    Enrolled Date: {{$user->user_registration_date ?? $user->created_at}}
                    <span class="badge badge-primary">{{ ucwords($user->gender) }}</span>
                </small>

                <p class="fs-6 mb-0">
                    <em>Phone Number:</em> {{$user->phone_number}}
                </p>
                <p class="fs-6">
                    {{ $user->portalCountry?->name ?? $user->country }},{{ $user->city }},{{ $user->address?->street_address }}
                </p>

            </div>
            <div class="col-md-2 text-end">
                <a class="px-3 btn btn-info btn-sm btn-icon"
                   href="{{ route('admin.events.print', ['event' => $event['id'], 'user' => $user]) }}">
                    <i class="fa fa-print fs-4"></i>
                </a>

                <a href="{{ route('admin.events.registration', ['event' => $event['id'], 'type' => 'registration', 'currentUser' => $user->getKey()]) }}"
                   class="px-3 btn btn-sm btn-primary btn-icon">

                    <i class="fa fa-pencil fs-4"></i>
                </a>
            </div>
        </div>

    </div>
</div>
