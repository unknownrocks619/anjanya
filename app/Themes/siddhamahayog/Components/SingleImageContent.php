<?php

namespace App\Themes\siddhamahayog\Components;

use App\Classes\Components\Services\BaseComponent;
use App\Classes\Components\Services\ComponentInterface;
use App\Classes\Components\Services\Image\Image;
use App\Models\ComponentBuilder;
use Illuminate\Http\Request;

class SingleImageContent extends BaseComponent implements ComponentInterface
{

    protected $_component_type = 'single_image_content';


    public function uploadImage() {
        $request = Request::capture();
        $image = \App\Classes\Helpers\Image::uploadOnly($request->file('image'));


        $source = str($request->post('name'))->before('_')->value();
        if (! $image ) {
            return $this->json(false,'Unable to upload image.','clearImage',['source' => $source]);
        }
        return $this->json(true,'Image upload','enablePreviewImage',['source' => $source,'image' => \App\Classes\Helpers\Image::getImageAsSize($image[0]->filepath,'m')]);
    }
    public function store($componentBinder)
    {
        $request = Request::capture();

        $componentBuilder = new ComponentBuilder();

        $componentBuilder->fill([
            'component_type'    => $this->_component_type,
            'relation_model'    => $componentBinder::class,
            'relation_id'       => $componentBinder?->getKey(),
            'active'            => true,
            'sort_by'           => ComponentBuilder::getSortBy($componentBinder),
            'component_name'    => __('components.'.$this->_component_type),
        ]);

        foreach ($request->post('heading') as $key => $componentValue) {

            $innerArray=[
                'heading'   => $componentValue,
                'description'   => isset ($request->post('description')[$key]) ? $request->post('description')[$key] : '',
                'bullets'   => isset($request->post('bullets')[$key]) ? $request->post('bullets')[$key] : [],
                'bullets_description' => isset($request->post('bullet_description')[$key]) ? $request->post('bullet_description')[$key] : [],
                'image'     => isset($request->post('image')[$key]) ? $request->post('image')[$key] : '',
                'subtitle' => $request->post('markup_heading'),
                'background_type' => $request->post('background_type'),
                'colour' => $request->post('colour'),
                'background_image' => $request->post('background_image'),
                'layout_type' => $request->post('layout_type'),
                'glitter_background'    => $request->post('glitter_background')
            ];
            $values = $innerArray;
        }

        $componentBuilder->values = $values;

        try {
            $componentBuilder->save();
        } catch (\Exception $e) {
            return $this->json(false,__('components._failed_save'),null,['error'=>$e->getMessage()]);
        }
        return $this->json(true,__('components._success_save'),'reload');
    }

    public function update()
    {
        $request = Request::capture();
        $values = [];

        foreach ($request->post('heading') as $key => $componentValue) {
            $innerArray=[
                'heading'   => $componentValue,
                'description'   => isset ($request->post('description')[$key]) ? $request->post('description')[$key] : '',
                'bullets'   => isset($request->post('bullets')[$key]) ? $request->post('bullets')[$key] : [],
                'bullets_description' => isset($request->post('bullet_description')[$key]) ? $request->post('bullet_description')[$key] : [],
                'image'     => isset($request->post('image')[$key]) ? $request->post('image')[$key] : '',
                'subtitle' => $request->post('markup_heading'),
                'background_type' => $request->post('background_type'),
                'colour' => $request->post('colour'),
                'background_image' => $request->post('background_image'),
                'layout_type' => $request->post('layout_type'),
                'glitter_background'    => $request->post('glitter_background')
            ];
            $values = $innerArray;
        }

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
