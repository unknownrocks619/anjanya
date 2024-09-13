<?php

namespace App\Classes\Components\Services\BlockBuilder;

use App\Classes\Components\Services\BaseComponent;
use App\Classes\Components\Services\ComponentInterface;
use App\Classes\Helpers\Image;
use App\Models\ComponentBuilder;
use App\Models\WebComponents;
use Illuminate\Http\Request;

class BlockBuilder extends BaseComponent implements ComponentInterface
{
    protected $_component_type = 'block_builder';
    public function generate() {}

    public function uploadMedia()
    {
        $request = Request::capture();
        $image = Image::uploadOnly($request->file('image'));


        $source = str($request->post('name'))->before('_')->value();
        if (! $image) {
            return $this->json(false, 'Unable to upload image.', 'clearImage', ['source' => $source]);
        }
        return $this->json(true, 'Image upload', 'enablePreviewImage', ['source' => $source, 'image' => Image::getImageAsSize($image[0]->filepath, 'm')]);
    }

    public function store($componentBinder)
    {
        $request = Request::capture();
        $request->validate([
            'primary_image_value'   => 'required',
            'heading'                 => 'required'
        ]);
        $componentBuilder = new ComponentBuilder();
        $componentBuilder->fill([
            'component_type'    => $this->_component_type,
            'relation_model'    => $componentBinder::class,
            'relation_id'       => $componentBinder?->getKey(),
            'active'            => false,
            'sort_by'           => ComponentBuilder::getSortBy($componentBinder),
            'component_name'    => __('components.' . $this->_component_type)
        ]);

        // build value.
        $values = [
            'subtitle'  => $request->post('subtitle'),
            'heading'   => $request->post('heading'),
            'description'   => $request->post('description'),
            'first_image'   => $request->post('primary_image_value'),
            'second_image'  => $request->post('secondary_image_value'),
            'third_image'   => $request->post('third_image_value')
        ];
        $componentBuilder->values = $values;

        try {
            $componentBuilder->save();
        } catch (\Exception $e) {
            return $this->json(false, __('components._failed_save'), null, ['error' => $e->getMessage()]);
        }
        return $this->json(true, __('components._success_save'), 'reload');
    }

    public function update()
    {
        $request = Request::capture();
        $values = [
            'subtitle'  => $request->post('subtitle'),
            'heading'   => $request->post('heading'),
            'description'   => $request->post('description'),
            'first_image'   => $request->post('primary_image_value'),
            'second_image'  => $request->post('secondary_image_value'),
            'third_image'   => $request->post('third_image_value')
        ];
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
        return $this->json(true, 'Component Updated.', '');
    }

    public function delete($component)
    {
        return $component->delete();
    }
}
