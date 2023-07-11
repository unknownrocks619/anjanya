<?php

namespace App\Classes\Helpers;

use App\Models\FileRelation;
use App\Models\Image as ModelsImage;
use App\Models\Web\StudioFile;
use App\Models\Web\StudioFileRelation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as ImageManager;

class FileUpload
{

    public static function upload(mixed $file, Model $model = null, array $additionalRequest = []): bool|array
    {
        $records = [];
        if (!is_array($file)) {
            $file = [$file];
        }

        foreach ($file as $image) {

            $generatedFilename = $image->hashName();

            $image->store('import');
            $newFile = new ModelsImage();
            $newFile->fill([
                'filename' => $generatedFilename,
                'filepath' => 'import/' . $generatedFilename,
                'information' => [
                    'folders' => 'import'
                ],
                'original_filename' => $image->getClientOriginalName(),
            ]);

            if (!$newFile->save()) {
                return false;
            }

            if (!is_null($model)) {
                $fileRelation = new FileRelation();
                $fileRelation->fill([
                    'image_id' => $newFile->getKey(),
                    'relation' => $model::class,
                    'relation_id' => $model->getKey()
                ]);

                if (!$fileRelation->save()) {
                    return false;
                }
            }

            $records[] = ['file' => $newFile, 'relation' => $fileRelation];
        }

        return $records;
    }

    public static function getFile($filePath,)
    {
        $domainPath = env('APP_URL');
        $sotragePath = asset($filePath, true);
        return $sotragePath;
    }
}
