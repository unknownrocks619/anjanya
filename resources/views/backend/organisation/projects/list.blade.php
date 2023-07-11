<?php
if (!isset($org)) {
    $org = null;
}
?>
<table class="table table-hover display datatable-lister" id='user-list-table'>
    <thead>
        <tr>
            <th>Title</th>
            <th>Associates</th>
            <th>Location</th>
            <th>Status</th>
            <th>Amount</th>
            <th>Progress</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($projects as $project)
            <tr>
                <td>
                    {{ $project->title }}
                </td>
                <td>
                    @if (isset($associate) && !$associate)
                        {{ $assoicate->organisation_name }}
                    @else
                        {{ $project->organisation->organisation_name }}
                    @endif
                </td>
                <td>
                    {{ $project->project_country }}
                </td>
                <td>
                    <span
                        class='{{ $project->active ? 'badge rounded-pill badge-success px-1' : 'badge rounded-pill badge-danger px-1' }}'>
                        {{ $org?->active ? ' Active ' : 'Inactive' }}
                    </span>
                </td>
                <td>
                    {{ $project->donation && $project->max_donation_amount ? 'AUD' . $project->max_donation_amount : 'AUD 0.00' }}
                </td>
                <td>
                    @if ($project->donation && $project->max_donation_amount)
                        <div class="progress" style="height: 5px">
                            <div class="progress-bar-animated bg-primary progress-bar-striped" role="progressbar"
                                style="width:{{ $project->getDonationPercentage() }}%" aria-valuenow="10" aria-valuemin="0"
                                aria-valuemax="{{ $project->max_donation_amount }}"></div>
                        </div>
                    @else
                        <span class="text-danger">
                            Not Available
                        </span>
                    @endif
                </td>
                <td>
                    <?php
                    $editHref = route('admin.org.projects.edit', ['project' => $project]);
                    $deleteHref = route('admin.org.projects.delete', ['project' => $project]);
                    if ($org) {
                        $editHref = route('admin.org.projects.edit', ['project' => $project, 'current_tab' => 'general', 'org' => $org]);
                        $deleteHref = route('admin.org.projects.delete', ['project' => $project, 'current_tab' => 'general', 'org' => $org]);
                    }
                    ?>
                    <ul class="action">
                        <li class="edit">
                            <a href="{{ $editHref }}"><i class="icon-pencil-alt"></i></a>
                        </li>
                        <li class="transactions">
                            <a href="{{ route('admin.org.transactions.list', ['project' => $project]) }}"><i
                                    class="icon-eye-alt"></i></a>
                        </li>
                        <li class="delete">
                            <a href="#" class="data-confirm" data-confirm='Are you Sure ?' data-method="post"
                                data-action="{{ $deleteHref }}">
                                <i class="icon-trash"></i></a>
                        </li>
                    </ul>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
