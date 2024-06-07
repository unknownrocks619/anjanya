<?php

namespace App\Classes\Helpers;

use App\Classes\Components\Component;
use App\Http\Controllers\Controller;
use App\Models\CommonComponentConnector;
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
        'contact_form'      => 'ContactForm',
        'block_builder'     => 'BlockBuilder',
        'alternation'       => 'Alternation'
    ];

    public function getComponentList(Request $request)
    {
        return view('themes.components.modal.list', ['options' => array_keys(self::TYPES),'model' => $request->get('modal'),'modelID'=> $request->get('modal_id')]);
    }

    public function renderElement(Request $request)
    {
        $model = $request->post('_model');
        $relationModel = $model::find($request->post('_modelID'));
        foreach ($request->post('web_component_enable') as $componentID => $value) {
            // check if record exists.
            $connectorInstance = CommonComponentConnector::where('relation_id',$request->post('_modelID'))
                                                            ->where('relation_model', $request->post('_model'))
                                                            ->where('web_component_id', $componentID)
                                                            ->exists();
            if (! $connectorInstance ) {
                $connectorInstance = new CommonComponentConnector;
                $connectorInstance->fill([
                    'relation_id'   => $request->post('_modelID'),
                    'relation_model'    => $request->post('_model'),
                    'web_component_id'  => $componentID,
                    'sort_by'           => CommonComponentConnector::sortBy($relationModel)
                ]);
                $connectorInstance->save();
            }
        }
        $view = view("themes.components.view",['model' => $relationModel])->render();
        return $this->json(true, 'Success', 'componentRenderElement', ['view' => $view]);

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

    public function delete(Request $request, CommonComponentConnector $componentBuilder)
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

    public function renameComponent(Request $request, $componentBuilder)
    {
        $componentConnector = CommonComponentConnector::find($request->post('name'));
        $componentConnector->active = $request->post('active_component_status');

        if ($componentConnector->isDirty('active')) {
            $componentConnector->save();
            return $this->json(true,'Status updated');
        }
    }

    public function previewComponent(Request $request, string $component_name) {
        $component = new Component($component_name);
        return $component->iframeBuilder();
    }
}
