<tr>
    <td>{{$member->name}}</td>
    @if(isset($group) && $group == true)
        <td>
            {{$member->team->name}}
        </td>
    @endif
    <td>
        <ul class="action">
            <li class="edit">
                <a href="{{route('admin.teams.edit.member',['member' => $member,'tab' => 'general'])}}">
                    <i class="icon-pencil-alt"></i>
                </a>
            </li>
            <li class="delete">
                <a href="#" data-confirm="You are about to delete member. Do you wish to continue ?" class="data-confirm" data-method="post" data-action="{{route('admin.teams.delete.member',['member' => $member])}}"><i class="icon-trash"></i></a>
            </li>
        </ul>
    </td>

</tr>
