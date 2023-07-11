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
</div>

@if ($project->donation && $project->max_donation_amount)
    <form
        action="{{ route('admin.org.projects.store_pricing_breaks', ['project' => $project, 'current_tab' => 'breaks', 'org' => $org]) }}"
        method="post" class="ajax-form">
        <div class="col-md-12">
            <div class="card">
                <div class="row break-downamount">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="amount">Break Down Amount</label>
                            <input type="text" name="breaks_amount[]" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="amount">Milestone Text / Notes</label>
                            <textarea name="milestone_text[]" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="col-md-2 d-flex align-items-center">
                        <a class="btn btn-info clone-button">
                            <i class="fa fa-copy"></i>
                        </a>
                        <a class="btn btn-danger remove-clone d-none">
                            <i class="fa fa-trash-o"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-footer text-end text-right">
                <button type="submit" class="btn btn-primary">
                    Save Price Break Down
                </button>
            </div>
        </div>
    </form>
@endif
<div class="row">
    <!-- Zero Configuration  Starts-->
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover display datatable-lister" id='user-list-table'>
                        <thead>
                            <tr>
                                <th>Amount</th>
                                <th>Milestone Text</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($content as $pricing_break)
                                <tr>
                                    <td>
                                        {{ $pricing_break->amount }}
                                    </td>
                                    <td>
                                        {{ $pricing_break->milestone_text }}
                                    </td>
                                    <td>
                                        <ul class="action">
                                            <li class="delete"><a href="#"><i class="icon-trash"></i></a></li>
                                        </ul>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Zero Configuration  Ends-->
</div>
