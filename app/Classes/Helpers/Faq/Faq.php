<?php

namespace App\Classes\Helpers\Faq;

use App\Classes\Helpers\Video;
use App\Models\ComponentBuilder;
use Illuminate\Http\Request;

class Faq
{
    static $type = 'faq';

    public static function save(Request $request)
    {

        $componentBuilder = new ComponentBuilder();
        $componentBuilder->component_name = __('components.' . self::$type);;
        $componentBuilder->component_type = self::$type;
        $componentBuilder->relation_model = $request->post('model');
        $componentBuilder->relation_id  = $request->post('model_id');
        $values = [
            'display_title' => $request->post('display_title'),
            'layout'    => $request->post('layout'),
            'background_color'  => $request->post('background_color'),
            'background_image'  => null,
            'registration_button'   => $request->post('registration_button') ? '<registration>' . $request->post('registration_button') . '</registration>'  : null,
            'registration_tagline'  => $request->post('registration_tagline'),
            'faqs'  => [],
            'display_type'  => $request->post('display_type') ?? 'container'
        ];

        foreach ($request->post('question_text') as $question_index => $question_text) {
            $values['faqs'][] = [
                'title' => $question_text,
                'description'   => $request->post('faq_description')[$question_index]
            ];
        }
        $componentBuilder->values = json_encode($values);

        try {
            $componentBuilder->save();
        } catch (\Throwable $th) {
            //throw $th;
            return $th;
        }
        return true;
        //
    }

    public static function update(Request $request, ComponentBuilder $componentBuilder)
    {
        $values = [
            'display_title' => $request->post('display_title'),
            'layout'    => $request->post('layout'),
            'background_color'  => $request->post('background_color'),
            'background_image'  => null,
            'registration_button'   => $request->post('registration_button') ? '<registration>' . $request->post('registration_button') . '</registration>'  : null,
            'registration_tagline'  => $request->post('registration_tagline'),
            'faqs'  => [],
            'display_type'  => $request->post('display_type') ?? 'container'

        ];

        foreach ($request->post('question_text') as $question_index => $question_text) {
            $values['faqs'][] = [
                'title' => $question_text,
                'description'   => $request->post('faq_description')[$question_index]
            ];
        }
        $componentBuilder->values = json_encode($values);

        try {
            $componentBuilder->save();
        } catch (\Throwable $th) {
            //throw $th;
            return $th;
        }
        return true;
    }
}
