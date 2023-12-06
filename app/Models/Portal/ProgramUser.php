<?php

namespace App\Models\Portal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ProgramUser extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = 'portal_connection';

    protected $fillable = [
        'program_id',
        'program_section_id',
        'student_id',
        'batch_id',
        'active',
        'roll_number',
        'allow_all',
    ];

    protected $table = 'program_students';


}
