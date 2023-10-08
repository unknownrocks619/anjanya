<?php

namespace App\Themes\nature\Components;

use App\Classes\Components\Services\BaseComponent;
use App\Classes\Components\Services\ComponentInterface;
use App\Models\ComponentBuilder;
use Illuminate\Http\Request;

class ProgressCard extends BaseComponent implements ComponentInterface
{
    protected $_component_name='progress_card';

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

        foreach ($request->post('card_title') as $key => $content) {
            $innerArray = [
                'title' => $content,
                'number'    => $key + 1,
                'number_colour' => $request->post('number_color')[$key],
                'background_colour' => $request->post('background_color')[$key],
                'description'   => $request->post('card_description')[$key],
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

        foreach ($request->post('card_title') as $key => $content) {
            $innerArray = [
                'title' => $content,
                'number'    => $key + 1,
                'number_colour' => $request->post('number_color')[$key],
                'background_colour' => $request->post('background_color')[$key],
                'description'   => $request->post('card_description')[$key],
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
        return $this->json(true,'Component Updated.','reload');
    }

    public function delete($component)
    {
        // TODO: Implement delete() method.
        return $component->delete();
    }
}
