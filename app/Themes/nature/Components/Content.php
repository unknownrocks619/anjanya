<?php

namespace App\Themes\nature\Components;

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
            'background_text'  => $request->post('background_text'),
            'title' => $request->post('title'),
            'underline_text' => $request->post('underline_text'),
            'description' => $request->post('description'),
            'content_type'  => $request->post('content_type'),
            'categories'    => [],
            'post'  => ['ids' => [],'latest' => false],
            'page'  => ['ids' => [], 'latest' => false]
        ];


        if ($request->post('content_type') == 'category') {
            $values['categories'] = explode(',',$request->post('category')[0]);
        }

        if ($request->post('content_type') == 'post') {
            $values['post']['ids'] = explode(',',$request->post('post')[0]);
            $values['post']['latest'] =( $request->post('latest_post') == 'on' ) ? true : false;
        }

        if ($request->post('content_type') == 'page') {
            $values['page']['ids'] = explode(',',$request->post('page')[0]);
            $values['page']['latest'] = ($request->post('latest_page') == 'on') ? true : false;
        }

        $componentBuilder->values = $values;
        try {
            $componentBuilder->save();
        } catch (\Exception $e) {
            return $this->json(false,__('components._failed_save'),null,['error'=>$e->getMessage()]);
        }
        return $this->json(true,__('components._success_save'),'reload');
    }

    /**
     * @return void
     */
    public function update()
    {
        $request = Request::capture();

        $component = ComponentBuilder::find($request->post('_componentID'));

        if (! $component ) {
            return $this->json(false,'Unable to update.',null,['error'=>'component class not found.']);
        }

        // build value.
        $values = [
            'background_text'  => $request->post('background_text'),
            'title' => $request->post('title'),
            'underline_text' => $request->post('underline_text'),
            'description' => $request->post('description'),
            'content_type'  => $request->post('content_type'),
            'categories'    => [],
            'post'  => ['ids' => [],'latest' => false],
            'page'  => ['ids' => [], 'latest' => false]
        ];


        if ($request->post('content_type') == 'category') {
            $values['categories'] = explode(',',$request->post('category')[0]);
        }

        if ($request->post('content_type') == 'post') {
            $values['post']['ids'] = explode(',',$request->post('post')[0]);
            $values['post']['latest'] =( $request->post('latest_post') == 'on' ) ? true : false;
        }

        if ($request->post('content_type') == 'page') {
            $values['page']['ids'] = explode(',',$request->post('page')[0]);
            $values['page']['latest'] = ($request->post('latest_page') == 'on') ? true : false;
        }

        $component->values = $values;

        try {
            $component->save();
        } catch (\Exception $e) {
            return $this->json(false,'Unable to update.',null,['error'=>$e->getMessage()]);
        }

        return $this->json(true,'Component Updated.','');

    }


    /**
     * @param $component
     * @return mixed
     */
    public function delete($component)
    {
        return $component->delete();
    }
}
