<?php

namespace App\Models;

use App\Models\Scopes\SortableScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lession extends AdminModel
{
    use HasFactory;

    protected $table = 'lessions';

    const IMAGE_TYPES = [
        'banner'    => 'Banner',
        'thumbnail' => 'Thumbnail',
        'seo'       => 'SEO'
    ];

    protected $fillable = [
        'course_id',
        'chapter_id',
        'lession_name',
        'slug',
        'total_duration',
        'intro_text',
        'short_description',
        'full_description',
        'youtube',
        'vimeo',
        'intro_video',
        'enable_vimeo',
        'enable_youtube',
        'enable_preview',
        'active'
    ];

    protected $casts = [
        'youtube' => 'object',
        'vimeo'     => 'object',
        'intro_video'   => 'object',
        'active'        => 'boolean'
    ];

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::addGlobalScope(new SortableScope);
    }


    // protected static function getSlug($slug, Lession $lession = null)
    // {
    //     $slug = \Illuminate\Support\Str::slug($slug);

    //     $query = Lession::where('slug', $slug);

    //     if ($lession) {
    //         $query->where('id', '!=', $lession->getKey());
    //     }

    //     if ($query->exists()) {
    //         $slug .= '-' . \Illuminate\Support\Str::slug(\Illuminate\Support\Str::random(6));
    //     }

    //     return $slug;
    // }

    protected static function getOrder(Chapter $chapter = null)
    {

        $max_value = 0;

        if ($chapter) {
            $sort = Lession::where('chapter_id', '!=', $chapter->getKey())->max('sort_by');
        } else {
            $sort = Lession::max('sort_by');
        }

        if (!is_null($sort)) {
            $max_value = $sort + 1;
        }

        return $max_value;
    }

    public function getChapter()
    {
        return $this->belongsTo(Chapter::class, 'chapter_id');
    }

    public function getCourse()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
}
