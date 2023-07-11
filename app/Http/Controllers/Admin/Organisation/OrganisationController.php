<?php

namespace App\Http\Controllers\Admin\Organisation;

use App\Classes\Helpers\Image;
use App\Http\Controllers\Controller;
use App\Models\FileRelation;
use App\Models\Organisation;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OrganisationController extends Controller
{
    //

    public function index(Request $request)
    {
        if ($request->post()) {
            return $this->store($request);
        }
        $organisations = Organisation::all();
        return $this->admin_theme('organisation.index', ['organisations' => $organisations]);
    }

    public function create()
    {
    }

    public function edit(Request $request, Organisation $org, $current_tab = null)
    {

        if ($request->post()) {

            $org->organisation_name = $request->post('org_name');
            $org->slug = $request->post('slug');
            $org->short_description = $request->post('short_description');
            $org->full_description = $request->post('full_description');
            $org->type =  !in_array($request->post('type'), array_keys(Organisation::ORG_TYPES)) ? $org->type : $request->post('type');


            if ($org->isDirty('slug')) {
                $org->slug = Organisation::validateSlug($request->post('slug'), $org);
            }

            if (!$org->save()) {

                return $this->json(false, 'Unable to update organisation detail.');
            }

            return $this->json(true, 'Organisation detail updated.', 'reload');
        }

        $org->load(
            [
                'getImage'     => fn ($query)  => $query->with('image'),
                'getSeo'        => fn ($query)  => $query->with('seo'),
                'getProjects'
            ]
        );
        $images = $org->getImage;
        $seo = $org->getSeo;
        $projects = $org->getProjects;
        $tabs = [
            'general'   => $org,
            'media'     => $images,
            'seo'       => $seo,
            'projects'  => $projects
        ];
        if ($org->type == 'university') {
            $tabs['students'] = '';
        }
        $current_tab =  !$current_tab || !in_array($current_tab, array_keys($tabs)) ? 'general' : $current_tab;

        return $this->admin_theme('organisation.edit', ['tabs' => $tabs, 'current_tab' => $current_tab, 'org' => $org]);
    }

    public function store(Request $request, Organisation $org = null)
    {
        $request->validate([
            'org_name'  => 'required',
            'type'     => 'required|in:' . implode(',', array_keys(Organisation::ORG_TYPES)),
        ]);




        $organisation = new Organisation();
        $organisation->fill(
            [
                'organisation_name' => $request->post('org_name'),
                'type'              => $request->post('type'),
                'active'            => false,
                'slug'              => $organisation::validateSlug(Str::slug($request->post('org_name')))
            ]
        );

        try {
            $organisation->save();
        } catch (\Throwable $th) {
            //throw $th;
            return $this->json(false, 'Unable to save record.', '', ['error' => $th->getMessage()]);
        }
        return $this->json(
            true,
            'Organisation created.',
            'redirect',
            [
                'location' => route(
                    'admin.org.edit',
                    [
                        'org' => $organisation->getKey()
                    ]
                )
            ]
        );
    }

    public function uploadImage(Request $request, Organisation $org)
    {
        $uploadImage = Image::uploadImage($request->all(), $org);

        if (!$uploadImage) {
            return $this->json(false, 'Unabel to upload file.');
        }

        return $this->json(true, 'Image Uploaded.', 'redirect', ['location' => route('admin.org.edit', ['org' => $org, 'current_tab' => 'media'])]);
    }

    public function update_image_relation(Request $request, Organisation $org, FileRelation $image_relation)
    {
        $image_relation->type = $request->record ?? null;
        if (!$image_relation->save()) {
            return $this->json(false, 'Unable to update Image Type.');
        }

        return $this->json(true, 'File Type Updated.');
    }

    public function remove_image(Request $request,  Organisation $org, FileRelation $image_relation)
    {
        if (!$image_relation->delete()) {
            return $this->json(false, 'Unable to remove file.');
        }
        return $this->json(true, 'File removed.', 'redirect', ['location' => route('admin.org.edit', ['org' => $org->getKey(), 'current_tab' => 'media'])]);
    }
}
