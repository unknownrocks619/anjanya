<?php

namespace App\Models;

use App\Models\Scopes\SortableScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends AdminModel
{
    use HasFactory;


    protected $fillable = [
        'chapter_name',
        'intro_text',
        'slug',
        'short_description',
        'full_description',
        'active',
        'sort_by'
    ];

    public $route = 'chapters';

    const IMAGE_TYPES = [
        'banner'    => 'Banner',
        'logo'      => 'Logo',
        'thumbnail' => 'Thumbnail'
    ];


    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::addGlobalScope(new SortableScope);
    }


    public function lessions()
    {
        return $this->hasMany(Lession::class, 'chapter_id');
    }

    // public static function getSlug($slug, Chapter $chapter = null)
    // {
    //     $slug = \Illuminate\Support\Str::slug($slug);
    //     $query = Chapter::where('slug', $slug);
    //     if ($chapter) {
    //         $query->where('course_id', '!=', $chapter->getKey());
    //     }

    //     if ($query->exists()) {
    //         $slug .= '-' . \Illuminate\Support\Str::slug(\Illuminate\Support\Str::random(6));
    //     }

    //     return $slug;
    // }

    public static function getSort(Course $course = null)
    {
        $sort = 0;
        if ($course) {
            $sort = Chapter::where('course_id', $course->getKey())->max('sort_by');
        } else {
            $sort = Chapter::max('sort_by');
        }
        if (!is_null($sort)) {
            $sort++;
        } else {
            $sort = 0;
        }

        return $sort;
    }

    public function totalCompleted()
    {
        return $this->hasMany(UserWatchHistory::class, 'chapter_id')
            ->where('user_id', auth()->guard('web')->id())
            ->where('completed', true);
    }


    public function getCourse()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
}
