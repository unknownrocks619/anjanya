<?php

namespace App\Models\Portal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class ProgramVolunteerDates extends Authenticatable
{
    use HasFactory,SoftDeletes,Notifiable;

    protected  $table = 'program_volunteer_available_dates';
    protected $connection = 'portal_connection';

    protected  $fillable = [
        'member_id',
        'program_volunteer_id',
        'available_dates',
        'status',
    ];



}
