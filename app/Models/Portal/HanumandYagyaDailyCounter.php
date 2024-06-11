<?php

namespace App\Models\Portal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HanumandYagyaDailyCounter extends Model
{
    use HasFactory;

    protected $connection = 'portal_connection';

    protected $table = 'hanumand_daily_counters';

    protected  $fillable = [
        'humand_yagya_id',
        'member_id',
        'count_date',
        'total_count'
    ];
}
