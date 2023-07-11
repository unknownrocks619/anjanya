<?php

namespace App\Classes\Helpers\Block;

use App\Models\ComponentBuilder;
use Illuminate\Http\Request;

class Block
{
    static $type = 'block';

    public static function save(Request $request)
    {

        $componentBuilder = new ComponentBuilder();
        $componentBuilder->component_name = __('components.' . self::$type);;
        $componentBuilder->component_type = self::$type;
        $componentBuilder->relation_model = $request->post('model');
        $componentBuilder->relation_id  = $request->post('model_id');

        $values = [
            'card_size'                  => $request->post('card_size'),
            'display_type'                  => $request->post('display_type'),
            'block_type'                    => $request->post('slider_layout'),
            'latest_posts'                  => $request->has('latest_posts') ? true : false,
            'post_limit'                    => $request->post('post_limit')
        ];
        if ($request->post('slider_layout') == 'categories') {
            $value = $request->post('categories') ?? [];
        }

        if ($request->post('slider_layout') == 'posts') {
            $value = $request->post('posts') ?? [];
        }

        if ($request->post('slider_layout') == 'pages') {
            $value = $request->post('pages') ?? [];
        }

        $values['blocks'] = $value;
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

        $values = [
            'card_size'                  => $request->post('card_size'),
            'display_type'                  => $request->post('display_type'),
            'block_type'                    => $request->post('slider_layout'),
            'latest_posts'                  => $request->has('latest_posts') ? true : false,
            'post_limit'                    => $request->post('post_limit')
        ];
        if ($request->post('slider_layout') == 'categories') {
            $value = $request->post('categories') ?? [];
        }

        if ($request->post('slider_layout') == 'posts') {
            $value = $request->post('posts') ?? [];
        }

        if ($request->post('slider_layout') == 'pages') {
            $value = $request->post('pages') ?? [];
        }

        $values['blocks'] = $value;
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
