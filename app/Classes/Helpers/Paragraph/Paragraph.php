<?php

namespace App\Classes\Helpers\Paragraph;

use App\Models\ComponentBuilder;
use Illuminate\Http\Request;

class Paragraph
{
    static $type = 'paragraph';

    public static function save(Request $request)
    {
        $componentBuilder = new ComponentBuilder();
        $componentBuilder->component_name = __('components.' . self::$type);;
        $componentBuilder->component_type = self::$type;
        $componentBuilder->relation_model = $request->post('model');
        $componentBuilder->relation_id  = $request->post('model_id');

        $values = ['paragraph' => $request->post('paragraph')];
        $componentBuilder->values = json_encode($values);
        try {
            $componentBuilder->save();
        } catch (\Throwable $th) {
            //throw $th;
            return $th;
        }
        return true;
    }

    public static function update(Request $request, ComponentBuilder $componentBuilder)
    {
        $values = ['paragraph' => $request->post('paragraph')];
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
