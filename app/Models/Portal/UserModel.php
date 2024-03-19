<?php

namespace App\Models\Portal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class UserModel extends Authenticatable
{
    use HasFactory,SoftDeletes,Notifiable;

    protected  $table = 'members';
    protected $connection = 'portal_connection';

    protected $fillable = [
        "full_name",
        "first_name",
        "middle_name",
        "last_name",
        'gotra',
        "country",
        'city',
        'address',
        'date_of_birth',
        'email',
        'remember_token',
        'sharing_code',
        'phone_number',
        'profile',
        'gender',
        'street_address'
    ];

    protected $hidden = [
        'stripe_id',
        'pm_last_four',
        'trial_ends_at',
        'password',
        'created_at',
        'updated_at',
        'pm_type',
        'remember_token',
        'source',
        'external_source_id',
        'role_id',
        'student_rollnumber',
        'deleted_at',
        'is_email_verified',
        'is_email_verified'
    ];
    protected $casts = [
        "profileUrl" => "object",
        "address" => "object",
        "created_at" => "datetime",
        "profile" => "object",
        "remarks" => "object"
    ];

    public function full_name() {
        $full_name = $this->first_name;
        $explodeLastName = explode(' ',$this->last_name);

        foreach ($explodeLastName as $name) {
            $full_name .=' '.$name;
        }

        return $full_name;
    }

    public function diskshya()
    {
        return $this->hasMany(MemberDikshya::class,'member_id');
    }

    public function meta()
    {
        return $this->hasOne(MemberInfo::class, "member_id");
    }

    public function emergency()
    {
        return $this->hasOne(MemberEmergencyMeta::class, 'member_id')->latest();
    }

    public function emergency_contact()
    {
        return $this->hasMany(MemberEmergencyMeta::class, "member_id");
    }

}
