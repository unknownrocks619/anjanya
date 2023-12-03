<?php

namespace App\Models\Portal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberEmergencyMeta extends Model
{
    use HasFactory;

    protected $connection = 'portal_connection';
    protected  $table='member_emergency_metas';

    protected $fillable  = [
        'member_id',
        'contact_person',
        'relation',
        'email_address',
        'phone_number',
        'profile'
    ];
}
