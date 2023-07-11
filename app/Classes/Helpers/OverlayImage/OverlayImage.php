<?php

namespace App\Classes\Helpers\OverlayImage;

use App\Classes\Helpers\Image;
use App\Classes\Helpers\Video;
use App\Models\ComponentBuilder;
use Illuminate\Http\Request;

class OverlayImage
{
    static $type = 'overlay_image';
    public static function save(Request $request)
    {
        $componentBuilder = new ComponentBuilder();
        $componentBuilder->component_name = __('components.' . self::$type);
        $componentBuilder->component_type = self::$type;
        $componentBuilder->relation_model = $request->post('model');
        $componentBuilder->relation_id = $request->post('model_id');
        $insert = [
            'title'             => $request->post('title'),
            'tagline'           => $request->post('tagline'),
            'description'       => $request->post('overlay_description'),
            'overlay_color'     => $request->post('color'),
            'overlay_active'    => $request->has('active') ? true : false,
            'position'          => $request->post('position'),
            'min_height'        => $request->post('height'),
            'min_width'         => $request->post('width'),
            'unit'              => $request->post('unit')
        ];

        $populateValues = [];

        $text = [];
        if ($request->post('button_label') &&  !empty($request->post('button_label'))) {
            foreach ($request->post('button_label') as $key => $value) {
                $text[] = [
                    'label' => $value,
                    'link'  => $request->post('button_link')[$key]
                ];
            }
        }
        $insert['buttons'] = $text;


        if (($request->post('video_url'))) {
            $videoScheme = parse_url($request->post('video_url'));

            if (\Illuminate\Support\Str::contains($videoScheme['host'], 'youtube', true)) {
                $insert['videos'] = ['type' => 'youtube'];
                $insert['videos']['content'] = Video::youtube($request->post('video_url'));
            } else {
                $insert['videos'] = ['type' => 'vimeo'];
                $insert['videos']['content'] = Video::vimeo($request->post('video_url'));
            }
        }

        $componentBuilder->values = json_encode($insert);
        try {
            $componentBuilder->save();

            // now lets upload
            $image = Image::uploadImage($request->file('image'), $componentBuilder);
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
        $insert = [
            'title'             => $request->post('title'),
            'tagline'           => $request->post('tagline'),
            'description'       => $request->post('overlay_description'),
            'overlay_color'     => $request->post('color'),
            'overlay_active'    => $request->has('active') ? true : false,
            'position'          => $request->post('position'),
            'min_height'        => $request->post('height'),
            'min_width'         => $request->post('width'),
            'unit'              => $request->post('unit')
        ];

        $populateValues = [];

        $text = [];
        if ($request->post('button_label') &&  !empty($request->post('button_label'))) {
            foreach ($request->post('button_label') as $key => $value) {
                $text[] = [
                    'label' => $value,
                    'link'  => $request->post('button_link')[$key]
                ];
            }
        }
        $insert['buttons'] = $text;

        if (($request->post('video_url'))) {
            $videoScheme = parse_url($request->post('video_url'));

            if (\Illuminate\Support\Str::contains($videoScheme['host'], 'youtube', true)) {
                $insert['videos'] = ['type' => 'youtube'];
                $insert['videos']['content'] = Video::youtube($request->post('video_url'));
            } else {
                $insert['videos'] = ['type' => 'vimeo'];
                $insert['videos']['content'] = Video::vimeo($request->post('video_url'));
            }
        }

        $componentBuilder->values = json_encode($insert);
        try {
            $componentBuilder->save();
            // now lets upload
            if ($request->has('image')) {
                $image = Image::uploadImage($request->file('image'), $componentBuilder);
            }
        } catch (\Throwable $th) {
            //throw $th;
            dd($th->getMessage());
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
}
