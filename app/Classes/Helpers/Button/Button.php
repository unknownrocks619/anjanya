<?php

namespace App\Classes\Helpers\Button;

use App\Classes\Helpers\Video;
use App\Models\ComponentBuilder;
use Illuminate\Http\Request;

class Button
{
    static $type = 'button';

    public static function save(Request $request)
    {
        $componentBuilder = new ComponentBuilder();
        $componentBuilder->component_name = __('components.' . self::$type);;
        $componentBuilder->component_type = self::$type;
        $componentBuilder->relation_model = $request->post('model');
        $componentBuilder->relation_id  = $request->post('model_id');

        $values = [];

        foreach ($request->post('label') as $buttonKey => $button_text) {
            $values[] = [
                'label' => $button_text,
                'link'  => $request->post('link')[$buttonKey],
                'size'  => $request->post('display_size')[$buttonKey],
                'theme' => $request->post('theme')[$buttonKey],
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

    public static function udpate(Request $request, ComponentBuilder $componentBuilder)
    {
        $values = [];

        foreach ($request->post('label') as $buttonKey => $button_text) {
            $values[] = [
                'label' => $button_text,
                'link'  => $request->post('link')[$buttonKey],
                'size'  => $request->post('display_size')[$buttonKey],
                'theme' => $request->post('theme')[$buttonKey],
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
