<?php

namespace App\Models;

use Cloudinary\Cloudinary;
use Cloudinary\Transformation\Delivery;
use Cloudinary\Transformation\Format;
use Cloudinary\Transformation\Quality;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;


    const BUCKET_LOCAL = 'local';
    const BUCKET_CLOUDINARY = 'cloudinary';

    protected $fillable = [
        'original_filename',
        'filename',
        'filepath',
        'information',
        'sizes',
        'bucket_type',
        'public_id',
        'bucket_upload_response',
        'upload_revision',
        'bucket_filename',
        'bucket_filepath',
        'bucket_signature'

    ];

    protected $casts = [
        'information'   => 'object',
        'sizes'         => 'object',
        'bucket_upload_response'    => 'array'
    ];

    public function getFilePathAttribute($value) {

        if ($this->bucket_type == self::BUCKET_CLOUDINARY) {
            $cloundinary = new Cloudinary();
            $value = $cloundinary->image($this->public_id)
                ->delivery(Delivery::quality(Quality::auto()))
                ->delivery(Delivery::format(Format::auto()));
//                                ->version($this->upload_revision);
        }
        return $value;

    }
}
