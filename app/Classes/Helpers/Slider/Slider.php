<?php

namespace App\Classes\Helpers\Slider;

use App\Classes\Helpers\Image;
use App\Classes\Helpers\Video;
use App\Models\ComponentBuilder;
use Illuminate\Http\Request;

class Slider
{
    static $type = 'slider';

    public static function save(Request $request)
    {

        $componentBuilder = new ComponentBuilder();
        $componentBuilder->component_name = __('components.' . self::$type);;
        $componentBuilder->component_type = self::$type;
        $componentBuilder->relation_model = $request->post('model');
        $componentBuilder->relation_id  = $request->post('model_id');
        $values = [
            'layout'                  => $request->post('layout'),
            'type'                  => $request->post('slider_layout'),
            'limit'                    => $request->post('number_of_slider') ?? 15,
        ];
        if ($request->post('slider_layout') == 'categories') {
            $value = $request->post('categories') ?? [];
        }

        if ($request->post('slider_layout') == 'posts') {
            $value = $request->post('posts') ?? [];
        }

        if ($request->has('latest_posts')) {
            $values['latest'] = true;
        } else {
            $values['latest'] = false;
        }

        $values['values'] = $value;
        $componentBuilder->values = json_encode($values);

        try {
            $componentBuilder->save();
        } catch (\Throwable $th) {
            //throw $th;
            return $th->getMessage();
        }
        return true;
    }
    public static function update(Request $request, ComponentBuilder $componentBuilder)
    {
        dd('gel');

        $values = [
            'layout'                  => $request->post('layout'),
            'type'                  => $request->post('slider_layout'),
            'limit'                    => $request->post('number_of_slider') ?? 15,
        ];
        if ($request->post('slider_layout') == 'categories') {
            $value = $request->post('categories') ?? [];
        }

        if ($request->post('slider_layout') == 'posts') {
            $value = $request->post('posts') ?? [];
        }

        if ($request->has('latest_posts')) {
            $values['latest'] = true;
        } else {
            $values['latest'] = false;
        }

        $values['values'] = $value;
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
