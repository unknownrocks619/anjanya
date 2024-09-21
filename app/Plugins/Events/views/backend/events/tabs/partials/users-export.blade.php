<table>
    <thead>
        <tr>
            <th colspan="7" style="font-size: 30px;">{{$event->event_list}} Export List</th>
        </tr>
        <tr></tr>
        <tr>
            <th>Full Name</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Date of Birth</th>
            <th>Gotra</th>
            <th>Gender</th>
            <th>Country</th>
            <th>Address</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $record)
            <tr>
                <td>{{$record->first_name}} {{ $record->middle_name}} {{$record->last_name}}</td>
                <td>{{$record->email}}</td>
                <td>{{$record->phone_number}}</td>
                <td>{{$record->date_of_birth}}</td>
                <td>{{$record->gotra}}</td>
                <td>{{ucwords($record->gender)}}</td>
                <td>{{ $record->portalCountry?->name ?? $record->country }}</td>
                <td>
                    @php
                        try {
                            $address = json_decode($record->address);
                            $address = $address?->street_address;
                        } catch (\Throwable $th) {
                            $address  = $record->address?->street_address;
                        }
                    @endphp
                    {{$address}}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
