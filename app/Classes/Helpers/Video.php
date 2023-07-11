<?php

namespace App\Classes\Helpers;

use App\Models\FileRelation;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;

class Video
{


    public static function storeVideo(mixed $videos, $model = null)
    {
        if (!is_array($videos)) {
            $videos = [$videos];
        }
        $folder = 'videos';
        $baseDir = 'public/uploads/' . $folder . '/' . date("Y") . '/' . date('m');
        $records = [];
        foreach ($videos as $video) {
            $generatedFilename = $video->hashName();
            $path = Storage::put($baseDir, $video);

            $newImage = new Image();
            $newImage->fill([
                'filename' => $generatedFilename,
                'filepath' => date('Y') . '/' . date("m") . '/' . $generatedFilename,
                'information' => [
                    'folders' => date('Y') . '/' . date("m")
                ],
                'original_filename' => $video->getClientOriginalName(),
            ]);

            if (!$newImage->save()) {
                return false;
            }

            $fileRelation = [];
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
            $records[] = ['video' => $newImage, 'relation' => $fileRelation];
        }
        return $records;
    }


    /**
     * Seperate Vimeo link
     *
     * @param string $url
     *
     * @return array
     *
     */
    public static function vimeo(string $url): array
    {
        $result = [];
        $queryParam = parse_url($url);
        $result = [
            'link'  => $url,
            'query' => $queryParam,
            'id'    => str_replace('/', '', $queryParam['path'])
        ];

        return $result;
    }

    /**
     * Seperate Youtube link
     *
     * @param string $url
     *
     * @return array
     *
     */
    public static function youtube(string $url): array
    {
        $result = [];

        $queryParam = parse_url($url);
        parse_str($queryParam['query'], $output);

        $result = [
            'link'  => $url,
            'query' => $queryParam['query'],
            'id'    => $output['v']
        ];


        return $result;
    }

    public static function renderYoutube($youtubeID, $title = "")
    {
        $style = 'width:100%;height:100%;position:absolute;top:0;left:0;';
        $src = 'https://www.youtube.com/embed/' . $youtubeID;
        $allow = "accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share";

        $render = "
        <div style='padding:56.25% 0 0 0;position:relative;margin-top:3%;margin-bottom:3%'>
        <iframe src='{$src}' title='{$title}' frameborder='0'  allowfullscreen style='{$style}' allow='{$allow}'></iframe>
        </div>";
        return $render;
    }

    public static function renderVimeo($vimeoID)
    {


        return "<div style='padding:56.25% 0 0 0;position:relative;margin-top:3%;margin-bottom:3%'>
            <iframe src='https://player.vimeo.com/video/{$vimeoID}?h=149514e45d&color=ef0000'
                style='position:absolute;top:0;left:0;width:100%;height:100%;' frameborder='0' allow='autoplay; fullscreen; picture-in-picture' allowfullscreen></iframe></div>
                <script src='https://player.vimeo.com/api/player.js'>
                    </script>";
    }
    public static function renderBackgroundYoutube($youtubeID, $title = "")
    {
        $style = 'width:100%;height:100%;position:absolute;top:0;left:0;';
        $src = 'https://www.youtube.com/embed/' . $youtubeID;
        $allow = "accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share";

        $render = "
        <div style='padding:56.25% 0 0 0;position:relative;'>
        <iframe src='{$src}' title='{$title}' frameborder='0'  allowfullscreen style='{$style}' allow='{$allow}'></iframe>
        </div>";
        return $render;
    }

    public static function renderBackgroundVimeo($vimeoID)
    {

        return "
            <iframe src='https://player.vimeo.com/video/{$vimeoID}?h=149514e45d&color=ef0000&background=1&transparent=1&muted=0&autplay=1'
                style='position:absolute;top:0;left:0;width:100%;height:100vh;background-color:#181739' frameborder='0' allow='autoplay; fullscreen; picture-in-picture' allowfullscreen></iframe>
                <script src='https://player.vimeo.com/api/player.js'>
                    </script>";
    }
    public static function renderCardYoutube($youtubeID, $title = "")
    {
        $style = 'width:100%;height:100%;position:absolute;top:0;left:0;';
        $src = 'https://www.youtube.com/embed/' . $youtubeID;
        $allow = "accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share";

        $render = "
        <div style='padding:30.25% 0 0 0;position:relative;margin-top:3%;margin-bottom:3%'>
        <iframe src='{$src}' title='{$title}' frameborder='0'  allowfullscreen style='{$style}' allow='{$allow}'></iframe>
        </div>";
        return $render;
    }

    public static function renderCardVimeo($vimeoID)
    {


        return "<div style='padding:30.25% 0 0 0;position:relative;margin-top:3%;margin-bottom:3%'>
            <iframe src='https://player.vimeo.com/video/{$vimeoID}?h=149514e45d&color=ef0000'
                style='position:absolute;top:0;left:0;width:100%;height:100%;' frameborder='0' allow='autoplay; fullscreen; picture-in-picture' allowfullscreen></iframe></div>
                <script src='https://player.vimeo.com/api/player.js'>
                    </script>";
    }
}
