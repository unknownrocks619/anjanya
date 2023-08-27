<?php

namespace App\Classes\Components\Services\Content;

use App\Classes\Components\Services\BaseComponent;
use App\Classes\Components\Services\ComponentInterface;
use App\Models\ComponentBuilder;
use Illuminate\Http\Request;

class Content extends BaseComponent implements ComponentInterface
{
    protected $_component_type = 'content';
    public function store($componentBinder)
    {
        $request = Request::capture();
        $request->validate([
            'description'   => 'required',
        ]);
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
            'heading'   => $request->post('heading'),
            'description'   => $request->post('description'),
        ];
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
        $values = [
            'heading'   => $request->post('heading'),
            'description'   => $request->post('description'),
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
