<?php

namespace App\Themes\bellevie\Components\HotelBlock;

use App\Classes\Components\Services\BaseComponent;
use App\Classes\Components\Services\ComponentInterface;
use App\Models\ComponentBuilder;
use Illuminate\Http\Request;

class HotelBlock extends BaseComponent implements ComponentInterface
{
    protected $_component_type = 'hotel_block';

    public function store($componentBinder)
    {
        $request = Request::capture();
        $request->validate([
            'rooms'   => 'required',
        ]);
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
            'subtitle'  => $request->post('subtitle'),
            'heading'   => $request->post('heading'),
            'background'    => $request->post('background_color'),
            'rooms'   => $request->post('rooms'),
        ];
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
        // build value.
        $values = [
            'subtitle'  => $request->post('subtitle'),
            'heading'   => $request->post('heading'),
            'background'    => $request->post('background_color'),
            'rooms'   => $request->post('rooms'),
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
        return $this->json(true,'Component Updated.','');
    }

    public function delete($component)
    {
        return $component->delete();
    }
}
