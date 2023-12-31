<?php

namespace App\Themes\nature\Components;

use App\Classes\Components\Services\BaseComponent;
use App\Classes\Components\Services\ComponentInterface;
use App\Classes\Components\Services\Image\Image;
use App\Models\ComponentBuilder;
use Illuminate\Http\Request;

class BackgroundImage extends BaseComponent implements ComponentInterface
{

    protected $_component_name='background_image';

    public function uploadMedia() {
        $request = Request::capture();
        $image = \App\Classes\Helpers\Image::uploadOnly($request->file('image'));


        $source = str($request->post('name'))->before('_')->value();
        if (! $image ) {
            return $this->json(false,'Unable to upload image.','clearImage',['source' => $source]);
        }
        return $this->json(true,'Image upload','',['source' => $source,'image' => \App\Classes\Helpers\Image::getImageAsSize($image[0]->filepath,'m')]);

    }
    public function store($componentBinder)
    {
        $request = Request::capture();
        $componentBuilder = new ComponentBuilder();
        $componentBuilder->fill([
            'component_name'    => __('components.'.$this->_component_name),
            'component_type'    => $this->_component_name,
            'sort'              => ComponentBuilder::getSortBy($componentBinder),
            'active'            => true,
            'relation_model'    => $componentBinder::class,
            'relation_id'       => $componentBinder->getKey(),
            'values'            => []
        ]);
        $values = [
            'background-image' => $request->post('background_image'),
            'button_one'    => [
                'label' => $request->post('first_button_label'),
                'link'  => $request->post('first_button_link'),
            ],
            'button_two'    => [
                'label' => $request->post('second_button_label'),
                'link'  => $request->post('second_button_link')
            ],
            'description'   => $request->post('description'),
            'background-text'   => $request->post('background_text'),
            'title' => $request->post('title'),
            'underline_text'    => $request->post('underline_world'),

        ];

        $componentBuilder->values = $values;

        try {
            $componentBuilder->save();
        } catch (\Exception $e) {
            return $this->json(false,__('components._failed_save'),null,['error' => $e->getMessage()]);
        }
        return $this->json(true,__('components._success_save'),'reload');
    }

    public function update()
    {
        $request = Request::capture();
        $values = [
            'background-image' => $request->post('background_image'),
            'button_one'    => [
                'label' => $request->post('first_button_label'),
                'link'  => $request->post('first_button_link'),
            ],
            'button_two'    => [
                'label' => $request->post('second_button_label'),
                'link'  => $request->post('second_button_link')
            ],
            'description'   => $request->post('description'),
            'background-text'   => $request->post('background_text'),
            'title' => $request->post('title'),
            'underline_text'    => $request->post('underline_world'),

        ];
        $component = ComponentBuilder::find($request->post('_componentID'));

        if (! $component ) {
            return $this->json(false,'Unable to update.',null,['error'=>'component class not found.']);
        }

        $component->values = $values;

        try {
            $component->save();
        } catch (\Exception $e) {
            return $this->json(false,'Unable to update.',null,['error'=>$e->getMessage()]);
        }
        return $this->json(true,'Component Updated.','');
    }

    public function delete($component)
    {
        return $component->delete();
    }
}
