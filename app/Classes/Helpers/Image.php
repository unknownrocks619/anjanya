<?php

namespace App\Classes\Helpers;

use App\Models\FileRelation;
use App\Models\Image as ModelsImage;
use App\Models\Images;
use App\Models\Web\StudioFile;
use App\Models\Web\StudioFileRelation;
use Cloudinary\Api\Exception\ApiError;
use Cloudinary\Cloudinary;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
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

            $uploadAPI = new Cloudinary();
            $folder = date('Y/m');

            try {
                $apiResponse = $uploadAPI->uploadApi()->upload($image->getRealPath(),[
                    'use_asset_folder_as_public_id_prefix'  => true,
                    'asset_folder' => $folder,
                    'display_name'  => $image->getClientOriginalName(),
                    'faces' => true,
                    'filename' => $image->getClientOriginalName(),
                ])->getArrayCopy();

                $newImage = new \App\Models\Image();
                $newImage->fill([
                    'filename' => pathinfo($apiResponse['url'],PATHINFO_FILENAME).'.'.$apiResponse['format'],
                    'filepath' => $apiResponse['public_id'],
                    'information' => [
                        'exif' => [],
                        'folders' => date('Y') . '/' . date("m")
                    ],
                    'sizes' => [
                        'width' => $apiResponse['width'] ?? 0,
                        'height' => $apiResponse['height'] ?? 0,
                    ],
                    'original_filename' => $image->getClientOriginalName(),
                    'bucket_type' => \App\Models\Image::BUCKET_CLOUDINARY,
                    'bucket_upload_response' => $apiResponse,
                    'public_id' => $apiResponse['public_id'],
                    'upload_revision' => $apiResponse['version_id'],
                    'bucket_filename' => pathinfo($apiResponse['url'],PATHINFO_FILENAME).'.'.$apiResponse['format'],
                    'bucket_filepath'   => $apiResponse['public_id'],
                    'bucket_signature'  => $apiResponse['signature'],
                ]);

                if (!$newImage->save()) {
                    return false;
                }
            } catch (ApiError $e){
                $newImage = (new Self())->fallbackDefaultUpload($image);
            } catch ( \Error $e) {
                $newImage = (new Self())->fallbackDefaultUpload($image);
            }

            if ( ! $newImage ) {
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

            $uploadAPI = new Cloudinary();
            $folder = date('Y/m');


            try {
                $apiResponse = $uploadAPI->uploadApi()->upload($image->getRealPath(),[
                    'use_asset_folder_as_public_id_prefix'  => true,
                    'asset_folder' => $folder,
                    'display_name'  => $image->getClientOriginalName(),
                    'faces' => true,
                    'filename' => $image->getClientOriginalName(),
                ])->getArrayCopy();

                $newImage = new \App\Models\Image();
                $newImage->fill([
                    'filename' => pathinfo($apiResponse['url'],PATHINFO_FILENAME).'.'.$apiResponse['format'],
                    'filepath' => $apiResponse['public_id'],
                    'information' => [
                        'exif' => [],
                        'folders' => date('Y') . '/' . date("m")
                    ],
                    'sizes' => [
                        'width' => $apiResponse['width'] ?? 0,
                        'height' => $apiResponse['height'] ?? 0,
                    ],
                    'original_filename' => $image->getClientOriginalName(),
                    'bucket_type' => \App\Models\Image::BUCKET_CLOUDINARY,
                    'bucket_upload_response' => $apiResponse,
                    'public_id' => $apiResponse['public_id'],
                    'upload_revision' => $apiResponse['version_id'],
                    'bucket_filename' => pathinfo($apiResponse['url'],PATHINFO_FILENAME).'.'.$apiResponse['format'],
                    'bucket_filepath'   => $apiResponse['public_id'],
                    'bucket_signature'  => $apiResponse['signature'],
                ]);

                if (!$newImage->save()) {
                    return false;
                }
            } catch (ApiError $e){
                $newImage = (new Self())->fallbackDefaultUpload($image);
            } catch ( \Error $e) {
                $newImage = (new Self())->fallbackDefaultUpload($image);
            }

            $records[] = $newImage;
        }

        return $records;
    }

    public static function getImageAsSize($filePath, $size = 'm')
    {

        if ( $filePath instanceof \Cloudinary\Asset\Image) {
            return $filePath->toUrl();
        }

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

    public function fallbackDefaultUpload(UploadedFile $file): \App\Models\Image|null {
        $generatedFilename = $file->hashName();
        $settings = config('image-settings');

        list($width, $height) = getimagesize($file->getRealPath());

        foreach ($settings['sizes'] as $folder => $option) {

            $resizeImage = ImageManager::make($file->getRealPath());
            $resizeImage->resize($option['height'], $option['width'], function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            $resizeImage->encode();
            $baseDir = 'uploads/' . $folder . '/' . date("Y") . '/' . date('m');

            Storage::put($baseDir . '/' . $generatedFilename, $resizeImage->__toString());
        }

        $file->store('uploads/org/' . date('Y') . '/' . date('m'));
        $exif = ImageManager::make($file->getRealPath())->exif();
        $newImage = new \App\Models\Image();
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
            'original_filename' => $file->getClientOriginalName(),
            'bucket_type' => 'local'
        ]);

        if (!$newImage->save()) {
            return null;
        }

        return $newImage;
    }
}
