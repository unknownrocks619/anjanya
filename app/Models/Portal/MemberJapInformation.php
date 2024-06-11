<?php

namespace App\Models\Portal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberJapInformation extends Model
{
    use HasFactory;

    protected $connection = 'portal_connection';

    protected  $table = 'event_jap_information';

    protected $fillable = [
        'member_id',
        'event_id',
        'total_jap_count',
        'jap_start_date',
        'total_expected_jap_count',
        'average_jap_count',
        'is_family'
    ];
}
