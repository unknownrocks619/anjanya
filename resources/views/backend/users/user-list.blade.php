<div class="card-body">
    <div class="table-responsive">
        <table class="table table-hover display datatable-lister" id='user-list-table'>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>
                            {{ $user->getFullName() }}
                        </td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <ul class="action">
                                <li class="edit"> <a href="#"><i class="icon-pencil-alt"></i></a>
                                </li>
                                <li class="delete"><a href="#"><i class="icon-trash"></i></a></li>
                            </ul>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
