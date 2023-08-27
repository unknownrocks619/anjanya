<?php

namespace App\Classes\Components\Services\Faq;

use App\Classes\Components\Services\BaseComponent;
use App\Classes\Components\Services\ComponentInterface;
use App\Models\ComponentBuilder;
use Illuminate\Http\Request;

class Faq extends BaseComponent implements ComponentInterface
{

    protected $_component_type = 'faq';
    public function store($componentBinder)
    {
        $request = Request::capture();
        $request->validate([
            'title'     => 'required',
            'intro'     => 'required'
        ]);
        $componentBuilder = new ComponentBuilder();
        $componentBuilder->fill([
            'component_type'    => $this->_component_type,
            'relation_model'    => $componentBinder::class,
            'relation_id'       => $componentBinder?->getKey(),
            'active'            => true,
            'sort_by'           => ComponentBuilder::getSortBy($componentBinder),
            'component_name'    => __('components.'.$this->_component_type)
        ]);

        // build value.
        $values = [
            'title'  => $request->post('title'),
            'intro'   => $request->post('intro'),
        ];
        $left = [];
        $right = [];
        foreach ($request->post('faq_left_title') as $key_left => $faq_left) {
            $left[] = [
                'title' => $faq_left,
                'description'   => $request->post('faq_left_description')[$key_left]
            ];
        }
        foreach ($request->post('faq_right_title') as $key_left => $faq_left) {
            $right[] = [
                'title' => $faq_left,
                'description'   => $request->post('faq_left_description')[$key_left]
            ];
        }
        $values['left'] = $left;
        $values['right'] = $right;

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
            'title'  => $request->post('title'),
            'intro'   => $request->post('intro'),
        ];
        $left = [];
        $right = [];
        foreach ($request->post('faq_left_title') as $key_left => $faq_left) {
            $left[] = [
                'title' => $faq_left,
                'description'   => $request->post('faq_left_description')[$key_left]
            ];
        }
        foreach ($request->post('faq_right_title') as $key_left => $faq_left) {
            $right[] = [
                'title' => $faq_left,
                'description'   => $request->post('faq_left_description')[$key_left]
            ];
        }
        $values['left'] = $left;
        $values['right'] = $right;

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
