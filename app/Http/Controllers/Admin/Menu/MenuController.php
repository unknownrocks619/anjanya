<?php

namespace App\Http\Controllers\Admin\Menu;

use App\Classes\Helpers\Image;
use App\Classes\Plugins\Hook;
use App\Http\Controllers\Controller;
use App\Models\Connector;
use App\Models\FileRelation;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class MenuController extends Controller
{
    //

    public function __construct()
    {
        app('hooks')->registerHooks('components-component-edit', new Hook('bundle.component.tab', function () {
            return  [
                'name' => __('admin/menu/edit.component'),
                'view'  => 'themes.components.choices',
                'data'  => ['modelVar' => 'model']
            ];
        }));

        app('hooks')->registerHooks('components-component-management', new Hook('bundle.component.tab-management', function () {
            return  [
                'name' => 'Component Management',
                'view'  => 'backend.component-widget.add',
                'data'  => ['modelVar' => 'model']
            ];
        }));
    }

    public function index()
    {
        $menus = Menu::where('parent_id', NULL)
            ->with(['children' => fn ($query) => $query->with('children')])
            ->orWhere('parent_id', '0')
            ->orderBy('sort_by', 'asc')
            ->get();

        return $this->admin_theme('menu.list', ['menus' => $menus]);
    }

    public function create(Request $request)
    {
        if ($request->post()) {
            return $this->store($request);
        }

        return $this->admin_theme('menu.add');
    }


    public function store(Request $request)
    {
        $request->validate([
            'menu_name' => 'required',
            'menu_type' => 'required|in:' . implode(',', array_keys(Menu::MENU_TYPES)),
            'menu_position'      => 'required|in:' . implode(',', array_keys(Menu::MENU_POSITIONS))
        ]);

        $menu = new Menu();
        $menu->fill([
            'menu_name' => $request->post('menu_name'),
            'slug'      => Menu::getSlug($request->post('menu_name')),
            'menu_type' => $request->post('menu_type'),
            'menu_position' => $request->post('menu_position'),
            'active'        => $request->has('active') ? true : false,
            'description'   => $request->post('description'),
            'parent_id'     => $request->post('parent_menu'),
            'sort_by'       => Menu::getSortOrder($request->post('parent_menu'))
        ]);

        if(env('APP_THEMES') == 'siddhamahayog') {
            $menu->glitter_background = $request->post('glitter_background');
        }

        try {
            $menu->save();
        } catch (\Throwable $th) {
            return $this->json(false, 'Unable to save menu.', '', ['error' => $th->getMessage()]);
        }

        return $this->json(true, 'Menu Created.', 'redirect', ['location' => route('admin.menu.edit', ['menu' => $menu])]);
    }

    public function menu_json(Menu $selectionMenu = null)
    {
        $menus = Menu::with(['parent' => fn ($query) => $query->with('parent')])
            ->orderBy('sort_by', 'asc')
            ->get();

        $result = [];

        foreach ($menus as $menu) {
            $innerArray = [];

            $text = $menu->menu_name;

            if (!is_null($menu->parent)) {
                $text = '-- ' . $menu->menu_name . " ( Parent: {$menu->parent->menu_name})";
            }

            $innerArray = [
                'id' => $menu->getKey(),
                'text'  => $text,
                'selected'  => ($selectionMenu && $selectionMenu->getKey() == $menu->getKey()) ? true  : false
            ];

            $result[] = $innerArray;
        }

        $result['results'] = $result;

        return response($result, 200);
    }

    public function edit(Menu $menu, $current_tab = null)
    {

        $menu->load(['getSeo', 'getImage' => fn ($query) => $query->with('image')]);

        $tabs = [
            'general'   => $menu,
            'media'     => $menu->getImage,
            'seo'       => $menu->getSeo,
        ];
        $tabs = array_merge($tabs, app('hooks')->catchHooks('bundle.component.tab', []));
        $tabs = array_merge($tabs, app('hooks')->catchHooks('bundle.component.tab-management', []));
        if ($menu->menu_type == 'page') {
            $tabs['page'] = $menu->pages;
        }

        if ($menu->menu_type == 'category') {
            $tabs['category'] = $menu->categories;
        }
        $current_tab = ($current_tab && in_array($current_tab, array_keys($tabs))) ? $current_tab : 'general';
        return $this->admin_theme('menu.edit', ['tabs' => $tabs, 'current_tab' => $current_tab, 'menu' => $menu]);
    }

    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'menu_name' => 'required',
            'menu_type' => 'required|in:' . implode(',', array_keys(Menu::MENU_TYPES)),
            'menu_position'      => 'required|in:' . implode(',', array_keys(Menu::MENU_POSITIONS))
        ]);

        $menu->slug = $request->post('slug');
        $menu->description = $request->post('description');
        $menu->menu_type = $request->post('menu_type');
        $menu->menu_position = $request->post('menu_position');
        $menu->active = $request->has('active') ? true : false;
        $menu->parent_id = $request->post('parent_menu');
        $menu->menu_name  = $request->post('menu_name');

        if(env('APP_THEMES') == 'siddhamahayog') {
            $menu->glitter_background = $request->post('glitter_background');
        }


        if ($menu->isDirty('slug')) {
            $menu->slug = Menu::getSlug($request->post('slug'), $menu);
        }

        try {
            $menu->save();
        } catch (\Throwable $th) {
            //throw $th;
            return $this->json(false, 'Unable to update menu information.', null, ['error' => $th->getMessage()]);
        }

        return $this->json(true, 'Menu Information Updated.');
    }

    public function uploadImage(Request $request, Menu $menu)
    {
        $uploadImage = Image::uploadImage($request->file('file'), $menu);

        if (!$uploadImage) {
            return $this->json(false, 'Unabel to upload file.');
        }

        return $this->json(true, 'Image Uploaded.', 'redirect', ['location' => route('admin.menu.edit', ['menu' => $menu, 'current_tab' => 'media'])]);
    }

    public function update_image_relation(Request $request, Menu $menu, FileRelation $image_relation)
    {
        $image_relation->type = $request->record ?? null;
        if (!$image_relation->save()) {
            return $this->json(false, 'Unable to update Image Type.');
        }

        return $this->json(true, 'File Type Updated.');
    }

    public function remove_image(Menu $menu, Filerelation $image_relation, $current_tab = null)
    {
        if (!$image_relation->delete()) {
            return $this->json(false, 'Unable to remove file.');
        }
        return $this->json(true, 'File removed.', 'redirect', ['location' => route('admin.menu.edit', ['menu' => $menu, 'current_tab' => 'media'])]);
    }

    public function connectPage(Request $request, Menu $menu, $current_tab = null)
    {
        $request->validate([
            'model' => 'required',
            'model_id'  => 'required'
        ]);

        $connector = new Connector();
        $connector->fill([
            'connector_class' => Menu::class,
            'connector_id'  => $menu->getKey(),
            'connected_class'   => $request->post('model'),
            'connected_id'      => $request->poset('model_id')
        ]);

        try {
            $connector->save();
        } catch (\Throwable $th) {
            //throw $th;
            return $this->json(false, 'Unable to Connect with component.');
        }

        return $this->json(true, 'Component Connected.', 'redirect', ['location' => route('admin.menu.edit', ['menu' => $menu, 'current_tab' => $current_tab])]);
    }

    public function reorder(Request $request, Menu $menu = null)
    {
        $allProducts = array_keys($request->all());
        if (!$menu) {
            $menus = Menu::whereIn('id', $allProducts)->get();
        } else {
            $menus = Menu::whereIn('id', $allProducts)->where('parent_id', $menu->getKey())->get();
        }

        foreach ($menus as $menu_loop) {
            $menu_loop->sort_by = $request->post($menu_loop->getKey());
            $menu_loop->save();
        }
        $menu = 1;
        return $this->json(true, 'Re-order success', is_null($menu) ? 'reload' : '');
    }

    public function delete(Menu $menu)
    {
        if (!$menu->delete()) {
            return $this->json(false, 'Unable to delete menu.');
        }

        $menu->children()->update(['parent_id' => null]);

        return $this->json(true, 'Menu Deleted.', 'reload');
    }



    public function clearCache()
    {
        Artisan::call('cache:clear');

        return $this->json(true, 'Cache Successfully Cleard.');
    }
}
