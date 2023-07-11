<?php

namespace App\Http\Controllers\Admin\Courses;

use App\Classes\Helpers\Video;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lession;
use Illuminate\Http\Request;

class CoursesController extends Controller
{
    //
    public function index(Request $request)
    {
        if ($request->post()) {
            return $this->store($request);
        }

        $courses = Course::withCount(['chapters', 'lessions'])->orderBy('sort_by', 'asc')->get();
        return $this->admin_theme('courses.index', ['courses' => $courses]);
    }

    public function create()
    {
    }

    public function edit(Request $request, Course $course, $current_tab = 'general')
    {

        if ($request->post() && $request->ajax()) {
            return $this->update($request, $course);
        }

        $course->load(['chapters', 'getSeo', 'getImage', 'getComponents']);
        $tabs = [
            'general'           => $course,
            'media'             => $course->getImage,
            'seo'               => $course->getSeo,
            'permission'        => $course,
            'chapters'          => $course->chapters,
            'components'        => $course->getComponents
        ];


        if ($course->enable_intro_video) {
            $tabs['intro_video'] = $course;
        }

        return $this->admin_theme('courses.edit', ['tabs' => $tabs, 'course' => $course, 'current_tab' => $current_tab]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_name'
        ]);

        $course = new Course();
        $course->fill([
            'course_name'   => $request->post('course_name'),
            'slug'          => $course::getSlug($request->post('course_name')),
            'active'        => false,
            'sort_by'       => $course::getSortBy()
        ]);

        try {
            $course->save();
        } catch (\Throwable $th) {
            //throw $th;
            return $this->json(false, 'Unable to create course.', '', ['errors' => $th->getMessage()]);
        }

        return $this->json(true, 'New Courses created.', 'redirect', ['location' => route('admin.courses.edit', ['course' => $course])]);
    }

    public function update(Request $request, Course $course)
    {
        $course->course_name = $request->post('course_name');
        $course->slug = $request->post('slug');
        $course->course_intro_text = $request->post('intro_text');
        $course->course_short_description = $request->post('short_description');
        $course->course_full_description = $request->post('full_description');
        $course->active = $request->has('active') ? true : false;
        $course->enable_intro_video = $request->has('intro_video') ? true : false;
        $course->theme_color = $request->post('theme_color');
        $course->tagline = $request->post('tag_line');


        try {
            $course->save();
        } catch (\Throwable $th) {
            //throw $th;
            return $this->json(false, 'Unable to update course.');
        }

        return $this->json(true, 'Course updated.', 'redirect', ['location' => route('admin.courses.edit', ['course' => $course, 'current_tab' => 'general'])]);
    }

    public function intro_video(Request $request, Course $course)
    {

        $intro_video = [
            'video_type' => $request->post('intro_video'),
            'video' => []
        ];
        $videos = null;

        if ($request->post('intro_video') == 'file' &&  $request->has('file')) {

            $videos = Video::storeVideo($request->file('file'));
            $introVideo = [];
            foreach ($videos as $key => ['video' => $video]) {
                $introVideo[] = $video->getKey();
            }

            $intro_video['video'] = $introVideo;
        }

        if ($request->post('intro_video') == 'youtube') {

            $queryParam = parse_url($request->post('youtube'));
            parse_str($queryParam['query'], $output);

            $youtubeContent = [
                'link'  => $request->post('intro_video'),
                'query' => $queryParam['query'],
                'id'    => $output['v']
            ];
            $intro_video['video'] = $youtubeContent;
        }

        if ($request->post('intro_video') == 'vimeo') {

            $queryParam = parse_url($request->post('vimeo'));
            $youtubeContent = [
                'link'  => $request->post('intro_video'),
                'query' => $queryParam,
                'id'    => str_replace('/', '', $queryParam['path'])
            ];
            $intro_video['video'] = $youtubeContent;
        }

        if ($request->post('intro_video') == 'lessions') {

            $lession = Lession::find($request->post('lessions'));
            $intro_video['video'] = $lession->toArray();
        }

        $course->intro_video = $intro_video;

        if (!$course->save()) {
            return $this->json(false, 'Unable to update intro video.');
        }

        return $this->json(true, 'Intro Video Updated.', 'redirect', ['location' => route('admin.courses.edit', ['course' => $course, 'current_tab' => 'intro_video'])]);
    }


    public function remove_video(Course $course)
    {
        $course->intro_video = null;
        $course->enable_intro_video = false;

        if (!$course->save()) {
            return $this->json(false, 'Unable to update course intro video.');
        }

        return $this->json(true, 'Course intro video updated.');
    }
    public function delete(Request $request, Course $course)
    {
        if (!$course->delete()) {
            return $this->json(false, 'Unable to remove Course');
        }
        $course->chapters()->update(['course_id' => 0]);
        $course->lessions()->update(['course_id' => 0]);
        return $this->json(true, 'Course Deleted.', 'reload');
    }
}
