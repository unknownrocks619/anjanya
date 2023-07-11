<?php

namespace App\Classes\Helpers\IconColumn;

use App\Models\ComponentBuilder;
use Illuminate\Http\Request;

class IconColumn
{

    static $type = 'icon_column';
    public static function save(Request $request)
    {
        $componentBuilder = new ComponentBuilder();
        $componentBuilder->component_name = __('components.' . self::$type);;
        $componentBuilder->component_type = self::$type;
        $componentBuilder->relation_model = $request->post('model');
        $componentBuilder->relation_id  = $request->post('model_id');
        $values = [
            'layout'    => $request->post('layout'),
            // 'theme'     => $request->post('theme'),
            'contents'  => []
        ];

        foreach ($request->post('column_title') as $column_key => $column_value) {
            $values['contents'][] = [
                'title' => $column_value,
                'content'   => $request->post('content')[$column_key],
                'icon'      => $request->post('icon')[$column_key],
                'background'    => $request->post('color')[$column_key],
            ];
        }

        $componentBuilder->values = json_encode($values);
        try {
            //code...
            $componentBuilder->save();
        } catch (\Throwable $th) {
            //throw $th;
            return $th;
        }
        return true;
    }
    public static function update(Request $request, ComponentBuilder $componentBuilder)
    {
        $values = [
            'layout'    => $request->post('layout'),
            // 'theme'     => $request->post('theme'),
            'contents'  => []
        ];

        foreach ($request->post('column_title') as $column_key => $column_value) {
            $values['contents'][] = [
                'title' => $column_value,
                'content'   => $request->post('content')[$column_key],
                'icon'      => $request->post('icon')[$column_key],
                'background'    => $request->post('color')[$column_key],
            ];
        }

        $componentBuilder->values = json_encode($values);

        if (!$componentBuilder->save()) {
            return false;
        }

        return true;
    }
}
