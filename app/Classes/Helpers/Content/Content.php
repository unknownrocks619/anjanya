<?php

namespace App\Classes\Helpers\Content;

use App\Classes\Helpers\Video;
use App\Models\ComponentBuilder;
use Illuminate\Http\Request;

class Content
{
    static $type = 'content';

    public static function save(Request $request)
    {

        $componentBuilder = new ComponentBuilder();
        $componentBuilder->component_name = __('components.' . self::$type);;
        $componentBuilder->component_type = self::$type;
        $componentBuilder->relation_model = $request->post('model');
        $componentBuilder->relation_id  = $request->post('model_id');

        $values = [];
        $values = [
            'title' => $request->post('title'),
            'description'   => $request->post('full_text'),
            'subtitle'      => $request->post('subtitle'),
            'media'         => [],
        ];
        if ($request->post('media_link') && !empty($request->post('media_link'))) {

            foreach ($request->post('media_link') as $media_key => $media_value) {
                $video_position = $request->post('display_position')[$media_key];

                if (!isset($values['media'][$video_position])) {
                    $values['media'][$video_position] = [];
                }
                $video_type = $request->post('media_source')[$media_key];
                $values['media'][$video_position][] = Video::$video_type($media_value);
            }
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

    public static function update(Request $request, ComponentBuilder $componentBuilder)
    {
        $values = [
            'title' => $request->post('title'),
            'description'   => $request->post('full_text'),
            'subtitle'      => $request->post('subtitle'),
            'media'         => [],
        ];
        if ($request->post('media_link') && !empty($request->post('media_link'))) {

            foreach ($request->post('media_link') as $media_key => $media_value) {
                $video_position = $request->post('display_position')[$media_key];

                if (!isset($values['media'][$video_position])) {
                    $values['media'][$video_position] = [];
                }
                $video_type = $request->post('media_source')[$media_key];
                $values['media'][$video_position][] = Video::$video_type($media_value);
            }
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
