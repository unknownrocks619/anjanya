<?php

namespace App\Http\Controllers\Admin\Organisation;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectTransactions;
use Illuminate\Http\Request;

class ProjectTransactionController extends Controller
{
    //
    public function index(Project $project = null)
    {
        $transactionsBuilder = ProjectTransactions::orderBy('created_at');

        if ($project) {
            $transactionsBuilder->where('project_id', $project->getKey());
        }

        $transactions = $transactionsBuilder->get();

        return $this->admin_theme('project_transaction.project', ['transactions' => $transactions, 'project' => $project]);
    }
}
