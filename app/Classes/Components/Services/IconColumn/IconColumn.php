<?php

namespace App\Classes\Components\Services\IconColumn;

use App\Classes\Components\Services\BaseComponent;
use App\Classes\Components\Services\ComponentInterface;
use App\Models\ComponentBuilder;
use Illuminate\Http\Request;

class IconColumn extends BaseComponent implements ComponentInterface
{
    protected $_component_name = 'icon_column';
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
        foreach ($request->post('icon') as $key => $row) {
            $innerArray = [];
            foreach ($row as $iconKey => $iconValue) {
                $columnArray = [];
                $columnArray['icon'] = $iconValue;
                $columnArray['title'] = $request->post('title')[$key][$iconKey];
                $columnArray['description'] = $request->post('description')[$key][$iconKey];
                $innerArray[] = $columnArray;
            }
            $data[] = $innerArray;
        }
        $values['data'] = $data;
        $component->values = $values;
        dd($component);
        try {
            $component->save();
        } catch (\Exception $e) {
            return $this->json(false,'Unable to save', null,['error' => $e->getMessage()]);
        }
        return $this->json(true,'Component saved','reload');
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
        foreach ($request->post('icon') as $key => $row) {
            $innerArray = [];
            foreach ($row as $iconKey => $iconValue) {
                $columnArray = [];
                $columnArray['icon'] = $iconValue;
                $columnArray['title'] = $request->post('title')[$key][$iconKey];
                $columnArray['description'] = $request->post('description')[$key][$iconKey];
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
        return $this->json(true,'Component Updated.','');
    }

    public function delete($component)
    {
        return $component->delete();
    }
}
