<?php

namespace App\Http\Controllers\Admin\Media;

use App\Classes\Helpers\Image;
use App\Http\Controllers\Controller;
use App\Models\FileRelation;
use App\Plugins\Events\Http\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    //

    public function uploadImage(Request $request)
    {

        $modelString = $request->get('model');

        $modelInstance = $modelString::find($request->get('model_id'));
        if ( in_array($request->file('file')->clientExtension(),['pdf','xlsx','doc','docx'] ) ){
            $uploadImage = Image::uploadOther($request->file('file'),$modelInstance,'associated-file');
        } else {
            $uploadImage = Image::uploadImage($request->file('file'), $modelInstance);
        }


        if (!$uploadImage) {
            return $this->json(false, 'Unabel to upload file.');
        }

        return $this->json(true, 'Image Uploaded.', 'reload');
    }

    public function update_image_relation(Request $request, FileRelation $image_relation)
    {
        if ($request->get('title') ) {
            $image_relation->title = $request->get('title');
        }
        if ($request->get('record') ) {
            $image_relation->type = $request->record ?? null;
        }

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

    public function downloadImage(Request $request, FileRelation $image_relation, \App\Models\Image $image) {
            $string = str(url()->previous());
            if (! $string->contains('event') ) {
                abort(404);
            }

            // check if this belogs to event.
        if ($image_relation->relation !== Event::class || $image_relation->type != 'associated-file') {
            abort(404);
        }

        return Storage::download($image->filepath,$image->original_filename);
    }
}
