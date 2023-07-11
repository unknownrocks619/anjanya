<?php

namespace App\Classes\Helpers\Gallery;

use App\Classes\Helpers\Image;
use App\Models\ComponentBuilder;
use Illuminate\Http\Request;

class Gallery
{

    public static function save(Request $request)
    {
        $request->validate([
            'images'    => 'required',
            'model_id'  => 'required',
            'model'     => 'required',
        ]);

        $componentBuilder = new ComponentBuilder();
        $componentBuilder->component_name = __('components.gallery');
        $componentBuilder->component_type = 'gallery';
        $componentBuilder->relation_model = $request->post('model');
        $componentBuilder->relation_id  = $request->post('model_id');
        $componentBuilder->values = json_encode(['layout' => $request->post('layout')]);

        try {
            //code...
            $componentBuilder->save();
        } catch (\Throwable $th) {
            //throw $th;
            dd($th->getMessage());
        }
        $images = Image::uploadImage($request->file('images'), $componentBuilder);

        $values = [
            'layout' => $request->post('layout'),
            'gallery'   => []
        ];
        $insertValues = [];
        foreach ($images as $image) {
            $insertValues[] = $image['image']->getKey();
        }
        $values['gallery'] = $insertValues;
        $componentBuilder->values = json_encode($values);
        if (!$componentBuilder->save()) {
            return false;
        }
        return true;
    }

    public static function update(Request $request, ComponentBuilder $componentBuilder)
    {
        $values = json_decode($componentBuilder->values);
        if ($request->file('images') && count($request->file('images'))) {
            $images = Image::uploadImage($request->file('images'), $componentBuilder);

            $insertValues = [];
            foreach ($images as $image) {
                $insertValues[] = $image['image']->getKey();
            }

            $newRecord = [
                'layout'    => $request->post('layout'),
                'gallery'   => array_merge($insertValues, $values->gallery)
            ];
        } else {
            $newRecord = [
                'layout' => $request->post('layout'),
                'gallery'   => $values->gallery
            ];
        }

        $componentBuilder->values = json_encode($newRecord);
        $componentBuilder->save();

        return true;
    }
}
