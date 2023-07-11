<?php

namespace App\Http\Controllers\Admin\Book;

use App\Classes\Plugins\Hook;
use App\Http\Controllers\Controller;
use App\Models\BookBundle;
use Illuminate\Http\Request;

class BookBundleController extends Controller
{
    //
    public function __construct()
    {
        app('hooks')->registerHooks('components.component-edit', new Hook('bundle.component.tab', function () {
            return  [
                'name' => __('admin/bundle/edit.component'),
                'view'  => 'themes.components.choices',
                'data'  => ['modelVar' => 'model']
            ];
        }));

        app('hooks')->registerHooks('seo.edit', new Hook('bundle.seo.tab', function () {
            return  [
                'name' => __('admin/bundle/edit.seo'),
                'view'  => 'backend.seo.add',
                'data'  => ['modelVar' => 'model', 'modelVar2' => 'seo']
            ];
        }));

        app('hooks')->registerHooks('image.image-edit', new Hook('bundle.image.tab', function () {
            return  [
                'name' => __('admin/bundle/edit.media'),
                'view'  => 'backend.media.list',
                'data'  => ['modelVar' => 'model', 'modelVar2' => 'content']
            ];
        }));
    }
    public function index()
    {
        $bundles = BookBundle::get();
        return $this->admin_theme('book_bundle.index', ['bundles' => $bundles]);
    }

    public function store(Request $request)
    {
        $request->validate(['bundle_name' => 'required']);

        $bundle = new BookBundle;
        $bundle->fill([
            'bundle_title'  => $request->post('bundle_name'),
            'slug'  => $bundle::getSlug($request->post('bundle_name')),
            'products'  => [],
            'categories'    => [],
            'active'    => false
        ]);

        if (!$bundle->save()) {
            return $this->json(false, 'Unable to create new bundle');
        }
        return $this->json(true, 'New Bundle created.', 'redirect', ['location' => route('admin.book.bundle.edit', ['bundle' => $bundle])]);
    }

    public function edit(Request $request, BookBundle $bundle, $current_tab = 'general')
    {

        if ($request->post()) {
            return $this->update($request, $bundle);
        }
        $tabs = [
            'general'   => $bundle
        ];
        $tabs = array_merge($tabs, app('hooks')->catchHooks('bundle.image.tab', []));
        $tabs = array_merge($tabs, app('hooks')->catchHooks('bundle.seo.tab', []));
        $tabs = array_merge($tabs, app('hooks')->catchHooks('bundle.component.tab', []));
        return $this->admin_theme('book_bundle.edit', ['tabs' => $tabs, 'current_tab' => $current_tab, 'bundle' => $bundle]);
    }


    public function update(Request $request, BookBundle $bundle)
    {
        $request->validate(
            ['title' => 'required', 'slug' => 'required']
        );
        $bundle->bundle_title = $request->post('title');
        $bundle->slug = $bundle::getSlug($request->post('slug'), $bundle);
        $bundle->intro_text = $request->post('intro_text');
        $bundle->full_description = $request->post('full_description');
        $bundle->short_description = $request->post('short_description');
        $bundle->products = $request->post('products');
        $bundle->categories = $request->post('categories');
        $bundle->active = $request->has('active') ? true : false;

        try {
            $bundle->save();
        } catch (\Throwable $th) {
            //throw $th;
            return $this->json(false, 'Unable to update information');
        }

        return $this->json(true, 'Bundle Information updated.');
    }
    public function delete(BookBundle $bundle)
    {
        $bundle->delete();

        return $this->json(true, 'Book Bundle Removed.', 'redirect', ['location' => route('admin.book.bundle.list')]);
    }
}
