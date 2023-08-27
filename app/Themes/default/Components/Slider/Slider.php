<?php

namespace App\Themes\default\Components\Slider;

use App\Classes\Components\Services\BaseComponent;
use App\Classes\Components\Services\ComponentInterface;
use App\Models\ComponentBuilder;
use Illuminate\Http\Request;

class Slider extends BaseComponent implements ComponentInterface
{
    protected $_component_type = 'slider';
    public function store($componentBinder)
    {
        $request = Request::capture();
        $request->validate([
            'slider_type'   => 'required',
        ]);
        $values = [];

        if ($request->post('slider_type') == 'post') {
            $values = [
                        'no_of_posts' => $request->post('no_of_display_post') ?? 5,
                        'data' => $request->post('posts'),
                        'latest_post'   => $request->post('latest_posts') ? true : false
                    ];
        }

        if ($request->post('slider_type') == 'category') {
            $values = [
                'data' => $request->post('categories'),
            ];
        }

        if ($request->post('slider_type') == 'slider_album') {
            $values = [
                'data' => $request->post('slider_album')
            ];
        }
        $values['type'] = $request->post('slider_type');
        $values['layout'] = $request->post('layout');

        $component = new ComponentBuilder();
        $component->fill([
           'component_type' => $this->_component_type,
            'relation_model'    => $componentBinder::class,
            'relation_id'       => $componentBinder->getKey(),
            'values'            => $values,
            'sort_by'           => ComponentBuilder::getSortBy($componentBinder),
            'active'            => false,
            'component_name'    => __('components.'.$this->_component_type),
        ]);

        try {
            $component->save();
        } catch (\Exception $e) {
            return $this->json(false,'Unable to save component',null,['error' => $e->getMessage()]);
        }
        return $this->json(true,'component saved.','reload');
    }

    public function update()
    {
        $request = Request::capture();
        $request->validate([
            'slider_type'   => 'required',
        ]);

        $values = [];

        if ($request->post('slider_type') == 'post') {
            $values = [
                'no_of_posts' => $request->post('no_of_display_post') ?? 5,
                'data' => $request->post('posts'),
                'latest_post'   => $request->post('latest_posts') ? true : false
            ];
        }

        if ($request->post('slider_type') == 'category') {
            $values = [
                'data' => $request->post('categories'),
            ];
        }

        if ($request->post('slider_type') == 'slider_album') {
            $values = [
                'data' => $request->post('slider_album')
            ];
        }
        $values['type'] = $request->post('slider_type');
        $values['layout'] = $request->post('layout');

        $component = ComponentBuilder::find($request->post('_componentID'));
        $component->fill([
            'values'            => $values,
            'active'            => true,
        ]);
        try {
            $component->save();
        } catch (\Exception $e) {
            return $this->json(false,'Unable to save component',null,['error' => $e->getMessage()]);
        }
        return $this->json(true,'component saved.','reload');
    }

    public function delete($component)
    {
        return $component->delete();
    }
}
