<?php

namespace App\Classes\Helpers;

use App\Http\Controllers\Controller;
use App\Models\ComponentBuilder;
use Illuminate\Http\Request;

class Components extends Controller
{


    const TYPES = [
        'overlay_video'     => 'OverlayVideo',
        'overlay_image'     => 'OverlayImage',
        'slider'            => 'Slider',
        'gallery'           => 'Gallery',
        'video_checklist'      => 'VideoChecklist',
        // 'background_video'  => 'BackgroundVideo',
        'lms_resource'      => 'LearningResourceModule',
        // 'background_color'  => 'BackgroundColor',
        'heading_text'      => 'HeadingText',
        // 'text'              => "Text",
        'paragraph'         => 'Paragraph',
        'content'           => 'Content',
        'button'            => 'Button',
        'block'             => 'Block',
        'card'              => 'Card',
        'project_list'      => 'ProjectList',
        'icon_column'       => 'IconColumn',
        'quotes'            => 'Quotes',
        'image'            => 'Image',
        'faq'               => 'Faq',
        'iframe'            => 'Iframe',
        'contact_form'      => 'ContactForm'
    ];

    public function getComponentList(Request $request)
    {

        return view('themes.components.modal.list', ['options' => array_keys(self::TYPES)]);
    }

    public function renderElement(Request $request)
    {
        $view = view("themes.components.{$request->post('component_key')}.view.create")->render();
        return $this->json(true, 'Completed Loaded', 'componentRenderElement', ['view' => $view, 'current_component' => $request->post('component_key')]);
    }

    public function save(Request $request)
    {
        $name = self::TYPES[$request->post('component')];
        $helperClass = "App\Classes\Helpers\\$name\\$name";
        try {
            $helperClass::save($request);
        } catch (\Throwable $th) {
            //throw $th;
            return $this->json(false, 'Unable to insert component', '', ['errors' => $th->getMessage()]);
        }

        return $this->json(true, 'Component Created.', 'reload');
    }

    public function update(Request $request, ComponentBuilder $componentBuilder)
    {
        $name = self::TYPES[$request->post('component')];
        $helperClass = "App\Classes\Helpers\\$name\\$name";
        try {
            $helperClass::update($request, $componentBuilder);
        } catch (\Throwable $th) {
            //throw $th;
            return $this->json(false, 'Unable to update component', '', ['errors' => $th->getMessage()]);
        }

        return $this->json(true, 'Component Updated.', 'reload');
    }

    public function delete(Request $request, ComponentBuilder $componentBuilder)
    {

        if (!$componentBuilder->delete()) {
            return $this->json(false, 'Unable to delete Component');
        }

        return $this->json(true, 'Component Deleted.', 'reload');
    }

    public function removeElement(Request $request, ComponentBuilder $componentBuilder, $index = null)
    {

        if ($componentBuilder->component_type == 'gallery') {
            $componentBuilderValues = json_decode($componentBuilder->values);
            $finalGallery = [];

            foreach ($componentBuilderValues->gallery as $key => $gallery) {
                if ($key == $index) {
                    continue;
                }
                $finalGallery[] = $gallery;
            }


            $componentBuilderValues->gallery =  $finalGallery;
            try {
                $componentBuilder->values = json_encode($componentBuilderValues);
                $componentBuilder->save();
            } catch (\Throwable $th) {
                //throw $th;
                return $this->json(false, 'Unable to update component.');
            }
        } else {
            $componentBuilder->getImage()->delete();
        }

        return $this->json(true, 'Component Updated.');
    }

    public function removeCardMedia(Request $request, ComponentBuilder $componentBuilder, $cardIndex = null)
    {
        $values  = json_decode($componentBuilder->values);
        dd($values['card_content'][$cardIndex]['media']);
    }

    public function update_position(Request $request, ComponentBuilder $componentBuilder)
    {
        $componentBuilder->display_location = $request->post('widgets');
        if (!$componentBuilder->save()) {
            return $this->json(false, 'Unable to update position');
        }
        return $this->json(true, 'Position updated.');
    }

    public function renameComponent(Request $request, ComponentBuilder $componentBuilder)
    {

        $componentBuilder->component_name = $request->post('name');
        $componentBuilder->active = (int)$request->post('active_component_status') ? true : false;

        if ($componentBuilder->isDirty('component_name') || $componentBuilder->isDirty('active')) {
            $componentBuilder->save();
            return $this->json(true, 'Component Name Updated.');
        }
    }
}
