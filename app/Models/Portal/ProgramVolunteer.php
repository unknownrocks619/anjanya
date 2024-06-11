<?php

namespace App\Models\Portal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class ProgramVolunteer extends Authenticatable
{
    use HasFactory,SoftDeletes,Notifiable;

    protected  $table = 'program_volunteers';
    protected $connection = 'portal_connection';

    protected $fillable = [
        'program_id',
        'member_id',
        'volunteer_group_id',
        'full_name',
        'gotra',
        'email',
        'phone_number',
        'country',
        'full_address',
        'education',
        'gender',
        'profession',
        'involved_in_program',
        'was_involved_in_volunteer',
        'confirm_presence',
        'accept_terms_and_conditions',
        'accepted_as_volunteer',
    ];

   
    public function member() {
        return $this->belongsTo(UserModel::class,'member_id');
    }

    public function availableDates() {
        return $this->hasMany(ProgramVolunteerDates::class,'program_volunteer_id');
    }

}
