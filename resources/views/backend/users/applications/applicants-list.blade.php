<tr>
    <td>
        <img src="{{ \App\Classes\Helpers\Image::getImageAsSize($application->getUser->getImage()->latest()->first()?->image->filepath,'s') }}"
            class="img-fluid table-avtar" style="max-height:32px; max-width:32px;" />

        {{ $application->getUser->getFullName() }}
        @if ($application->resubmitted_count)
            <span class="badge badge-warning">
                Re-submission
            </span>
        @endif
    </td>

    <td>{{ $application->getUser->email }}</td>
    <td>
        @php
            $dateOfBirth = $application->getUser->date_of_birth;
            $carbonBirth = \Carbon\Carbon::parse($dateOfBirth);
            echo $carbonBirth->diffInYears();
        @endphp
    </td>
    <td>
        {{ $application->getUser->phone_number }}
    </td>
    <td>
        {{ ucfirst($application->getUser->gender) }}
    </td>
    <td>{{ $application->getUser->getCountry?->name }}</td>
    <td>
        {!! \App\Classes\Helpers\Status::status_label($application->status) !!}
    </td>
    <td>
        <ul class="action">
            <li class="edit">
                <a href="{{ route('admin.users.applications.edit', ['application' => $application]) }}">
                    <i class="icon-pencil-alt"></i>
                </a>
            </li>
            <li class="delete"><a href="#"><i class="icon-trash"></i></a></li>
        </ul>
    </td>
</tr>
