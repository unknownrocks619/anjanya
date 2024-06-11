<?php

namespace App\Themes\siddhamahayog\Components;

use App\Classes\Components\Services\BaseComponent;
use App\Classes\Components\Services\ComponentInterface;
use App\Models\ComponentBuilder;
use Illuminate\Http\Request;

class Content extends BaseComponent implements ComponentInterface
{
    protected $_component_type = 'content';

    public function uploadMedia() {
        $request = Request::capture();
        $image = \App\Classes\Helpers\Image::uploadOnly($request->file('image'));


        $source = str($request->post('name'))->before('_')->value();
        if (! $image ) {
            return $this->json(false,'Unable to upload image.','clearImage',['source' => $source]);
        }
        return $this->json(true,'Image upload','',['source' => $source,'image' => \App\Classes\Helpers\Image::getImageAsSize($image[0]->filepath,'m')]);

    }

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
            'title' => $request->post('title'),
            'subtitle' => $request->post('subtitle'),
            'description' => $request->post('description'),
            'content_type'  => $request->post('content_type'),
            'categories'    => [],
            'post'  => ['ids' => [],'latest' => false],
            'page'  => ['ids' => [], 'latest' => false],
            'background_type' => $request->post('background_type'),
            'background_colour' => $request->post('background_colour'),
            'background_image' => $request->post('background_image'),
            'glitter' => $request->post('glitter_background'),
            'layout_type'   => $request->post('layout_type'),
            'connector_component' => $request->post('connector_component')
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
            'title' => $request->post('title'),
            'subtitle' => $request->post('subtitle'),
            'description' => $request->post('description'),
            'content_type'  => $request->post('content_type'),
            'categories'    => [],
            'post'  => ['ids' => [],'latest' => false],
            'page'  => ['ids' => [], 'latest' => false],
            'background_type' => $request->post('background_type'),
            'background_colour' => $request->post('background_colour'),
            'background_image' => $request->post('background_image'),
            'glitter' => $request->post('glitter_background'),
            'layout_type'   => $request->post('layout_type'),
            'connector_component' => $request->post('connector_component')
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
