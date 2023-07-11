<?php

namespace App\Classes\Helpers\Iframe;

use App\Models\ComponentBuilder;
use Illuminate\Http\Request;

class Iframe
{

    static $type = 'iframe';
    public static function save(Request $request)
    {

        $request->validate([
            'iframe'    => 'required',
            'model_id'  => 'required',
            'model'     => 'required',
        ]);
        $insert = [];
        if (is_array($request->post('iframe'))) {
            foreach ($request->post('iframe') as $iframe_value) {
                $insert[] = [
                    'component_name'    => __('components.' . self::$type),
                    'component_type'    => self::$type,
                    'relation_model'    => $request->post('model'),
                    'relation_id'       => $request->post('model_id'),
                    'values'            => $iframe_value
                ];
            }
        } else {
            $insert = [
                'component_name'    => self::$type,
                'component_type'    => self::$type,
                'relation_model'    => $request->post('model'),
                'relation_id'       => $request->post('model_id'),
                'values'            => $request->post('iframe')
            ];
        }

        try {
            //code...
            ComponentBuilder::insert($insert);
        } catch (\Throwable $th) {
            //throw $th;
            return $th;
        }
        return true;
    }

    public static function renderPublic()
    {
    }

    public static function renderAdmin()
    {
    }

    public static function update(Request $request, ComponentBuilder $componentBuilder)
    {
        $componentBuilder->values = $request->post('iframe');

        if (!$componentBuilder->save()) {
            return false;
        }

        return true;
    }
}
