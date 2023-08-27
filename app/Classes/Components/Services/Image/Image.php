<?php

namespace App\Classes\Components\Services\Image;

use App\Classes\Components\Services\BaseComponent;
use App\Classes\Components\Services\ComponentInterface;
use App\Models\ComponentBuilder;
use Illuminate\Http\Request;

class Image extends BaseComponent implements ComponentInterface
{
    protected $_component_type = 'image';


    public function uploadMedia() {
        $request = Request::capture();
        $image = \App\Classes\Helpers\Image::uploadOnly($request->file('image'));


        $source = str($request->post('name'))->before('_')->value();
        if (! $image ) {
            return $this->json(false,'Unable to upload image.','clearImage',['source' => $source]);
        }
        return $this->json(true,'Image upload','enablePreviewImage',['source' => $source,'image' => Image::getImageAsSize($image[0]->filepath,'m')]);
    }
    public function store($componentBinder)
    {
        $request = Request::capture();
//        $request->validate([
//            'primary_image_value'   => 'required',
//            'heading'                 => 'required'
//        ]);
        $componentBuilder = new ComponentBuilder();
        $componentBuilder->fill([
            'component_type'    => $this->_component_type,
            'relation_model'    => $componentBinder::class,
            'relation_id'       => $componentBinder?->getKey(),
            'active'            => true,
            'sort_by'           => ComponentBuilder::getSortBy($componentBinder),
            'component_name'    => __('components.'.$this->_component_type)
        ]);
        $values = [];
        foreach ($request->post('heading') as $key => $componentValue) {
            $innerArray=[
                'heading'   => $componentValue,
                'description'   => isset ($request->post('description')[$key]) ? $request->post('description')[$key] : '',
                'bullets'   => isset($request->post('bullets')[$key]) ? $request->post('bullets')[$key] : [],
                'image'     => isset($request->post('image')[$key]) ? $request->post('image')[$key] : ''
            ];
            $values[] = $innerArray;
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
                'image'     => isset($request->post('image')[$key]) ? $request->post('image')[$key] : ''
            ];
            $values[] = $innerArray;
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
