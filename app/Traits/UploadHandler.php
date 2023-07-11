<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;


trait UploadHandler
{

    protected $path;


    protected function set_upload_path($path = null)
    {

        if (!$path) {
            $this->path = env("UPLOAD_PATH", "website/events/");
        } else {
            $this->path = $path;
        }
    }

    protected function get_upload_path()
    {
        return $this->path;
    }

    public function upload(Request $request, $filename = "file")
    {
        // dd($request->file($filename));
        $file_detail = [
            "original_filename" => $request->file($filename)->getClientOriginalName(),
            "file_type" => $request->file($filename)->getMimeType(),
            "path" => Storage::putFile($this->get_upload_path(), $request->file($filename)->path()),
        ];

        return $file_detail;
    }
}
