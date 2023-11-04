<?php

namespace App\Plugins\Maintanance\Http\Models;

use App\Models\AdminModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaintenanaceModeButtons extends AdminModel
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'maintenance_mode',
        'button_label',
        'response_type',
        'button_response'
    ];
    const BUTTON_TYPES = [
        'link' => 'Link',
        'image' => 'Image',
        'pdf'   => 'PDF'
    ];
}
