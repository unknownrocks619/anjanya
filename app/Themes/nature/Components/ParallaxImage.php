<?php

namespace App\Themes\nature\Components;

use App\Classes\Components\Services\BaseComponent;
use App\Classes\Components\Services\ComponentInterface;
use App\Classes\Helpers\Image;
use App\Models\ComponentBuilder;
use Illuminate\Http\Request;

class ParallaxImage extends BaseComponent implements ComponentInterface
{
    protected $_component_type = 'parallax_image';

    public function uploadMedia() {
        $request = Request::capture();
        $image = Image::uploadOnly($request->file('image'));


        $source = str($request->post('name'))->before('_')->value();
        if (! $image ) {
            return $this->json(false,'Unable to upload image.','clearImage',['source' => $source]);
        }
        return $this->json(true,'Image upload','enablePreviewImage',['source' => $source,'image' => Image::getImageAsSize($image[0]->filepath,'m')]);
    }
    public function store($componentBinder)
    {
        $request = Request::capture();
        $componentBuilder = new ComponentBuilder();
        $componentBuilder->fill([
            'component_type'    => $this->_component_type,
            'relation_model'    => $componentBinder::class,
            'relation_id'       => $componentBinder?->getKey(),
            'active'            => false,
            'sort_by'           => ComponentBuilder::getSortBy($componentBinder),
            'component_name'    => __('components.'.$this->_component_type)
        ]);

        // build value.
        $values = [
            'subtitle'  => $request->post('subtitle'),
            'heading'   => $request->post('heading'),
            'description'   => $request->post('description'),
            'background_image'   => $request->post('background_image'),
            'position'          => $request->post('background_position'),
            'section_height'    => $request->post('section_height'),
            'container_class'   => $request->post('container_class'),
            'button_label'      => $request->post('button_label'),
            'button_link'       => $request->post('button_link')
        ];
        $componentBuilder->values = $values;
        try {
            $componentBuilder->save();
        } catch (\Exception $e) {
            return $this->json(false,__('components._failed_save'),null,['error'=>$e->getMessage()]);
        }
        return $this->json(true,__('components._success_save'),'redirect', ['location' => route('admin.components.common.edit',['webcomponent' => $componentBinder])]);
    }

    public function update()
    {
        $request = Request::capture();
        // build value.
        $values = [
            'subtitle'  => $request->post('subtitle'),
            'heading'   => $request->post('heading'),
            'description'   => $request->post('description'),
            'background_image'   => $request->post('background_image'),
            'position'          => $request->post('background_position'),
            'section_height'    => $request->post('section_height'),
            'container_class'   => $request->post('container_class'),
            'button_label'      => $request->post('button_label'),
            'button_link'       => $request->post('button_link')

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
        return $this->json(true,'Component Updated.','reload');
    }

    public function delete($component)
    {
        return $component->delete();
    }
}
