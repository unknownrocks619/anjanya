<?php

namespace App\Classes\Components\Services\Slider;

use App\Classes\Components\Services\BaseComponent;
use App\Classes\Components\Services\ComponentInterface;
use App\Models\ComponentBuilder;
use Illuminate\Http\Request;

class Slider extends BaseComponent implements ComponentInterface
{
    protected $_component_type = 'slider';

    public function store($componentBinder) {
        $request  = Request::capture();
        $request->validate([
            'slider'   => 'required'
        ]);

        $componentBuilder = new ComponentBuilder();
        $componentBuilder->fill([
            'component_type'    => $this->_component_type,
            'component_name'    => __('components.'.$this->_component_type),
            'relation_model'    => $componentBinder::class,
            'relation_id'       => $componentBinder->getKey(),
            'values'            => ['slider' => $request->post('slider'),'type' => $request->post('type')],
            'sort_by'           => ComponentBuilder::getSortBy($componentBinder),
            'active'            => true
        ]);

        try {
            $componentBuilder->save();
        } catch (\Exception $e) {
            return $this->json(false,'Unable to insert.',null,['error' => $e->getMessage()]);
        }
        return $this->json(true,'Component created.','reload');
    }

    public function update() {

        $request = Request::capture();
        $values =['slider' => $request->post('slider'),'type' => $request->post('type')];
        ;
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

    public function delete($component){
        return $component->delete();
    }
}
