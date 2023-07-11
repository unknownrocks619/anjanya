<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends AdminModel
{
    use HasFactory;

    const IMAGE_TYPES = [
        'banner'    => 'Banner',
        'theme'     => 'Theme',
        'course_thumbnail'  => 'Course Thumbnail'
    ];

    const VIDEO_SOURCES = [
        'vimeo' => 'Vimeo',
        'youtube'   => 'Youtube',
        'file'      => 'File',
        'lessions'   => 'Lession'
    ];

    public $route = 'courses';

    protected $fillable = [
        'course_name',
        'slug',
        'course_intro_text',
        'course_short_description',
        'course_full_description',
        'intor_video',
        'permission',
        'active',
        'enable_intro_video',
        'sort_by'
    ];

    protected $casts = [
        'permission' => 'object',
        'intro_video' => 'object'
    ];


    const PERMISSIONS = [
        'public'    => 'Public / All',
        'organisation'  => 'Organisation',
        'student'       => 'Student',
        'teacher'       => 'Teacher',
        'admin'         => 'Admin'
    ];

    public function video()
    {
    }
    public function chapters()
    {
        return $this->hasMany(Chapter::class, 'course_id');
    }

    public function lessions()
    {
        return $this->hasMany(Lession::class, 'course_id');
    }

    // public static function getSlug(string $slug, Model $course = null): string
    // {

    //     $slug = \Illuminate\Support\Str::slug($slug);
    //     $query = Course::where('slug', $slug);

    //     if ($course) {
    //         $query->where('id', '!=', $course->getKey());
    //     }

    //     if ($query->exists()) {
    //         $slug .= '-' . \Illuminate\Support\Str::slug(\Illuminate\Support\Str::random(6));
    //     }

    //     return $slug;
    // }

    public static function getSortBy()
    {
        $max =  Course::max('sort_by');
        if (is_null($max)) {
            $max = 0;
        } else {
            $max++;
        }
        return $max;
    }
}
