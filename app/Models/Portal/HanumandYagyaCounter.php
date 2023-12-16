<?php

namespace App\Models\Portal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HanumandYagyaCounter extends Model
{
    use HasFactory;

    protected $connection = 'portal_connection';

    protected  $table = 'hanumand_yagya_counters';

    protected $fillable = [
        'member_id',
        'program_id',
        'total_counter',
        'is_taking_part'
    ];
}
