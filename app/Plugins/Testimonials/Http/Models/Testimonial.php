<?php

namespace App\Plugins\Testimonials\Http\Models;

use App\Models\AdminModel;
use App\Models\Menu;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends AdminModel
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'title',
        'gender',
        'email',
        'images',
        'profession',
        'source',
        'comment',
        'sort_by',
        'rating'
    ];

    public static function getSortOrder($parentID = null)
    {
        $sortID = 0;
        $sortID = self::max('sort_by');
        return $sortID + 1;
    }
}
