<?php

namespace App\Classes\Helpers\ContactForm;


use App\Models\ComponentBuilder;
use Illuminate\Http\Request;

class ContactForm
{
    static $type = 'contact_form';

    public static function save(Request $request)
    {

        $componentBuilder = new ComponentBuilder();
        $componentBuilder->component_name = __('components.' . self::$type);;
        $componentBuilder->component_type = self::$type;
        $componentBuilder->relation_model = $request->post('model');
        $componentBuilder->relation_id  = $request->post('model_id');
        $values = [
            'full_name' => $request->post('full_name_label'),
            'subject'   => $request->post('subject_label'),
            'email'     => $request->post('email_label'),
            'message_box'   => $request->post('message_box_label'),
            'button'        => $request->post('button_text'),
            'success_message'   => $request->post('success_message'),
            'error_message'     => $request->post('fail_message')
        ];
        $componentBuilder->values = json_encode($values);

        try {
            $componentBuilder->save();
        } catch (\Throwable $th) {
            throw $th;
            // return $th->getMessage();
        }

        return true;
    }
    public static function update(Request $request, ComponentBuilder $componentBuilder)
    {

        $values = [
            'full_name' => $request->post('full_name_label'),
            'subject'   => $request->post('subject_label'),
            'email'     => $request->post('email_label'),
            'message_box'   => $request->post('message_box_label'),
            'button'        => $request->post('button_text'),
            'success_message'   => $request->post('success_message'),
            'error_message'     => $request->post('fail_message')
        ];
        $componentBuilder->values = json_encode($values);

        try {
            $componentBuilder->save();
        } catch (\Throwable $th) {
            //throw $th;
            return $th->getMessage();
        }
        return true;
    }
}
