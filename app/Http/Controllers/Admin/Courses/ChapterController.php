<?php

namespace App\Http\Controllers\Admin\Courses;

use App\Http\Controllers\Controller;
use App\Models\Chapter;
use App\Models\Course;
use Illuminate\Http\Request;

class ChapterController extends Controller
{
    //
    public function index()
    {
        $chapters = Chapter::with(['getCourse'])->get();
        return $this->admin_theme('chapters.index', ['chapters' => $chapters]);
    }
    public function create(Request $request, $current_tab = null, Course $course = null)
    {

        if ($request->ajax() && $request->post()) {
            return $this->store($request, $current_tab, $course);
        }

        return $this->admin_theme('chapters.add', ['current_tab' => $current_tab, 'course' => $course]);
    }

    public function store(Request $request, $current_tab = null, Course $course = null)
    {
        $request->validate(
            ['chapter_name' => 'required']
        );

        $chapters = new Chapter();
        $chapters->fill([
            'chapter_name'      => $request->post('chapter_name'),
            'slug'              => $chapters::getSlug($request->post('chapter_name')),
            'sort_by'           => $chapters::getSort($course),
            'intro_text'        => $request->post('intro_text'),
            'short_description' => $request->post('short_description'),
            'full_description'  => $request->post('full_description'),
            'active'            => $request->has('active') ? true : false
        ]);


        if ($course) {
            $chapters->course_id = $course->getKey();
        }


        if ($request->has('course')) {
            $chapters->course_id = $request->post('course');
        }

        try {
            $chapters->save();
        } catch (\Throwable $th) {
            return $this->json(false, 'Unable to create Chapter', '', ['errors' => $th->getMessage()]);
        }

        return $this->json(true, 'New Chapter Created.', 'redirect', ['location' => route('admin.chapters.edit', ['chapter' => $chapters, 'current_tab' => 'general', 'course' => $course])]);
    }

    public function edit(Request $request, Chapter $chapter, $current_tab = null, Course $course = null)
    {

        if ($request->post()) {
            return $this->update($request, $chapter, $course);
        }

        $chapter->load(['getSeo', 'getImage', 'lessions']);
        $tabs = [
            'general'   => $chapter,
            'media'     => $chapter->getImage,
            'seo'       => $chapter->getSeo,
            'lessions'  => $chapter->lessions
        ];
        return $this->admin_theme('chapters.edit', ['chapter' => $chapter, 'course' => $course, 'tabs' => $tabs, 'current_tab' => $current_tab]);
    }

    public function update(Request $request, Chapter $chapter, Course $course = null)
    {
        $chapter->fill([
            'chapter_name'      => $request->post('chapter_name'),
            'slug'              => $chapter::getSlug($request->post('chapter_name'), $chapter),
            'intro_text'        => $request->post('intro_text'),
            'short_description' => $request->post('short_description'),
            'full_description'  => $request->post('full_description'),
            'active'            => $request->has('active') ? true : false
        ]);

        if ($course) {
            $chapter->course_id = $course->getKey();
        }

        if ($request->has('course')) {
            $chapter->course_id = $request->post('course');
        }

        try {
            $chapter->save();
        } catch (\Throwable $th) {
            //throw $th;
            return $this->json(false, 'Unable to update information.', '', ['errors' => $th->getMessage()]);
        }

        return $this->json(true, 'Information updated.');
    }

    public function delete(Request $request, Chapter $chapter)
    {

        if (!$chapter->delete()) {
            return $this->json(false, 'Unable to delete chapter.');
        }
        $chapter->lessions()->update(['chapter_id' => 0]);
        return $this->json(true, 'Chapter Deleted.', 'reload');
    }
}
