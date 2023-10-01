<?php

namespace App\Classes\Components\Services\Card;

use App\Classes\Components\Services\BaseComponent;
use App\Classes\Components\Services\ComponentInterface;
use App\Classes\Helpers\Image;
use App\Models\ComponentBuilder;
use Illuminate\Http\Request;

class Card extends BaseComponent implements ComponentInterface
{
    protected $_component_name = 'card';

    public function uploadMedia() {
        $request = Request::capture();
        $image = Image::uploadOnly($request->file('image'));


        $source = str($request->post('name'))->before('_')->value();
        if (! $image ) {
            return $this->json(false,'Unable to upload image.','clearImage',['source' => $source]);
        }
        return $this->json(true,'Image upload',null,['source' => $source,'image' => Image::getImageAsSize($image[0]->filepath,'m')]);
    }
    public function store($componentBinder)
    {
        $request = Request::capture();

        $request->validate([
            'row'   => 'required',
            'column'    => 'required',
        ]);

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
            'row'   => $request->post('row'),
            'column'    => $request->post('column'),
            'subtitle'  => $request->post('subtitle'),
            'heading'   => $request->post('heading'),
        ];

        $data = [];
        foreach ($request->post('image') as $key => $row) {
            $innerArray = [];
            foreach ($row as $iconKey => $iconValue) {
                $columnArray = [];
                $columnArray['image'] = $request->post('image')[$key][$iconKey];
                $columnArray['title'] = $request->post('title')[$key][$iconKey];
                $columnArray['description'] = $request->post('description')[$key][$iconKey];
                $columnArray['button']      = $request->post('button')[$key][$iconKey];
                $innerArray[] = $columnArray;
            }
            $data[] = $innerArray;
        }
        $values['data'] = $data;
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
        $values = [
            'subtitle'  => $request->post('subtitle'),
            'heading'   => $request->post('heading'),
        ];
        $component = ComponentBuilder::find($request->post('_componentID'));
        if (! $component ) {
            return $this->json(false,'Unable to update.',null,['error'=>'component class not found.']);
        }

        $values['row'] = $component->values['row'];
        $values['column'] = $component->values['column'];
        $values['data'] = [];
        $data = [];
        foreach ($request->post('image') as $key => $row) {
            $innerArray = [];
            foreach ($row as $iconKey => $iconValue) {
                $columnArray = [];
                $columnArray['image'] = $request->post('image')[$key][$iconKey];
                $columnArray['title'] = $request->post('title')[$key][$iconKey];
                $columnArray['description'] = $request->post('description')[$key][$iconKey];
                $columnArray['button']      = $request->post('button')[$key][$iconKey];
                $innerArray[] = $columnArray;
            }
            $data[] = $innerArray;
        }
        $values['data'] = $data;
        $component->values = $values;

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
