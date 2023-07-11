<?php

namespace App\Http\Controllers\Admin\Media;

use App\Classes\Helpers\Image;
use App\Http\Controllers\Controller;
use App\Models\FileRelation;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    //

    public function uploadImage(Request $request)
    {

        $modelString = $request->get('model');

        $modelInstance = $modelString::find($request->get('model_id'));

        $uploadImage = Image::uploadImage($request->file('file'), $modelInstance);

        if (!$uploadImage) {
            return $this->json(false, 'Unabel to upload file.');
        }

        return $this->json(true, 'Image Uploaded.', 'reload');
    }

    public function update_image_relation(Request $request, FileRelation $image_relation)
    {
        $image_relation->type = $request->record ?? null;
        if (!$image_relation->save()) {
            return $this->json(false, 'Unable to update Image Type.');
        }

        return $this->json(true, 'File Type Updated.');
    }

    public function remove_image(Request $request, Filerelation $image_relation, $current_tab = null)
    {
        $modelString = $request->get('model');
        $modelInstance = $modelString::find($request->get('model_id'));
        if (!$image_relation->delete()) {
            return $this->json(false, 'Unable to remove file.');
        }
        return $this->json(true, 'File removed.', 'reload');
    }
}
