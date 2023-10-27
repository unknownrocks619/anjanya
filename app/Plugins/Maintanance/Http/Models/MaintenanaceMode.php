<?php

namespace App\Plugins\Maintanance\Http\Models;

use App\Models\AdminModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaintenanaceMode extends AdminModel
{
    use HasFactory;

    protected $fillable = [
        'mode_name',
        'slug',
        'active',
        'intro_text',
        'short_description',
        'full_description',
        'background_color'
    ];

    const IMAGE_TYPES = [
        'background'    => 'Background Image',
        'featurd_image' => 'Featured Image',
        'notice_image'  => 'Notice Image',
    ];

    public function buttons() {
        return $this->hasMany(MaintenanaceModeButtons::class,'maintenance_mode');
    }

}
