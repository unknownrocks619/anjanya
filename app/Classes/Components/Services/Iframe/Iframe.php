<?php

namespace App\Classes\Components\Services\Iframe;

use App\Classes\Components\Services\BaseComponent;
use App\Classes\Components\Services\ComponentInterface;
use App\Models\ComponentBuilder;
use Illuminate\Http\Request;

class Iframe extends BaseComponent implements ComponentInterface
{

    protected $_component_type = 'iframe';
    public function store($componentBinder)
    {
        $request = Request::capture();
        $request->validate([
            'iframe'    => 'required'
        ]);
        $componentBuilder = new ComponentBuilder();
        $componentBuilder->fill([
            'component_type'    => $this->_component_type,
            'relation_model'    => $componentBinder::class,
            'relation_id'       => $componentBinder?->getKey(),
            'active'            => false,
            'sort_by'           => ComponentBuilder::getSortBy($componentBinder),
            'component_name'    => __('components.'.$this->_component_type),
            'values'            => $request->post('iframe')
        ]);

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
            'iframe'    => 'required'
        ]);

        $component = ComponentBuilder::find($request->post('_componentID'));
        $component->values = $request->post('iframe');
        if (! $component ) {
            return $this->json(false,'Unable to update.',null,['error'=>'component class not found.']);
        }

        $component->values = $request->post('iframe');

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
