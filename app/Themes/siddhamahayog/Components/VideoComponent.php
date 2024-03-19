<?php

namespace App\Themes\siddhamahayog\Components;

use App\Classes\Components\Services\BaseComponent;
use App\Classes\Components\Services\ComponentInterface;
use App\Classes\Helpers\Image;
use App\Models\ComponentBuilder;
use Illuminate\Http\Request;

class VideoComponent extends BaseComponent implements ComponentInterface
{
    protected $_component_name = 'video';

    public function uploadMedia() {
        $request = Request::capture();
        $image = Image::uploadOnly($request->file('image'));


        $source = str($request->post('name'))->before('_')->value();
        if (! $image ) {
            return $this->json(false,'Unable to upload image.','clearImage',['source' => $source]);
        }
        return $this->json(true,'Image upload',null,['source' => $source,'image' => Image::getImageAsSize($image[0]->filepath,'xl')]);
    }
    public function store($componentBinder)
    {
        $request = Request::capture();

        $values = [];
        $component = new ComponentBuilder();
        $component->fill([
            'component_name'    => __('components.'.$this->_component_name),
            'component_type'    => $this->_component_name,
            'relation_model'    => $componentBinder::class,
            'relation_id'       => $componentBinder->getKey(),
            'sort_by'           => ComponentBuilder::getSortBy($componentBinder),
            'active'            => true,
            'values'            => $values
        ]);

        $values= [
            'subtitle'  => $request->post('subtitle'),
            'heading'   => $request->post('title'),
            'background_type' => $request->post('background_type'),
            'video_layout' => $request->post('video_layout_type'),
            'background_colour' => $request->post('background_colour'),
            'background_image' => $request->post('background_image'),
            'glitter_background'    => $request->post('glitter_background'),
            'video_source' => $request->post('video_source'),
            'video_link' => $request->post('video_link'),
            'video_poster'  => $request->post('video_poster'),
            'description' => $request->post('description'),
            'button_label'  => $request->post('button_label'),
            'button_link'   => $request->post('button_link')
        ];

        $component->values = $values;

        try {
            $component->save();
        } catch (\Exception $e) {
            return $this->json(false,'Unable to save', null,['error' => $e->getMessage()]);
        }
        return $this->json(true,'Component saved','redirect',['location' => route('admin.components.common.edit',['webcomponent' => $componentBinder])]);
    }

    public function update()
    {
        $request = Request::capture();
        $values= [
            'subtitle'  => $request->post('subtitle'),
            'heading'   => $request->post('title'),
            'background_type' => $request->post('background_type'),
            'video_layout' => $request->post('video_layout_type'),
            'background_colour' => $request->post('background_colour'),
            'background_image' => $request->post('background_image'),
            'glitter_background'    => $request->post('glitter_background'),
            'video_source' => $request->post('video_source'),
            'video_link' => $request->post('video_link'),
            'video_poster'  => $request->post('video_poster'),
            'description'   => $request->post('description'),
            'button_label'  => $request->post('button_label'),
            'button_link'   => $request->post('button_link')

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
        return $this->json(true,'Component Updated.','reload');

    }

    public function delete($component)
    {
        return $component->delete();
    }
}
