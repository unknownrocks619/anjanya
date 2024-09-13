<?php

namespace App\Http\Controllers\Admin\Page;

use App\Classes\Components\Component;
use App\Classes\Components\Http\Controllers\ComponentController;
use App\Classes\Helpers\Components;
use App\Classes\Helpers\Image;
use App\Http\Controllers\Admin\Component\ComponentController as ComponentComponentController;
use App\Http\Controllers\Controller;
use App\Models\FileRelation;
use App\Models\Page;
use App\Models\WebComponents;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PageController extends Controller
{
    //

    public function index(Request $request)
    {
        $pagesQuery = Page::query();
        if ($request->get('search')) {
            $pagesQuery->where('title', 'LIKE', '%' . $request->get('search') . '%');
            $pagesQuery->orWhere('created_at', 'LIKE', '%' . $request->get('search') . '%');

            if (strtolower($request->get('search')) == 'active') {
                $pagesQuery->orWhere('active', 1);
            }
            if (strtolower($request->get('search')) == 'inactive') {
                $pagesQuery->orWhere('active', 0);
            }
        }
        $pages = $pagesQuery->paginate(15);
        return $this->admin_theme('pages/list', ['pages' => $pages]);
    }

    public function store(Request $request)
    {
        $request->validate(['page_title' => 'required']);

        if (Page::where('slug', Str::slug($request->post('page_title')))->exists()) {
            return $this->json(false, 'Page Title Already Exists.');
        }

        $page = new Page();

        $page->fill(
            [
                'title' => $request->post('page_title'),
                'slug'  => Str::slug($request->post('page_title')),
                'active' => false
            ]
        );

        try {
            DB::transaction(function () use ($page, $request) {
                $page->save();

                /**
                 * Insert Component.
                 */
                $component = new WebComponents();
                $component->fill([
                    'component_name' => 'Page::' . $page->slug . '-' . $page->getKey(),
                    'active' => true
                ]);
                $component->save();

                /**
                 * Attach Component to page.
                 */
                $componentConnectRequest = new Request([
                    '_model' => $page::class,
                    '_modelID'  => $page->getKey(),
                    'web_component_enable' => [$component->getKey() => $component->getKey()]
                ], [
                    '_model' => $page::class,
                    '_modelID'  => $page->getKey(),
                    'web_component_enable' => [$component->getKey() => $component->getKey()]
                ]);
                (new Components())->renderElement($componentConnectRequest);
            });
            // not just page, also create a component and attach it with current page.


        } catch (\Throwable $th) {
            //throw $th;
            return $this->json(false, 'Unable to save page.');
        }

        return $this->json(true, 'New Page created.', 'redirect', ['location' => route('admin.pages.edit', ['page' => $page])]);
    }

    public function update(Request $request, Page $page)
    {
        $page->title = $request->post('page_title');
        $page->slug = $request->post('slug');


        if (empty($page->slug)) {
            $page->slug = Str::slug($page->title);
        }

        if ($page->isDirty('slug')) {
            $page->slug = $page::getSlug($page->slug, $page);
        }

        $page->intro_text = $request->post('intro_text');
        $page->short_description = $request->post('short_description');
        $page->full_description = $request->post('full_description');
        $page->active = $request->has('active') ? true : false;

        if (env('APP_THEMES') == 'siddhamahayog') {
            $page->glitter_background = $request->post('glitter_background');
        }

        try {
            $page->save();
        } catch (\Throwable $th) {
            //throw $th;
            return $this->json(false, 'Unable to update page.', '', ['errors' => $th->getMessage()]);
        }

        return $this->json(true, 'Page Updated.');
    }

    public function edit(Request $request, Page $page, $current_tab = null)
    {
        // $page->load(['getSeo', 'getImage' => fn ($query) => $query->with('image')]);
        $tabs = [
            'general'       => $page,
            'media'         => $page->getImage,
            'seo'           => $page->getSeo,
            'components'    => []
        ];

        $current_tab = ($current_tab && in_array($current_tab, array_keys($tabs))) ? $current_tab : 'general';

        return $this->admin_theme('pages.edit', ['tabs' => $tabs, 'page' => $page, 'current_tab' => $current_tab]);
    }

    public function uploadImage(Request $request, Page $page)
    {
        $uploadImage = Image::uploadImage($request->file('file'), $page);

        if (!$uploadImage) {
            return $this->json(false, 'Unabel to upload file.');
        }

        return $this->json(true, 'Image Uploaded.', 'redirect', ['location' => route('admin.pages.edit', ['page' => $page, 'current_tab' => 'media'])]);
    }

    public function update_image_relation(Request $request, Page $page, FileRelation $image_relation)
    {
        $image_relation->type = $request->record ?? null;
        if (!$image_relation->save()) {
            return $this->json(false, 'Unable to update Image Type.');
        }

        return $this->json(true, 'File Type Updated.');
    }

    public function remove_image(Page $page, FileRelation $image_relation, $current_tab = null)
    {
        if (!$image_relation->delete()) {
            return $this->json(false, 'Unable to remove file.');
        }
        return $this->json(true, 'File removed.', 'redirect', ['location' => route('admin.pages.edit', ['page' => $page, 'current_tab' => 'media'])]);
    }

    public function delete(Page $page)
    {

        try {
            $webComponent = WebComponents::where('component_name', 'Page::' . $page->slug . '-' . $page->getKey())->first();

            if ($webComponent) {
                (new ComponentComponentController())->deleteCommonComponent(request(), $webComponent);
            }
            $page->delete();
        } catch (\Throwable $th) {
            //throw $th;
            dd($th->getMessage());
            return $this->json(false, 'Unable to delete page.');
        }
        return $this->json(true, 'Page Deleted.', 'reload');
    }
}
