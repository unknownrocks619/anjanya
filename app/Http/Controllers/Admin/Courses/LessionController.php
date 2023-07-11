<?php

namespace App\Http\Controllers\Admin\Courses;

use App\Http\Controllers\Controller;
use App\Models\Chapter;
use App\Models\Course;
use App\Models\Lession;
use Illuminate\Http\Request;

class LessionController extends Controller
{
    //
    public function index()
    {
        $lessons = Lession::with(['getCourse', 'getChapter'])->get();
        return $this->admin_theme('lessions.index', ['lessions' => $lessons]);
    }

    public function create(Request $request, Chapter $chapter = null, Course $course = null, $current_tab = null)
    {
        if ($request->post() && $request->ajax()) {
            return $this->store($request, $chapter, $course, $current_tab);
        }
        return $this->admin_theme('lessions.add', ['chapter' => $chapter, 'course' => $course, 'current_tab' => $current_tab]);
    }

    public function store(Request $request, Chapter $chapter = null, Course $course = null, $current_tab = null)
    {
        $request->validate([
            'lession_name',
        ]);
        $lession = new Lession();
        $lession->fill([
            'lession_name' => $request->post('lession_name'),
            'slug'          => $lession::getSlug($request->post('lession_name')),
            'sort_by'       => $lession::getOrder($chapter),
            'intro_text'    => $request->post('intro_text'),
            'short_description' => $request->post('short_description'),
            'full_description'  => $request->post('full_description'),
            'active'            => $request->has('active')  ? true : false,
            'enable_youtube'    => $request->has('enable_youtube_video') ? true : false,
            'enable_vimeo'    => $request->has('enable_vimeo_video') ? true : false,
            'enable_preview'    => $request->has('enable_preview') ? true : false,
            'total_duration'    => $request->post('total_duration')
        ]);

        if ($request->has('enable_vimeo_video') && $request->post('vimeo_url')) {
            $queryParam = parse_url($request->post('vimeo_url'));
            $vimeoContent = [
                'link'  => $request->post('vimeo_url'),
                'query' => $queryParam,
                'id'    => str_replace('/', '', $queryParam['path'])
            ];
            $lession->vimeo = $vimeoContent;
        }

        if ($request->has('enable_youtube_video') && $request->post('youtube_url')) {
            $queryParam = parse_url($request->post('youtube_url'));
            parse_str($queryParam['query'], $output);

            $youtubeContent = [
                'link'  => $request->post('youtube_url'),
                'query' => $queryParam['query'],
                'id'    => $output['v']
            ];
            $lession->youtube = $youtubeContent;
        }

        if ($request->has('enable_preview') && $request->post('preview_url') && \Illuminate\Support\Str::contains($request->post('preview_url'), 'vimeo.com')) {
            $queryParam = parse_url($request->post('preview_url'));
            $vimeoContent = [
                'link'  => $request->post('preview_url'),
                'query' => $queryParam,
                'id'    => str_replace('/', '', $queryParam['path'])
            ];

            $lession->intro_video = $vimeoContent;
        }

        if ($course) {
            $lession->course_id = $course->getKey();
        }

        if ($chapter) {
            $lession->chapter_id = $chapter->getKey();
        }

        if ($request->has('course') && $request->post('course')) {
            $lession->course_id = $request->post('course');
        }

        if ($request->has('chapter') && $request->post('chapter')) {
            $lession->chapter_id = $request->post('chapter');
        }

        try {
            $lession->save();
        } catch (\Throwable $th) {
            //throw $th;
            return $this->json(false, 'Unable to add new lession', '', ['errors' => $th->getMessage()]);
        }

        $location = route('admin.lessions.edit', ['lession' => $lession, 'current_tab' => 'general', 'chapter' => $chapter, 'course' => $course]);
        return $this->json(true, 'New Lession created.', 'redirect', ['location' => $location]);
    }

    public function edit(Request $request, Lession $lession, $current_tab = null, Chapter $chapter = null, Course $course = null)
    {

        if ($request->post()) {
            return $this->update($request, $lession);
        }
        $lession->load(['getImage' => fn ($query) => $query->with('image'), 'getSeo', 'getComponents']);
        $tabs = [
            'general'   => $lession,
            'media'     => $lession->getImage,
            'seo'       => $lession->getSeo,
            'components'    => $lession->getComponents
        ];

        if ($lession->getComponents->count()) {
            $tabs['component_management'] = ['positions' => ['top', 'bottom', 'left', 'right']];
        }

        $current_tab = !($current_tab) || !in_array($current_tab, array_keys($tabs)) ? 'general' : $current_tab;

        return $this->admin_theme(
            'lessions.edit',
            [
                'tabs' => $tabs,
                'lession' => $lession,
                'current_tab' => $current_tab,
                'chapter' => $chapter,
                'course' => $course
            ]
        );
    }


    public function update(Request $request, Lession $lession)
    {
        $lession->fill([
            'lession_name' => $request->post('lession_name'),
            'slug'          => $lession::getSlug($request->post('lession_name')),
            'sort_by'       => $lession::getOrder($lession->getChapter),
            'intro_text'    => $request->post('intro_text'),
            'short_description' => $request->post('short_description'),
            'full_description'  => $request->post('full_description'),
            'active'            => $request->has('active')  ? true : false,
            'enable_youtube'    => $request->has('enable_youtube_video') ? true : false,
            'enable_vimeo'    => $request->has('enable_vimeo_video') ? true : false,
            'enable_preview'    => $request->has('enable_preview') ? true : false,
            'total_duration'    => $request->post('total_duration')
        ]);
        if ($request->has('enable_vimeo_video') && $request->post('vimeo_url')) {
            $queryParam = parse_url($request->post('vimeo_url'));
            $vimeoContent = [
                'link'  => $request->post('vimeo_url'),
                'query' => $queryParam,
                'id'    => str_replace('/', '', $queryParam['path'])
            ];
            $lession->vimeo = $vimeoContent;
        }

        if ($request->has('enable_youtube_video') && $request->post('youtube_url')) {
            $queryParam = parse_url($request->post('youtube_url'));
            parse_str($queryParam['query'], $output);

            $youtubeContent = [
                'link'  => $request->post('youtube_url'),
                'query' => $queryParam['query'],
                'id'    => $output['v']
            ];
            $lession->youtube = $youtubeContent;
        }

        if ($request->has('enable_preview') && $request->post('preview_url') && \Illuminate\Support\Str::contains($request->post('preview_url'), 'vimeo.com')) {
            $queryParam = parse_url($request->post('preview_url'));
            $vimeoContent = [
                'link'  => $request->post('preview_url'),
                'query' => $queryParam,
                'id'    => str_replace('/', '', $queryParam['path'])
            ];

            $lession->intro_video = $vimeoContent;
        }

        if ($request->has('course') && $request->post('course')) {
            $lession->course_id = $request->post('course');
        }

        if ($request->has('chapter') && $request->post('chapter')) {
            $lession->chapter_id = $request->post('chapter');
        }

        try {
            $lession->save();
        } catch (\Throwable $th) {
            //throw $th;
            return $this->json(false, 'Unable to update information.', '', ['errors' => $th->getMessage()]);
        }
        return $this->json(true, 'Information Updated.', '');
    }

    public function delete(Request $request, Lession $lession)
    {
        if (!$lession->delete()) {
            return $this->json(false, 'Unable to remove lession');
        }

        return $this->json(true, 'Lession deleted.', 'reload');
    }
}
