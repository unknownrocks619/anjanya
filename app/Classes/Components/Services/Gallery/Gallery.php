<?php

namespace App\Classes\Components\Services\Gallery;

use App\Classes\Components\Services\BaseComponent;
use App\Classes\Components\Services\ComponentInterface;
use App\Models\ComponentBuilder;
use Illuminate\Http\Request;

class Gallery extends BaseComponent implements ComponentInterface
{
    private $_component_type = 'gallery';
    public function store($componentBinder)
    {
        $request = Request::capture();
        $request->validate([
            'albums.*'    => 'required',
        ]);
        $componentBuilder = new ComponentBuilder();
        $componentBuilder->fill([
            'component_type'    => $this->_component_type,
            'relation_model'    => $componentBinder::class,
            'relation_id'       => $componentBinder?->getKey(),
            'active'            => false,
            'sort_by'           => ComponentBuilder::getSortBy($componentBinder),
            'component_name'    => __('components.'.$this->_component_type),
            'values'            => []
        ]);

        $values = [
            'title' => $request->post('title'),
            'description'   => $request->post('description'),
            'layout'    => $request->post('layout'),
            'albums'    => $request->post('albums'),
            'highlight' => $request->post('highlight')
        ];

        $componentBuilder->values = $values;

        try {
            $componentBuilder->save();
        } catch (\Exception $e) {
            return $this->json(false,'Unable to save.',null,['error'=>$e->getMessage()]);
        }
        return $this->json(true,'Component Save.','reload');
    }

    public function update()
    {
        $request = Request::capture();
        $request->validate([
            'albums.*'    => 'required',
        ]);

        $component = ComponentBuilder::find($request->post('_componentID'));
        $values = [
            'title' => $request->post('title'),
            'description'   => $request->post('description'),
            'layout'    => $request->post('layout'),
            'albums'    => $request->post('albums'),
            'highlight' => $request->post('highlight')
        ];

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
