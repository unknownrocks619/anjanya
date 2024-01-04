<?php

namespace App\Themes\siddhamahayog\Components;

use App\Classes\Components\Services\BaseComponent;
use App\Classes\Components\Services\ComponentInterface;
use App\Models\ComponentBuilder;
use Illuminate\Http\Request;

class Image extends BaseComponent implements ComponentInterface
{
    protected $_component_name = 'imageonly';

    public function uploadMedia() {
        $request = Request::capture();
        $image = \App\Classes\Helpers\Image::uploadOnly($request->file('image'));


        $source = str($request->post('name'))->before('_')->value();
        if (! $image ) {
            return $this->json(false,'Unable to upload image.','clearImage',['source' => $source]);
        }
        return $this->json(true,'Image upload',null,['source' => $source,'image' => Image::getImageAsSize($image[0]->filepath,'xl')]);
    }
    public function store($componentBinder)
    {
        $request = Request::capture();

        $values = [];
        $component = new ComponentBuilder();
        $component->fill([
            'component_name'    => __('components.'.$this->_component_name),
            'component_type'    => $this->_component_name,
            'relation_model'    => $componentBinder::class,
            'relation_id'       => $componentBinder->getKey(),
            'sort_by'           => ComponentBuilder::getSortBy($componentBinder),
            'active'            => true,
            'values'            => $values
        ]);

        $values= [
            'subtitle'  => $request->post('subtitle'),
            'heading'   => $request->post('title'),
            'image' => $request->post('background_image'),
        ];

        $component->values = $values;

        try {
            $component->save();
        } catch (\Exception $e) {
            return $this->json(false,'Unable to save', null,['error' => $e->getMessage()]);
        }
        return $this->json(true,'Component saved','redirect',['location' => route('admin.components.common.edit',['webcomponent' => $componentBinder])]);

    }

    public function update()
    {
        $request = Request::capture();

        $values= [
            'subtitle'  => $request->post('subtitle'),
            'heading'   => $request->post('title'),
            'image' => $request->post('background_image'),
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
