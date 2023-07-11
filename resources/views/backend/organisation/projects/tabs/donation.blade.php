<div class="row g-2 bg-white mt-3">
    @if ($project->donation && !$project->max_donation_amount)
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="text-danger card-title">
                        Please Setup Budget Amount
                    </h4>
                    <form
                        action="{{ route('admin.org.projects.update_budget_info', ['org' => $org, 'project' => $project, 'current_tab' => 'breaks']) }}"
                        method="post" class="ajax-form">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input class="form-control" type="text" name="total_budget" id="total_budget"
                                        placeholder="Amount" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mt-3">
                                <button type="submit" class="btn btn-danger">
                                    Save Budget Information
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
    @php
        $transactions = $project->getProjectTransaction;
    @endphp

    @if ($transactions)
        @include('backend.project_transaction.list', [
            'project' => $project,
            'transactions' => $transactions,
        ]);
    @else
        <table class="table table-hover display datatable-lister" id='user-list-table'>
            <thead>
                <tr>
                    <th>Amount</th>
                    <th>Milestone Text</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($content as $content)
                    <tr>
                        <td>
                            AUD
                            {{ $content->amount }}
                        </td>
                        <td>
                            {{ $content->milestone_text }}
                        </td>
                        <td>
                            <ul class="action">
                                <li class="delete">
                                    <a href="#" class="data-confirm" data-confirm='Are you Sure ?'
                                        data-method="post" data-action="{{-- --}}">
                                        <i class="icon-trash"></i></a>
                                </li>
                            </ul>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    @endif
</div>
