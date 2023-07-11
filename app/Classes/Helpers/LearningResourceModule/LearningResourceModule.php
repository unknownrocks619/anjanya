<?php

namespace App\Classes\Helpers\LearningResourceModule;

use App\Classes\Helpers\Image;
use App\Models\ComponentBuilder;
use Illuminate\Http\Request;

class LearningResourceModule
{

    static $type = 'lms_resource';

    public static function save(Request $request)
    {
        $componentBuilder = new ComponentBuilder();
        $componentBuilder->component_name = __('components.' . self::$type);
        $componentBuilder->component_type = self::$type;
        $componentBuilder->relation_model = $request->post('model');
        $componentBuilder->relation_id = $request->post('model_id');
        $insertValues = [
            'resource_title'    => $request->post('resource_title'),
            'resource_description'  => $request->post('resource_description'),
            'accordians' => [],
            'buttons'   => [],
            'images'    => []
        ];

        if ($request->post('accordian_title') && is_array($request->post('accordian_title'))) {
            $accordian_array = [];

            foreach ($request->post('accordian_title') as $accordian_key => $accordian_value) {
                $innerArray = [];
                $innerArray['title'] = $accordian_value;
                $innerArray['description']  = $request->post('accordian_description')[$accordian_key];

                $accordian_array[] = $innerArray;
            }
            $insertValues['accordians'] = $accordian_array;
        }

        if ($request->post('button_label') && is_array($request->post('button_label'))) {
            $button_array = [];

            foreach ($request->post('button_label') as $button_key => $button_value) {
                $innerArray = [];
                $innerArray['label'] = $button_value;
                $innerArray['link'] = $request->post('button_link')[$button_key];

                $button_array[] = $innerArray;
            }

            $insertValues['buttons'] = $button_array;
        }
        $componentBuilder->values = json_encode($insertValues);
        try {
            $componentBuilder->save();
        } catch (\Throwable $th) {
            //throw $th;
            return $th;
        }
        if ($request->file('images') && is_array($request->file('images'))) {
            Image::uploadImage($request->file('images'), $componentBuilder);
        }

        return true;
    }

    public static function update(Request $request, ComponentBuilder $componentBuilder)
    {
        $insertValues = [
            'resource_title'    => $request->post('resource_title'),
            'resource_description'  => $request->post('resource_description'),
            'accordians' => [],
            'buttons'   => [],
            'images'    => []
        ];

        if ($request->post('accordian_title') && is_array($request->post('accordian_title'))) {
            $accordian_array = [];

            foreach ($request->post('accordian_title') as $accordian_key => $accordian_value) {
                $innerArray = [];
                $innerArray['title'] = $accordian_value;
                $innerArray['description']  = $request->post('accordian_description')[$accordian_key];

                $accordian_array[] = $innerArray;
            }
            $insertValues['accordians'] = $accordian_array;
        }

        if ($request->post('button_label') && is_array($request->post('button_label'))) {
            $button_array = [];

            foreach ($request->post('button_label') as $button_key => $button_value) {
                $innerArray = [];
                $innerArray['label'] = $button_value;
                $innerArray['link'] = $request->post('button_link')[$button_key];

                $button_array[] = $innerArray;
            }

            $insertValues['buttons'] = $button_array;
        }
        $componentBuilder->values = json_encode($insertValues);
        try {
            $componentBuilder->save();
        } catch (\Throwable $th) {
            //throw $th;
            return $th;
        }
        if ($request->file('images') && is_array($request->file('images'))) {
            Image::uploadImage($request->file('images'), $componentBuilder);
        }
        return true;
    }
}
