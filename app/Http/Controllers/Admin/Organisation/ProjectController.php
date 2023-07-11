<?php

namespace App\Http\Controllers\Admin\Organisation;

use App\Classes\Helpers\Image;
use App\Http\Controllers\Controller;
use App\Models\FileRelation;
use App\Models\Organisation;
use App\Models\Project;
use App\Models\ProjectDonationBreaks;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ProjectController extends Controller
{
    //
    public function index(Organisation $org = null)
    {
        $projectQuery = new Project;

        if ($org) {
            $projectQuery->where('organisation_id', $org->getKey());
        }
        $projects = $projectQuery->get();

        return $this->admin_theme('organisation.projects.index', ['projects' => $projects]);
    }
    public function create(Request $request, Organisation $org = null)
    {
        if ($request->post()) {

            return $this->store($request, $org);
        }

        return $this->admin_theme('organisation.projects.add', ['org' => $org]);
    }

    public function edit(Project $project, $current_tab = 'general', Organisation $org = null)
    {
        $project->load(['getImage' => fn ($query) => $query->with('image'), 'getSeo' => fn ($query) => $query->with('seo')]);

        $tabs = [
            'general'       => $project,
            'media'         => $project->getImage ? $project->getImage : [],
            'seo'           => $project->getSeo,
            'authority'     => []
        ];

        if ($project->donation) {
            $tabs['donation'] = [];
            $project->load(['getDonationBreaks']);
            $tabs['breaks'] = $project->getDonationBreaks;
        }

        return $this->admin_theme(
            'organisation.projects.edit',
            [
                'tabs' => $tabs,
                'project' => $project,
                'org' => $org,
                'current_tab' => $current_tab
            ]
        );
    }

    public function store(Request $request, Organisation $org = null)
    {
        $request->validate([
            'project_title' => 'required',
            'country'   => 'required'
        ]);

        $project = new Project();
        $project->fill([
            'organisation_id'       => ($org) ?  $org->getKey() : $request->post('project_organisation'),
            'title'                 => $request->post('project_title'),
            'slug'                  => $project->getSlug($request->post('project_title')),
            'intro_text'            => $request->post('intro_text'),
            'short_description'     => $request->post('short_description'),
            'full_description'      => $request->post('full_description'),
            'donation'              => ($request->has('donation') && $request->post('donation') == 'on') ? true : false,
            'active'                => $request->has('active') ? $request->post('active') : false,
            'sort_by'               => $project->sortColumnValue($org),
            'category'              => $request->post('category'),
            'genre'                 => $request->post('genre'),
            'project_type'          => $request->post('project_type'),
            'project_country'       => $request->post('country')
        ]);

        try {
            $project->save();
        } catch (\Throwable $th) {
            //throw $th;
            return $this->json(false, 'Unable to create new project.', '', ['error' => $th->getMessage()]);
        }

        return $this->json(true, 'New Project Created.', 'redirect', ['location' => route('admin.org.projects.edit', ['project' => $project->getKey(), 'current_tab' => 'general', 'org' => $org?->getKey()])]);
    }

    public function update(Request $request, Project $project, Organisation $org = null)
    {
        $request->validate([
            'project_title' => 'required',
            'country'   => 'required'
        ]);

        $project->organisation_id =  ($org) ?  $org->getKey() : $request->post('project_organisation');
        $project->title = $request->post('project_title');
        $project->slug = $request->post('project_slug');
        $project->intro_text = $request->post('intro_text');
        $project->short_description = $request->post('short_description');
        $project->full_description = $request->post('full_description');
        $project->donation = $request->has('donation') && $request->post('donation') ? true : false;
        $project->active = $request->has('active') && $request->post('active') ? true : false;
        $project->category = $request->post('category');
        $project->genre = $request->post('genre');
        $project->project_type = $request->post('project_type');
        $project->project_country = $request->post('country');

        if ($project->isDirty('slug')) {
            $project->slug  = $project->getSlug($request->post('project_slug'), $project);
        }

        if ($project->donation) {

            if ($request->has('max_donation_amount')) {
                $project->max_donation_amount = $request->post('max_donation_amount');
            }

            if ($request->has('min_donation_amount')) {
                $project->min_donation_amount = $request->post('min_donation_amount');
            }
        }

        try {
            $project->save();
        } catch (\Throwable $th) {
            //throw $th;
            return $this->json(false, 'Unable to update project settings.');
        }


        return $this->json(true, 'Project information updated.', 'reload');
    }

    public function delete(Request $request, Project $project, Organisation $org = null)
    {
        $location = route('admin.org.projects.list');

        if ($org) {
            $location = route('admin.org.edit', ['org' => $org, 'current_tab' => 'projects']);
        }
        if (!$project->delete()) {
            return $this->json(false, 'Unable to remove project', 'redirect', ['location' => $location]);
        }

        return $this->json(true, 'Project Removed.', 'redirect', ['location' => $location]);
    }

    public function uploadImage(Request $request, Project $project, $current_tab = null, Organisation $org = null)
    {
        $uploadImage = Image::uploadImage($request->all(), $project);

        if (!$uploadImage) {
            return $this->json(false, 'Unabel to upload file.');
        }

        return $this->json(true, 'Image Uploaded.', 'redirect', ['location' => route('admin.org.projects.edit', ['project' => $project, 'org' => $org, 'current_tab' => 'media'])]);
    }

    public function update_image_relation(Request $request, Project $project, FileRelation $image_relation)
    {
        $image_relation->type = $request->record ?? null;
        if (!$image_relation->save()) {
            return $this->json(false, 'Unable to update Image Type.');
        }

        return $this->json(true, 'File Type Updated.');
    }

    public function remove_image(Project $project, Filerelation $image_relation, $current_tab = null, Organisation $org)
    {
        if (!$image_relation->delete()) {
            return $this->json(false, 'Unable to remove file.');
        }
        return $this->json(true, 'File removed.', 'redirect', ['location' => route('admin.org.projects.edit', ['project' => $project, 'org' => $org, 'current_tab' => 'media'])]);
    }

    public function updateBudgetInfo(Request $request, Project $project, $current_tab = null, Organisation $org = null)
    {
        if ($request->has('total_budget')) {
            $project->max_donation_amount = $request->post('total_budget');
        }

        if ($request->has('min_budget')) {
            $project->min_donation_amount = $request->post('min_budget');
        }


        if ($request->has('breaks')) {
            $breaksInfo = [];
            foreach ($request->post('breaks') as $key => $value) {
                $breaksInfo[] = [
                    'project_id'        => $project->getKey(),
                    'amount'            => $value,
                    'milestone_text'    => $request->post('milestone_text')[$key],
                    'organisation_id'   => $org?->getKey(),
                    'created_at'        => Carbon::now(),
                    'updated_at'        => Carbon::now()
                ];
            }

            $donationBreaks = new ProjectDonationBreaks;

            $donationBreaks->insert($breaksInfo);
        }

        $project->save();

        $backurl = route('admin.org.projects.edit', ['project' => $project, 'donation', 'org' => $org]);
        return $this->json(true, 'Donation information updated.', 'redirect', ['location' => $backurl]);
    }

    public function storeBudgetInfo(Request $request, Project $project, $current_tab = '', Organisation $org = null)
    {
        $insert = [];
        foreach ($request->post('breaks_amount') as $index => $value) {
            $insert[] = [
                'project_id'        => $project->getKey(),
                'organisation_id'   => $org?->getKey(),
                'amount'            => $value,
                'milestone_text'    => $request->post('milestone_text')[$index],
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now()
            ];
        }
        ProjectDonationBreaks::insert($insert);
        return $this->json(
            true,
            'Pricing break created.',
            'redirect',
            [
                'location' => route('admin.org.projects.edit', ['org' => $org, 'project' => $project, 'current_tab' => 'breaks'])
            ]
        );
    }

    public function deleteBudgetInfo(ProjectDonationBreaks $breaks, Project $project, Organisation $org)
    {
        if (!$breaks->delete()) {
            return $this->json(false, 'Unable to remove pricing detail.');
        }

        return $this->json(
            true,
            'Pricing Breaks remove.',
            'redirect',
            [
                'location' => route('admin.org.projects.edit', ['project' => $project, 'org' => $org, $current_tab = 'donation_breaks'])
            ]
        );
    }
}
