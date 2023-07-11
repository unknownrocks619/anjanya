<?php

namespace App\Classes\Helpers\OverlayVideo;

use App\Classes\Helpers\Image;
use App\Models\ComponentBuilder;
use Illuminate\Http\Request;

class OverlayVideo
{

    static $type = 'overlay_video';
    public static function save(Request $request)
    {
        $request->validate([
            'video_url' => 'required',
        ]);

        $componentBuilder = new ComponentBuilder();
        $componentBuilder->component_name = __('components.' . self::$type);
        $componentBuilder->component_type = self::$type;
        $componentBuilder->relation_model = $request->post('model');
        $componentBuilder->relation_id = $request->post('model_id');

        // $insert = [
        //     'component_name'    => __('components.' . self::$type),
        //     'component_type'    => self::$type,
        //     'relation_model'    => $request->post('model'),
        //     'relation_id'       => $request->post('model_id'),
        // ];

        $populateValues = [
            'video_source' => $request->post('video_source'),
            'video_url'     => $request->post('video_url'),
            'title'         => $request->post('title'),
            'tagline'       => $request->post('tagline'),
            'description'   => $request->post('overlay_description'),
            'overlay_color' => $request->post('color'),
            'position'      => $request->post('position')
        ];

        $text = [];
        if ($request->post('button_label') &&  !empty($request->post('button_label'))) {
            foreach ($request->post('button_label') as $key => $value) {
                $text[] = [
                    'label' => $value,
                    'link'  => $request->post('button_link')[$key]
                ];
            }
        }
        $populateValues['buttons'] = $text;


        // $insert['values'] = json_encode($populateValues);
        $componentBuilder->values = json_encode($populateValues);
        try {
            $componentBuilder->save();
        } catch (\Throwable $th) {
            //throw $th;
            return $th;
        }
        if ($request->file('display_image')) {
            $image = Image::uploadImage($request->file('display_image'), $componentBuilder);
            $relation  = $image[0]['relation'];
            $relation->type = 'display_image';
            $relation->save();
        }
        return true;
    }
    public static function update(Request $request, ComponentBuilder $componentBuilder)
    {
        $request->validate([
            'video_url' => 'required',
        ]);

        $populateValues = [
            'video_source'  => $request->post('video_source'),
            'video_url'     => $request->post('video_url'),
            'title'         => $request->post('title'),
            'description'   => $request->post('overlay_description'),
            'overlay_color' => $request->post('color'),
            'position'      => $request->post('position')
        ];

        $text = [];
        if ($request->post('button_label') &&  !empty($request->post('button_label'))) {
            foreach ($request->post('button_label') as $key => $value) {
                $text[] = [
                    'label' => $value,
                    'link'  => $request->post('button_link')[$key]
                ];
            }
        }
        $populateValues['buttons'] = $text;
        $componentBuilder->values = json_encode($populateValues);

        try {
            $componentBuilder->save();
        } catch (\Throwable $th) {
            //throw $th;
            return $th;
        }
        return true;
    }
}
