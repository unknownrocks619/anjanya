<?php

namespace App\Http\Controllers\Web\Project;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    //

    public function projectAPIList()
    {

        $projects = Project::where('active', true)
            ->with(['getImage' => function ($query) {
                $query->with('image');
            }, 'organisation'])
            ->where('project_type', 'library')
            ->get();

        $response = [];
        foreach ($projects as $project) {
            $innerArray = [
                '_p_id' => $project->getKey(),
                'project_title' => $project->title,
                'org_name'      => $project->organisation->organisation_name,
                'description' => $project->intro_text
            ];

            $image = $project->getImage()->where('type', 'featured_image')->latest()->first();

            if (!$image) {
                $image = $project->getImage()->where('type', '!=', 'achievement')->latest()->first();
            }

            if ($image) {
                $image = \App\Classes\Helpers\Image::getImageAsSize($image->image->filepath, 'm');
            }

            if (!$image) {
                $image = asset('missing-image.png');
            }

            $innerArray['image'] = $image;

            $response[] = $innerArray;
        }

        return $this->json(true, '', '', ['project' => $response]);
    }

    public function projectModalPop()
    {
        return $this->user_theme('books.modal.project-list')->render();
    }
}
