<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCourseEnrollment extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'active',
        'user_id'
    ];

    public static function getEnrolledCourse()
    {
        return Self::where('user_id', auth()->guard('web')->id())
            ->with(['getCourse' => function ($query) {
                $query->withcount(['lessions'])
                    ->with('getImage');
            }, 'getHistory'])
            ->get();
    }

    public static function getActiveEnrolledCourse()
    {
        return Self::where('user_id', auth()->guard('web')->id())
            ->where('completed', false)
            ->with(['getCourse' => function ($query) {
                $query->withcount(['lessions'])
                    ->with('getImage');
            }, 'getHistory'])
            ->get();
    }

    public function getCourse()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function getHistory()
    {
        return $this->hasMany(UserWatchHistory::class, 'course_id', 'course_id')
            ->where('user_id', auth()->guard('web')->id());
    }
}
