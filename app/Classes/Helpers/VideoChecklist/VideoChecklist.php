<?php

namespace App\Classes\Helpers\VideoChecklist;

use App\Classes\Helpers\Video;
use App\Models\ComponentBuilder;
use Illuminate\Http\Request;

class VideoChecklist
{
    static $type = 'video_checklist';

    public static function save(Request $request)
    {
        $componentBuilder = new ComponentBuilder();
        $componentBuilder->component_name = __('components.' . self::$type);;
        $componentBuilder->component_type = self::$type;
        $componentBuilder->relation_model = $request->post('model');
        $componentBuilder->relation_id  = $request->post('model_id');

        $values = [
            'video_position'    => $request->post('video_position'),
            'video_type'        => $request->post('video_type'),
            'video' => [],
            'items' => []
        ];

        if ($request->post('video_type') == 'vimeo') {
            $values['video'] = Video::vimeo($request->post('video_url'));
        } else {
            $values['video'] = Video::youtube($request->post('video_url'));
        }

        foreach ($request->post('checklist') as $listindex => $listItem) {
            $values['items'][] = [
                'items' => $listItem
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
