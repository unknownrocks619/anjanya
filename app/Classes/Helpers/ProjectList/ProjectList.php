<?php

namespace App\Classes\Helpers\ProjectList;

use App\Models\ComponentBuilder;
use Illuminate\Http\Request;

class ProjectList
{
    static $type = 'project_list';

    public static function save(Request $request)
    {
        $componentBuilder = new ComponentBuilder();
        $componentBuilder->component_name = __('components.' . self::$type);;
        $componentBuilder->component_type = self::$type;
        $componentBuilder->relation_model = $request->post('model');
        $componentBuilder->relation_id  = $request->post('model_id');

        $values = [
            'column'    => $request->post('column'),
            'layout'    => $request->post('type'), // available options: card , column
            'display_layout'    => $request->post('layout_option'),
            'intro_text'    => $request->post('intro_text'),
            'intro_title'   => $request->post('intro_title'),
            'short_description' => $request->post('short_description'),
            'courses'  => $request->post('courses') ?? [],
            'books_bundle'  => $request->post('books_bundle') ?? [],
            'books'      => $request->post('books') ?? [],
            'projects'      => $request->post('projects') ?? []

        ];

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
            'column'    => $request->post('column'),
            'layout'    => $request->post('type'), // available options: card , column
            'display_layout'    => $request->post('layout_option'),
            'intro_text'    => $request->post('intro_text'),
            'intro_title'   => $request->post('intro_title'),
            'short_description' => $request->post('short_description'),
            'courses'  => $request->post('courses') ?? [],
            'books_bundle'  => $request->post('books_bundle') ?? [],
            'books'      => $request->post('books') ?? [],
            'projects'      => $request->post('projects') ?? []

        ];

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
