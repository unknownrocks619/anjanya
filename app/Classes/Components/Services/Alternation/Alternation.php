<?php

namespace App\Classes\Components\Services\Alternation;

use App\Classes\Components\Services\BaseComponent;
use App\Classes\Components\Services\ComponentInterface;
use App\Classes\Helpers\Image;
use App\Models\ComponentBuilder;
use Illuminate\Http\Request;

class Alternation extends BaseComponent implements ComponentInterface
{

    protected $_component_name = 'alternation';
    public function uploadImage() {
        $request = Request::capture();
        $image = Image::uploadOnly($request->file('image'));

        $source = str($request->post('name'))->before('_')->value();
        if (! $image ) {
            return $this->json(false,__('components._failed_media'),'clearImage',['source' => $source]);
        }
        return $this->json(true,__('components._success_media'),null,['source' => $source,'image' => Image::getImageAsSize($image[0]->filepath,'m')]);

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
        $values = [];
        foreach ($request->post('heading') as $key => $value) {
            $innerArray= [
                'heading' => $value,
                'description'   => $request->post('description')[$key],
                'image'         => (isset($request->post('image_display_value')[$key])) ?  $request->post('image_display_value')[$key] : ""
            ];

            $values[] = $innerArray;
        }

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
        $values = [];
        foreach ($request->post('heading') as $key => $value) {
            $innerArray= [
                'heading' => $value,
                'description'   => $request->post('description')[$key],
                'image'         => $request->post('image_display_value')[$key]
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
