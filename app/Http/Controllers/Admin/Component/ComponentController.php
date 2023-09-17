<?php

namespace App\Http\Controllers\Admin\Component;

use App\Classes\Components\Component;
use App\Http\Controllers\Controller;
use App\Models\ComponentBuilder;
use App\Models\WebComponents;
use Illuminate\Http\Request;

class ComponentController extends Controller
{
    //
    public function index() {
        $commonComponents = WebComponents::with('getComponents')->get();
        return $this->admin_theme('component.index',['commonComponents'=>$commonComponents]);
    }

    public function builder(?ComponentBuilder $component =null,?WebComponents $webcomponent=null) {
        $request = Request::capture();
        if ($request->ajax() && $request->has('component_name')) {
            $component = new Component($request->get('component_name'));
            return $this->json(true,'Component Loaded','',['view' => $component->builder()->render()]);
        }

        if ($webcomponent && $component ) {
            return $this->admin_theme('component.edit',['component_builder' => $component,'web_component'=> $webcomponent]);
        }
        return $this->admin_theme('component.new');
    }

    public function edit(WebComponents $webcomponent) {
        $webcomponent = $webcomponent->load('getComponents');
        $request = Request::capture();
        if ($request->ajax() && $request->has('component_name')) {

            if (! $request->get('componentID') ) {
                return throw new \Error('Unable to find component.');
            }
            $componentBuilder = ComponentBuilder::find($request->get('componentID'));
            $component = new Component($request->get('component_name'));
            $component->setParams('_loadComponentBuilder', $componentBuilder)
                        ->setParams('_webComponent', $webcomponent);

            return $this->json(true,'Component Loaded','',['view' => $component->editBuilder()->render()]);
        }
        return $this->admin_theme('component.edit',['webcomponent' => $webcomponent]);
    }

    public function uploadImage(Request $request, $component_name) {

        $request->validate(['_action' => 'required|string'],['_action.required' => 'Invalid Request.']);
        $component = new Component($component_name);
        $methodName = $request->post('_action');
        return $component->loader()->$methodName();
    }

    public function save(Request $request, $component_name) {
        $request->validate([
            '_action'   => 'required'
        ],['_action' => 'Invalid Component Builder configuration.']);

        $commonComponent = null;
        if ($request->post('_source') == 'common-builder' && $request->post('_source-option') == '__new') {
            $request->validate([
                'component_name'    => 'required'
            ]);
            $commonComponent = new WebComponents();
            $commonComponent->fill([
                'component_name'   => $request->post('component_name'),
                'active'            => true
            ]);
            $commonComponent->save();
        }

        if ( $request->post('_source') == 'common-builder' && $request->post('_source-option') == '__old') {
            $commonComponent = WebComponents::find($request->post('_source-option-id'));
        }

        if (  ! $commonComponent ) {
            throw new \Error('Component Binder Not Set.');
        }

        $component = new Component($component_name);
        return $component->loader()->store($commonComponent);
    }

    public function update(Request $request, WebComponents $webcomponent) {
        $request->validate([
            '_action'   => 'required',
            '_source-option'    => 'required',
            '_source-option-id' => 'required',
        ],[
            '_action' => 'Invalid Component Builder configuration.',
            '_source-option'    => 'Invalid Component Options',
            '_source-option-id' => 'Source Configuration Missing',
        ]);

        $component = new Component($request->post('_component_name'));
        if ( ! $request->post('_componentID') ) {
            return $component->loader()->store($webcomponent);
        }
        return $component->loader()->update();
    }

    public function deleteComponent(Request $request, WebComponents $webcomponent, ComponentBuilder $componentBuilder) {

        $component = new Component($componentBuilder->component_type);
        if ( ! $component->loader()->delete($componentBuilder) ) {
            return $this->json(false,'Failed to remove.');
        }
        return $this->json(true,'Component Removed.','reload');

    }

    public function deleteCommonComponent(Request $request, WebComponents $webComponent) {
        $webComponent->getComponents()->delete();
        $webComponent->delete();
        return $this->json(true,'Component Removed.','reload');

    }
}
