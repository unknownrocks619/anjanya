<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserWatchHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'chapter_id',
        'lession_id',
        'user_id'
    ];

    public function getLession()
    {
        return $this->belongsTo(Lession::class, 'lession_id');
    }
}
