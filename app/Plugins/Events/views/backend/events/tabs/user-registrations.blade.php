@php
    /** @var  \App\Plugins\Events\Http\Models\Event $event */
    $programUser = new \App\Models\Portal\ProgramUser();
    $userModelQuery = \App\Models\Portal\UserModel::query();
    $userModelQuery
        ->join($programUser->getTable(), function (Illuminate\Database\Query\JoinClause $join) use (
            $programUser,
            $event,
        ) {
            $join->on('student_id', 'members.id');
            $join->where('program_id', $event['portal_program_id']);
        })
        ->selectRaw('members.* , ' . $programUser->getTable() . '.created_at AS user_registration_date')
        ->with(['diskshya', 'meta', 'emergency', 'profileImage']);
    $users = $userModelQuery->limit(2000)->get();

@endphp
<div class="col-md-12">
    <div class="row my-2">
        <div class="col-md-6">
            <a href="{{ route('admin.events.registration', ['event' => $event['id'], 'type' => 'old-registration']) }}"
                class="btn btn-danger">
                <i class="fa fa-plus"></i> New Registration
            </a>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('admin.events.registration', ['event' => $event['id'], 'type' => 'registration']) }}"
                class="btn btn-primary">
                <i class="fa fa-plus"></i> Old Registration
            </a>
        </div>
    </div>
    <div class="table-responsive">
        <table id="user-registration-list" class="table table-hover table-border datatable-lister">
            <thead>
                <tr>
                    <th>
                        Full Name
                    </th>
                    <th>
                        Phone Number
                    </th>
                    <th>
                        Gender
                    </th>
                    <th>
                        Address
                    </th>
                    <th>
                        Registration Date
                    </th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>
                            {{ $user->full_name() }}
                        </td>
                        <td>
                            {{ $user->phone_number }}
                        </td>
                        <td>
                            {{ ucwords($user->gender) }}
                        </td>
                        <td>
                            {{ $user->portalCountry?->name ?? $user->country }},{{ $user->city }},{{ $user->address?->street_address }}
                        </td>
                        <td>{{ $user->user_registration_date ?? $user->created_at }}</td>
                        <td>
                            <a class="btn btn-info btn-icon"
                                href="{{ route('admin.events.print', ['event' => $event['id'], 'user' => $user]) }}">
                                <i class="fa fa-print fs-4"></i>
                            </a>

                            <a href="{{ route('admin.events.registration', ['event' => $event['id'], 'type' => 'registration', 'currentUser' => $user->getKey()]) }}"
                                class="btn btn-primary btn-icon">

                                <i class="fa fa-pencil fs-4"></i>
                            </a>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<script>
    setTimeout(() => {
        new DataTable('#user-registration-list')
    }, 1000);
</script>
