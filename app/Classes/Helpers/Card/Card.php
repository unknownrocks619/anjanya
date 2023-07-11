<?php

namespace App\Classes\Helpers\Card;

use App\Classes\Helpers\Image;
use App\Classes\Helpers\Video;
use App\Models\ComponentBuilder;
use Illuminate\Http\Request;

class Card
{
    static $type = 'card';

    public static function save(Request $request)
    {

        $componentBuilder = new ComponentBuilder();
        $componentBuilder->component_name = __('components.' . self::$type);;
        $componentBuilder->component_type = self::$type;
        $componentBuilder->relation_model = $request->post('model');
        $componentBuilder->relation_id  = $request->post('model_id');
        $values = [
            'size'              => $request->post('card_size'),
            'display_type'      => $request->post('display_type'),
            'layout'            => $request->post('slider_layout'),
            'card_content'      => [],
            'latest'            => $request->has('latest_posts') ?? false
        ];

        $insertArray = [];
        if ($request->post('slider_layout') == 'custom_content') {

            foreach ($request->post('card_title') as $card_index => $card_content) {
                $innerArray = [
                    'title' => $card_content,
                    'background_color'  => $request->post('background_color')[$card_index],
                    'text_color'        => $request->post('text_color')[$card_index],
                    'body'  => $request->post('card_body')[$card_index],
                    'footer'    => [
                        'label' => $request->post('card_button_label')[$card_index],
                        'link'  => $request->post('card_button_link')[$card_index],
                        'position'  => $request->post('button_position')[$card_index]
                    ],
                    'media' => ['type' => null]
                ];
                if ($request->post('media_type')[$card_index] == 'image') {
                    $image = Image::uploadImage($request->file('cardImage')[$card_index], $componentBuilder);
                    $innerArray['media'] = [
                        'type'  => 'image',
                        'images'    => $image[0]['image']['filepath']
                    ];
                    $toReconfigure[] = $card_index;
                }
                if ($request->post('media_type')[$card_index] == 'video') {

                    if ($request->post('media_source')[$card_index]  == 'youtube') {
                        $innerArray['media'] = [
                            'type'  => 'video',
                            'video' => Video::youtube($request->post('media_url')[$card_index])
                        ];
                    }

                    if ($request->post('media_source')[$card_index]  == 'vimeo') {
                        $innerArray['media'] = [
                            'type'  => 'video',
                            'video' => Video::vimeo($request->post('media_url')[$card_index])
                        ];
                    }
                }
                $insertArray[] = $innerArray;
            }
        }

        if ($request->post('slider_layout') == 'category_content') {
            $insertArray = $request->post('categories') ?? [];
        }

        if ($request->post('slider_layout') == 'post_content') {
            $insertArray = $request->post('posts') ?? [];
        }

        if ($request->post('slider_layout') == 'page_content') {
            $insertArray = $request->post('pages') ?? [];
        }

        $values['card_content'] =  $insertArray;

        $componentBuilder->values = json_encode($values);

        try {
            $componentBuilder->save();
        } catch (\Throwable $th) {
            throw $th;
            // return $th->getMessage();
        }

        return true;
    }
    public static function update(Request $request, ComponentBuilder $componentBuilder)
    {

        $values = [
            'size'              => $request->post('card_size'),
            'display_type'      => $request->post('display_type'),
            'layout'            => $request->post('slider_layout'),
            'card_content'      => [],
            'latest'            => $request->has('latest_posts') ?? false
        ];

        $insertArray = [];

        if ($request->post('slider_layout') == 'custom_content') {
            foreach ($request->post('card_title') as $card_index => $card_content) {

                $innerArray = [
                    'title' => $card_content,
                    'background_color'  => $request->post('background_color')[$card_index],
                    'text_color'        => $request->post('text_color')[$card_index],
                    'body'  => $request->post('card_body')[$card_index],
                    'footer'    => [
                        'label' => $request->post('card_button_label')[$card_index],
                        'link'  => $request->post('card_button_link')[$card_index],
                        'position'  => $request->post('button_position')[$card_index]
                    ],
                    'media' => ['type' => null]
                ];

                if ($request->post('media_type')[$card_index] == 'image' && $request->file('cardImage')[$card_index]) {

                    $image = Image::uploadImage($request->file('cardImage')[$card_index], $componentBuilder);
                    $innerArray['media'] = [
                        'type'  => 'image',
                        'images'    => $image[0]['image']['filepath']
                    ];
                    $toReconfigure[] = $card_index;
                }

                if ($request->post('media_type')[$card_index] == 'video') {

                    if ($request->post('media_source')[$card_index]  == 'youtube') {
                        $innerArray['media'] = [
                            'type'  => 'video',
                            'video' => Video::youtube($request->post('media_url')[$card_index])
                        ];
                    }

                    if ($request->post('media_source')[$card_index]  == 'vimeo') {
                        $innerArray['media'] = [
                            'type'  => 'video',
                            'video' => Video::vimeo($request->post('media_url')[$card_index])
                        ];
                    }
                }
                $insertArray[] = $innerArray;
            }
        }

        if ($request->post('slider_layout') == 'category_content') {
            $insertArray = $request->post('categories') ?? [];
        }

        if ($request->post('slider_layout') == 'post_content') {
            $insertArray = $request->post('posts') ?? [];
        }

        if ($request->post('slider_layout') == 'page_content') {
            $insertArray = $request->post('pages') ?? [];
        }

        $values['card_content'] = $insertArray;

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
