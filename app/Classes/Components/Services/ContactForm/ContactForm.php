<?php

namespace App\Classes\Components\Services\ContactForm;

use App\Classes\Components\Services\BaseComponent;
use App\Classes\Components\Services\ComponentInterface;
use App\Models\ComponentBuilder;
use Illuminate\Http\Request;

class ContactForm extends BaseComponent implements ComponentInterface
{
    protected $_component_type = 'contact_form';
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
            'component_name'    => __('components.' . $this->_component_type)
        ]);

        $values = [
            'full_name' => $request->post('full_name_label'),
            'subject'   => $request->post('subject_label'),
            'email'     => $request->post('email_label'),
            'message_box'   => $request->post('message_box_label'),
            'button'        => $request->post('button_text'),
            'success_message'   => $request->post('success_message'),
            'error_message'     => $request->post('fail_message'),
            'heading'           => $request->post('heading'),
            'description'       => $request->post('description')
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
            'full_name' => $request->post('full_name_label'),
            'subject'   => $request->post('subject_label'),
            'email'     => $request->post('email_label'),
            'message_box'   => $request->post('message_box_label'),
            'button'        => $request->post('button_text'),
            'success_message'   => $request->post('success_message'),
            'error_message'     => $request->post('fail_message'),
            'heading'           => $request->post('heading'),
            'description'       => $request->post('description')

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
