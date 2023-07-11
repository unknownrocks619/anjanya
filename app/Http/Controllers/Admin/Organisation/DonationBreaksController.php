<?php

namespace App\Http\Controllers\Admin\Organisation;

use App\Http\Controllers\Controller;
use App\Models\Organisation;
use App\Models\Project;
use App\Models\ProjectDonationBreaks;
use Illuminate\Http\Request;

class DonationBreaksController extends Controller
{
    //

    public function destroy(ProjectDonationBreaks $donation_breaks, Project $project, $current_tab = null, Organisation $org = null)
    {

        if (!$donation_breaks->delete()) {
            return $this->json(false, 'Unable to remove donatin breaks.');
        }

        return $this->json(true, 'Donatin Pricing breaks removed.', 'redirect', [
            'location'  => route('admin.org.projects.edit', ['project' => $project, 'current_tab' => 'donation', 'org' => $org])
        ]);
    }
}
