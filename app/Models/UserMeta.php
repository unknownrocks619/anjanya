<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserMeta extends Model
{
    use HasFactory;

    const USER_EDUCATIONS = [
        'primary_school' => 'Primary School (Grade 1-5)',
        'middle_school' => 'Middle School (Grade 6-8)',
        'high_school' => 'High School/+2 (Grade 9-12)',
        'bachelors' => 'Bachelors',
        'masters' => 'Masters',
        'phd' => 'PhD'
    ];

    protected $fillable = [
        'user_id',
        'education',
        'profession',
        'gaurdian_info',
        'emergency_contact',
        'signature',
        'parent_signature'
    ];

    protected $casts = [
        'education' => 'object',
        'gaurdian_info' => 'object',
        'emergency_contact' => 'object',
        'signature'         => 'object',
        'parent_signature'  => 'object'
    ];
}
