<?php

namespace App\Classes\Helpers\Image;

use App\Classes\Helpers\Image as HelpersImage;
use App\Models\ComponentBuilder;
use Illuminate\Http\Request;

class Image
{

    static $type = 'image';
    public static function save(Request $request)
    {

        $request->validate([
            'title'    => 'required',
            'image'  => 'required',
            'model'     => 'required',
        ]);

        $componentBuilder = new ComponentBuilder();
        $componentBuilder->component_name = __('components.' . self::$type);;
        $componentBuilder->component_type = self::$type;
        $componentBuilder->relation_model = $request->post('model');
        $componentBuilder->relation_id  = $request->post('model_id');
        $values = [
            'title' => $request->post('title'),
            'description'   => $request->post('description'),
            'display_position'  => $request->post('display_position'),
            'background_color'  => $request->post('background_color'),
            'display_type'      => $request->post('display_type') ?? 'container'
        ];

        $componentBuilder->values = json_encode($values);

        try {
            $componentBuilder->save();
            HelpersImage::uploadImage($request->file('image'), $componentBuilder);
        } catch (\Throwable $th) {
            //throw $th;
            return $th;
        }

        return true;
    }

    public static function update(Request $request, ComponentBuilder $componentBuilder)
    {
        $values = [
            'title' => $request->post('title'),
            'description'   => $request->post('description'),
            'display_position'  => $request->post('display_position'),
            'background_color'  => $request->post('background_color'),
            'display_type'      => $request->post('display_type') ?? 'container'
        ];
        $componentBuilder->values = json_encode($values);

        try {
            $componentBuilder->save();
            if ($request->file('image')) {
                HelpersImage::uploadImage($request->file('image'), $componentBuilder);
            }
        } catch (\Throwable $th) {
            //throw $th;
            return $th;
        }
        return true;
    }
}
