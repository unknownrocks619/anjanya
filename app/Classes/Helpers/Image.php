<?php

namespace App\Classes\Helpers;

use App\Models\FileRelation;
use App\Models\Image as ModelsImage;
use App\Models\Web\StudioFile;
use App\Models\Web\StudioFileRelation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as ImageManager;

class Image
{

    public static function uploadImage(mixed $images, Model $model = null, array $additionalRequest = []): bool|array
    {
        $settings = config('image-settings');
        $records = [];
        if (!is_array($images)) {
            $images = [$images];
        }

        foreach ($images as $image) {

            $generatedFilename = $image->hashName();

            list($width, $height) = getimagesize($image->getRealPath());

            foreach ($settings['sizes'] as $folder => $option) {

                $resizeImage = ImageManager::make($image->getRealPath());
                $resizeImage->resize($option['height'], $option['width'], function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
                $resizeImage->encode();
                $baseDir = 'public/uploads/' . $folder . '/' . date("Y") . '/' . date('m');

                Storage::put($baseDir . '/' . $generatedFilename, $resizeImage->__toString());
            }

            $image->store('public/uploads/cus/' . date('Y') . '/' . date('m'));
            $exif = ImageManager::make($image->getRealPath())->exif();
            $newImage = new ModelsImage();
            $newImage->fill([
                'filename' => $generatedFilename,
                'filepath' => date('Y') . '/' . date("m") . '/' . $generatedFilename,
                'information' => [
                    'exif' => $exif,
                    'folders' => date('Y') . '/' . date("m")
                ],
                'sizes' => [
                    'width' => $width ?? 0,
                    'height' => $height ?? 0,
                ],
                'original_filename' => $image->getClientOriginalName(),
            ]);

            if (!$newImage->save()) {
                return false;
            }

            if (!is_null($model)) {
                $fileRelation = new FileRelation();
                $fileRelation->fill([
                    'image_id' => $newImage->getKey(),
                    'relation' => $model::class,
                    'relation_id' => $model->getKey()
                ]);

                if (!$fileRelation->save()) {
                    return false;
                }
            }

            $records[] = ['image' => $newImage, 'relation' => $fileRelation];
        }

        return $records;
    }


    /**
     * Upload Non Image files
     * @param mixed $files
     * @param Model|null $model
     * @return array
     */
    public static function uploadOther(mixed $files, ?Model $model=null, string|null $type=null): array {
        $records = [];

        if ( ! is_array($files) ) {

            $files = [$files];
        }

        foreach ($files as $file) {
            $generatedFilename = $file->hashName();
            $baseDir = 'public/uploads/associated-files/';
            $file->store($baseDir);

            $newImage = new ModelsImage();
            $newImage->fill([
                'filename' => $generatedFilename,
                'filepath' => $baseDir . $generatedFilename,
                'information' => [
                    'folders' => $baseDir
                ],
                'sizes' => [
                    'width' => 0,
                    'height' =>  0,
                ],
                'original_filename' => $file->getClientOriginalName(),
            ]);

            $newImage->save();

            if (!is_null($model)) {

                $fileRelation = new FileRelation();

                $fileRelation->fill([
                    'image_id' => $newImage->getKey(),
                    'relation' => $model::class,
                    'relation_id' => $model->getKey(),
                    'type'  => $type
                ]);

                if (!$fileRelation->save()) {
                    return false;
                }
            }

            $records[] = ['image' => $newImage, 'relation' => $fileRelation];
        }

        return $records;
    }

    public static function uploadOnly(mixed $images): bool|array
    {
        $settings = config('image-settings');
        $records = [];
        if (!is_array($images)) {
            $images = [$images];
        }

        foreach ($images as $image) {

            $generatedFilename = $image->hashName();

            list($width, $height) = getimagesize($image->getRealPath());

            foreach ($settings['sizes'] as $folder => $option) {

                $resizeImage = ImageManager::make($image->getRealPath());
                $resizeImage->resize($option['height'], $option['width'], function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
                $resizeImage->encode();
                $baseDir = 'public/uploads/' . $folder . '/' . date("Y") . '/' . date('m');

                Storage::put($baseDir . '/' . $generatedFilename, $resizeImage->__toString());
            }

            $image->store('public/uploads/cus/' . date('Y') . '/' . date('m'));
            $exif = ImageManager::make($image->getRealPath())->exif();
            $newImage = new ModelsImage();
            $newImage->fill([
                'filename' => $generatedFilename,
                'filepath' => date('Y') . '/' . date("m") . '/' . $generatedFilename,
                'information' => [
                    'exif' => $exif,
                    'folders' => date('Y') . '/' . date("m")
                ],
                'sizes' => [
                    'width' => $width ?? 0,
                    'height' => $height ?? 0,
                ],
                'original_filename' => $image->getClientOriginalName(),
            ]);

            if (!$newImage->save()) {
                return false;
            }


            $records[] = $newImage;
        }

        return $records;
    }

    public static function getImageAsSize($filePath, $size = 'm')
    {
        if (gettype($filePath) == 'object') {
            $filePath = $filePath->filepath;
        }

        $domainPath = env('APP_URL');
        $sotragePath = asset('uploads/' . $size . '/' . $filePath, (env('APP_ENV') == 'local') ? false : true);
        return $sotragePath;
    }

    public static function pdfToImage(string $filepath): array
    {
        $result = [];
        if (!file_exists(Storage::disk('local')->exists($filepath))) {
            return $result;
        }



        return $result;
    }
}
