<?php

namespace App\Classes\Components\Services\Slider;

use App\Classes\Components\Services\BaseComponent;
use App\Classes\Components\Services\ComponentInterface;
use App\Models\ComponentBuilder;
use Illuminate\Http\Request;

class Slider extends BaseComponent implements ComponentInterface
{
    protected $_component_type = 'slider';

    public function store($componentBinder)
    {
        $request  = Request::capture();
        // dd($request->all());
        // $request->validate([
        //     'slider'   => 'required'
        // ]);

        $componentBuilder = new ComponentBuilder();
        $componentBuilder->fill([
            'component_type'    => $this->_component_type,
            'component_name'    => __('components.' . $this->_component_type),
            'relation_model'    => $componentBinder::class,
            'relation_id'       => $componentBinder->getKey(),
            'values'            => ['slider' => $request->post('slider'), 'type' => $request->post('type')],
            'sort_by'           => ComponentBuilder::getSortBy($componentBinder),
            'active'            => true
        ]);

        $values = [
            'layout'                  => $request->post('layout'),
            'type'                  => $request->post('slider_layout'),
            'limit'                    => $request->post('number_of_slider') ?? 15,
        ];

        $values['value'] = $request->post($request->post('slider_layout')) ?? [];
        $values['buttons'] = [];

        foreach ($request->post('button_label') ?? [] as $index => $buttonLabel) {
            $values['buttons'][] = [
                'label' => $buttonLabel,
                'link'  => $request->post('button_link')[$index] ?? '/'
            ];
        }

        if ($request->has('latest_posts')) {
            $values['latest'] = true;
        } else {
            $values['latest'] = false;
        }

        $componentBuilder->values = $values;
        try {
            $componentBuilder->save();
        } catch (\Exception $e) {
            return $this->json(false, 'Unable to insert.', null, ['error' => $e->getMessage()]);
        }
        return $this->json(true, 'Component created.', '');
    }

    public function update()
    {

        $request = Request::capture();

        $values = [
            'layout'                  => $request->post('layout'),
            'type'                  => $request->post('slider_layout'),
            'limit'                    => $request->post('number_of_slider') ?? 15,
        ];

        $values['value'] = $request->post($request->post('slider_layout')) ?? [];
        $values['buttons'] = [];

        foreach ($request->post('button_label') ?? [] as $index => $buttonLabel) {
            $values['buttons'][] = [
                'label' => $buttonLabel,
                'link'  => $request->post('button_link')[$index] ?? '/'
            ];
        }

        if ($request->has('latest_posts')) {
            $values['latest'] = true;
        } else {
            $values['latest'] = false;
        }

        $component = ComponentBuilder::find($request->post('_componentID'));

        if (! $component) {
            return $this->json(false, 'Unable to update.', null, ['error' => 'component class not found.']);
        }

        $component->values = $values;

        try {
            $component->save();
        } catch (\Exception $e) {
            return $this->json(false, 'Unable to update.', null, ['error' => $e->getMessage()]);
        }
        return $this->json(true, 'Component Updated.', 'reload');
    }

    public function delete($component)
    {
        return $component->delete();
    }
}
