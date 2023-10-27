<?php

namespace App\Plugins\Maintanance\Http\Controllers;

use App\Classes\Helpers\FileUpload;
use App\Classes\Plugins\Hook;
use App\Http\Controllers\Controller;
use App\Plugins\Maintanance\Http\Models\MaintenanaceMode;
use App\Plugins\Maintanance\Http\Models\MaintenanaceModeButtons;
use Illuminate\Http\Request;

class MaintenanceModeController extends Controller
{
    public $plugin_name = 'Maintanance';

    public function __construct()
    {
        app('hooks')->registerHooks('seo.edit', new Hook('bundle.seo.tab', function () {
            return  [
                'name' => __('admin/posts/edit.seo'),
                'view'  => 'backend.seo.add',
                'data'  => ['modelVar' => 'model', 'modelVar2' => 'seo']
            ];
        }));

        app('hooks')->registerHooks('image.image-edit', new Hook('bundle.image.tab', function () {
            return  [
                'name' => __('admin/posts/edit.media'),
                'view'  => 'backend.media.list',
                'data'  => ['modelVar' => 'model', 'modelVar2' => 'content']
            ];
        }));
        app('hooks')->registerHooks('components-component-edit', new Hook('bundle.component.tab', function () {
            return  [
                'name' => __('admin/posts/edit.component'),
                'view'  => 'themes.components.choices',
                'data'  => ['modelVar' => 'model']
            ];
        }));
    }

    public  function index(){
        return $this->admin_theme('maintenance-mode.index');
    }

    public function create(Request $request) {
        $maintenanceMode = new MaintenanaceMode();
        $maintenanceMode->fill([
            'mode_name' => $request->post('name'),
            'slug'  => $maintenanceMode::getSlug($request->post('name')),
            'active' => false,
            'background_color'  => $request->post('background_color'),
        ]);

        if ( ! $maintenanceMode->save() ) {
            return back();
        }

        return redirect()->route('admin.maintenance.edit',['mode' => $maintenanceMode]);
    }

    public function edit(MaintenanaceMode $mode, $current_tab = 'general') {
        $mode->load(['getSeo', 'getImage' => fn ($query) => $query->with('image'),'buttons']);
        $tabs = [
            'general' => $mode,
            'buttons'   => $mode->buttons
        ];
        $tabs = array_merge($tabs,app('hooks')->catchHooks('bundle.image.tab', []), app('hooks')
            ->catchHooks('bundle.seo.tab', []), app('hooks')->catchHooks('bundle.component.tab',[]));
        return $this->admin_theme('maintenance-mode.edit',['mode' => $mode,'current_tab' => $current_tab,'tabs' => $tabs]);
    }

    public function update(Request $request, MaintenanaceMode $mode) {
        $request->validate([
            'mode_name' => 'required',
            'slug'  => 'required',
        ]);

        $mode->fill($request->except('_token'));
        $mode->slug = $mode::getSlug($request->post('slug'),$mode);
        $mode->active = $request->post('active') ? true : false;
        if (! $mode->save() ) {
            return $this->json(false,'Unable to update Information');
        }
        return $this->json(true,'Information Updated.');
    }

    public function delete() {

    }

    /** button ACTION */
    public function list_buttons(MaintenanaceMode $mode) {

    }

    public function storeButtons(MaintenanaceMode $mode) {
        $request = Request::capture();
        $request->validate([
            'title' => 'button_title',
            'button_label'  => 'required',
            'response_type' => 'required',
            'response_value'    => 'required'
        ]);
        $response_value = $request->post('response_value');
        $button = new MaintenanaceModeButtons();
        $button->fill([
            'title'  => $request->post('button_title'),
            'description'   => $request->post('button_description'),
            'maintenance_mode' => $mode->getKey(),
            'button_label' => $request->post('button_label'),
            'response_type' => $request->post('response_type'),
            'button_response' => $response_value ?? '-'
        ]);

        if (! $button->save() ) {
            return $this->json(false,'Unble to udpate');
        }

        if ($request->post('response_type') != 'link' && $request->file('response_value')) {
            $uploadFile = FileUpload::upload($request->file('response_value'),$button);
            if(isset($uploadFile[0]['file'])) {
                $button->button_response = $uploadFile[0]['file']->filepath;
                $button->save();
            }
        }

        return $this->json(true,'Information Updated.','reload');
    }

    public function editButtons(MaintenanceMode $mode, MaintenanaceModeButtons $button) {

    }

    public function deleteButton(MaintenanaceModeButtons $button) {
        $button->delete();
        return $this->json(true,'Button removed','reload');
    }
}
